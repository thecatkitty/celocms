<?php
  $t_start = microtime();
  session_start();
  $page = true;
  
  $uri = $_SERVER['REQUEST_URI'];
  
  // Wczytaj konfigurację
  require_once('config.php');
  $ws['PHP_VERSION'] = phpversion();
  $ws['PHP_SERVER'] = explode(' ', $_SERVER["SERVER_SOFTWARE"])[0];
  $ws['PHP_OS'] = explode(' ', $_SERVER["SERVER_SOFTWARE"])[1];
  
  // Wczytaj moduły
  $dir = opendir($ws['PATH_CORE']);
  while($filename = readdir($dir))
    if(preg_match('/^(\w+).php$/', $filename, $matches))
      require_once($ws['PATH_CORE'] . $matches[1] . '.php');
      
  // Wczytaj język
  set_language($ws['Language']);
  if(isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
    $acc_langs = explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE']);
    $langs = explode('|', $ws['Languages']);
    foreach($acc_langs as $al) {
      $al = preg_replace('/^([a-z]{2,3})(-[a-zA-Z]+)*$/', '$1', $al);
      foreach($langs as $l) {
        if($al == $l) {
          set_language($al);
          break;
        }
      }
    }
  }
  if(nachama('lang')) set_language(get_nachama('lang'));
      
  // Wczytaj motyw
  $ws['Theme'] = get_nachama('theme', ishttp1() ? 'archaic' : $ws['Theme']);
  $ws['ThemePath'] = $ws['PATH_THEME'] . $ws['Theme'] . '/';
  require_once($ws['ThemePath'] . 'theme.php');
  
  // Wczytaj stronę
  if(isset($_SERVER['REDIRECT_URL'])) {
    $uri = $_SERVER['REDIRECT_URL'];
    $ws['Page'] = str_replace($ws['PATH_ROOT'], '', $uri);
  }
  else $ws['Page'] = $ws['HomePage'];
  die($ws['Page']);
  
  // Wczytaj pamięć podręczną
  $uri = preg_replace('/\/?([^\?]*).*?/', '$1', $uri);
  if(in_cache($uri, $lang['code'], $ws['Theme']))
    $content = get_cached($uri, $lang['code'], $ws['Theme']);
  
  else {
    // Wczytaj menu
    load_menu();

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
      $ws['PageTitle'] = '{lang.error}';
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
      emit_section($section);
  
    echo file_get_contents($ws['ThemePath'] . 'parts/footer.html');
    echo file_get_contents($ws['ThemePath'] . 'parts/end.html');
  
    // Przetwórz wyjście
    $content = ob_get_clean();
    $content = transclude($content);
    $content = localize($content);
    $content = endify($content);
    $content = compress_html($content);
    
    if($ws['Page'] != 'error')
      put_cached($uri, $lang['code'], $ws['Theme'], $content);
  }
  
  echo $content;
?>

<!-- Wykonano w <?=round(microtime()-$t_start, 5)?> milisekund. -->