<?php
  $t_start = microtime();
  session_start();
  $page = true;
  
  $uri = $_SERVER['REQUEST_URI'];
  
  // Wczytaj konfigurację
  $ws = json_decode(file_get_contents('config.json'), true);
  $ws['PATH_ROOT'] = str_replace('index.php', '', $_SERVER['PHP_SELF']);
  $ws['PHP_VERSION'] = phpversion();
  $ws['PHP_SERVER'] = explode(' ', $_SERVER['SERVER_SOFTWARE'])[0];
  $ws['PHP_OS'] = explode(' ', $_SERVER['SERVER_SOFTWARE'])[1];
  date_default_timezone_set($ws['Timezone']);
  
  // Wczytaj moduły
  $dir = opendir($ws['PATH_CORE']);
  while($filename = readdir($dir))
    if(preg_match('/^(\w+).php$/', $filename, $matches))
      require_once($ws['PATH_CORE'] . $matches[1] . '.php');

  // Przekieruj na połączenie szyfrowane
  if($_SERVER['HTTP_HOST'] == 'www.celones.pl')
    if(!session_archaic_agent()) {
      header("Location: https://celones.pl" . $_SERVER['REQUEST_URI'], true, 301);
      exit();
    }
      
  // Wczytaj język
  localizer_load_language($ws['Language']);
  if(isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
    $acc_langs = explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE']);
    $langs = explode('|', $ws['Languages']);
    foreach($acc_langs as $al) {
      $al = preg_replace('/^([a-z]{2,3})(-[a-zA-Z]+)*$/', '$1', $al);
      foreach($langs as $l) {
        if($al == $l) {
          localizer_load_language($al);
          break;
        }
      }
    }
  }
  if(session_forced('lang')) localizer_load_language(session_get_forced('lang'));
      
  // Wczytaj motyw
  $ws['Theme'] = session_get_forced('theme', session_archaic_agent() ? 'archaic' : $ws['Theme']);
  $ws['ThemePath'] = $ws['PATH_THEME'] . $ws['Theme'] . '/';
  if(!file_exists($ws['ThemePath'] . 'theme.php')) {
    $ws['Theme'] = 'archaic';
    $ws['ThemePath'] = $ws['PATH_THEME'] . $ws['Theme'] . '/';
    $_SESSION['theme'] = 'archaic';
  }
  require_once($ws['ThemePath'] . 'theme.php');
  if(file_exists($ws['ThemePath'] . 'locale/' . $ws['Language'] . '.json'))
    $ws['lang'][$ws['Theme']] = json_decode(file_get_contents($ws['ThemePath'] . 'locale/' . $ws['Language'] . '.json'), true);
  
  // Wczytaj stronę
  if(isset($_SERVER['REDIRECT_URL'])) {
    $uri = $_SERVER['REDIRECT_URL'];
    $ws['Page'] = substr($uri, strlen($ws['PATH_ROOT']));
  }
  else $ws['Page'] = $ws['HomePage'];
  
  // Wczytaj pamięć podręczną
  $uri = $ws['Page'];
  if(cacher_cached($uri, $ws['lang']['code'], $ws['Theme']))
    $content = cacher_get($uri, $ws['lang']['code'], $ws['Theme']);
  
  else {
    // Wczytaj menu
    menu_load();

    // Wczytaj treść strony
    try {
      $page = new Page($ws['Page']);
      $ws['PageTitle'] = $page->title;
      $ws['PageDescription'] = $page->desc;
    // Obsłuż błędy HTTP
    } catch(HttpError $e) {
      $ws['ErrorCode'] = $e->getCode();
      $ws['ErrorMessage'] = $e->getMessage();
    
      header('HTTP/1.0 ' . $ws['ErrorCode'] . ' ' . $ws['ErrorMessage']);
    // Obsłuż wyjątki PHP
    } catch(Exception $e) {
      $ws['ErrorCode'] = 'PHP Exception';
      $ws['ErrorMessage'] = '[' . $e->getCode() . '] ' . $e->getMessage();
    }
  
    if(isset($ws['ErrorCode'])) {
      $page = new Page;
      $ws['Page'] = 'error';
      $ws['PageTitle'] = '{{lang.error}}';
      $ws['PageDescription'] = $ws['ErrorCode'] . ': ' . $ws['ErrorMessage'];
    
      $page->sections[0] = new Section;
      $page->sections[0]->id = 'error';
      $page->sections[0]->filename = $ws['PATH_CONTENT'] . 'error.html';
      $page->sections[0]->short = '';
      $page->sections[0]->classes = 'alternate';
    }
  
    // Rozpocznij buforowane wyjście
    ob_start();
  
    echo file_get_contents($ws['ThemePath'] . 'parts/head.html');
    echo file_get_contents($ws['ThemePath'] . 'parts/menu.html');
  
    foreach($page->sections as $section)
      theme_section($section);
    echo '<pre class="container">';
    var_dump($ws);
    echo '</pre>';
    
    echo file_get_contents($ws['ThemePath'] . 'parts/footer.html');
    echo file_get_contents($ws['ThemePath'] . 'parts/end.html');
  
    // Przetwórz wyjście
    parser_initialize();
    $content = ob_get_clean();
    $content = parser_process($content);
    $content = theme_process($content);
    $content = compressor_minimize_html($content);
    
    if($ws['Page'] != 'error' && $ws['Theme'] != 'next')
      cacher_put($uri, $ws['lang']['code'], $ws['Theme'], $content);
  }
  
  echo $content;
?>

<!-- <?=$ws['lang']['generated']?> <?=round(microtime()-$t_start, 5)?> <?=$ws['lang']['milliseconds']?>. -->