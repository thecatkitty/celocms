<?php
  $t_start = microtime(true);
  session_start();
  $page = true;
  
  $uri = $_SERVER['REQUEST_URI'];
  
  // Wczytaj konfigurację
  $ws = json_decode(file_get_contents('config.json'), true);
  $ws['PATH_ROOT'] = str_replace('index.php', '', $_SERVER['PHP_SELF']);
  $ws['PHP_VERSION'] = explode('-', phpversion())[0];
  $ws['PHP_SERVER'] = explode(' ', $_SERVER['SERVER_SOFTWARE'])[0];
  $ws['PHP_OS'] = explode(' ', $_SERVER['SERVER_SOFTWARE'])[1];
  date_default_timezone_set($ws['Timezone']);
  
  // Wczytaj moduły
  $dir = opendir($ws['PATH_CORE']);
  while($filename = readdir($dir))
    if(preg_match('/^(\w+).php$/', $filename, $matches))
      require_once($ws['PATH_CORE'] . $matches[1] . '.php');

  // Wczytaj wtyczki
  Plugins\load();
  Plugins\initialize();
      
  // Wczytaj język
  Localizer\load_language($ws['Language']);
      
  // Wczytaj motyw
  require_once($ws['ThemePath'] . 'theme.php');
  if(file_exists($ws['ThemePath'] . 'locale/' . $ws['Language'] . '.json'))
    $ws['lang'][$ws['Theme']] = json_decode(file_get_contents($ws['ThemePath'] . 'locale/' . $ws['Language'] . '.json'), true);
  
  // Wczytaj stronę
  if(isset($_SERVER['REDIRECT_URL'])) {
    $uri = $_SERVER['REDIRECT_URL'];
    $ws['Page'] = substr($uri, strlen($ws['PATH_ROOT']));
  }
  else $ws['Page'] = $ws['HomePage'];

  // Sprawdź, czy nie ma wtyczki odpowiedzialnej za renderowanie
  if(!Plugins\render()) {
    // Załaduj stronę i parser
    Parser\load_extensions();
    Content\load_menu();
    $page = Content\load_page($ws['Page']);
    if(isset($ws['ErrorCode']))
      $page = Content\load_error();
  
    // Renderuj surową stronę
    ob_start();
  
    echo file_get_contents($ws['ThemePath'] . 'parts/head.html');
    echo file_get_contents($ws['ThemePath'] . 'parts/menu.html');
  
    foreach($page->sections as $section)
      Theme\section($section);
    
    echo file_get_contents($ws['ThemePath'] . 'parts/footer.html');
    echo file_get_contents($ws['ThemePath'] . 'parts/end.html');
  
    $content = ob_get_clean();

    // Przetwórz wyjście
    Parser\process();
    Theme\process();
    Plugins\finish();
  }
  
  echo $content;
?>

<!-- <?=$ws['lang']['generated']?> <?=round((microtime(true)-$t_start)*1000, 1)?> <?=$ws['lang']['milliseconds']?>. -->