<?php
  $wspf = array();
  
  function parser_initialize() {
    global $ws;
    global $wspf;
    
    // Załaduj rozszerzenia parsera.
    $dir = opendir($ws['PATH_PLUGINS'] . 'parser');
    while($filename = readdir($dir))
      if(preg_match('/^(\w+).php$/', $filename, $matches)) {
        include_once($ws['PATH_PLUGINS'] . 'parser/' . $matches[1] . '.php');

        $wspf[$pf_name] = $pf_handler;
      }
  }
  
  function parser_process($doc) {
    // Przetwórz wywołania funkcyj parsera.
    $pattern = '/\{\{#(\w+): (.*)\}\}/';
    while(preg_match($pattern, $doc)) {
      $doc = preg_replace_callback($pattern, function ($matches) {
        global $wspf;
        
        $name = $matches[1];
	  
        if(isset($wspf[$name])) return call_user_func($wspf[$name], $matches[2]);
        return '&#123;&#123;#' . $name . ': ' . $matches[2] . '&#125;&#125;';
      }, $doc);
    }
  
    // Zamień zmienne.
    $pattern = '/\{\{(\w+)\}\}/';
    while(preg_match($pattern, $doc)) {
      $doc = preg_replace_callback($pattern, function ($matches) {
        $name = $matches[1];
        global $ws;
	      if(isset($ws[$name])) return $ws[$name];
	      return '&#123;&#123;' . $name . '&#125;&#125;';
      }, $doc);
    }

    // Zamień elementy zależne od motywu
    global $ws;
    if(isset($ws['ThemeConsts'])) {
      $pattern = '/\{\{theme\.([\w\-]+)\}\}/';
      while(preg_match($pattern, $doc)) {
        $doc = preg_replace_callback($pattern, function ($matches) {
          $name = $matches[1];
          global $ws;
	        if(isset($ws['ThemeConsts'][$name])) return $ws['ThemeConsts'][$name];
	        return '&#123;&#123;theme.' . $name . '&#125;&#125;';
        }, $doc);
      }
    }
    
    return preg_match('/\{\{[^\s][^\.]*\}\}/', $doc) ? parser_process($doc) : $doc;
  }
?>