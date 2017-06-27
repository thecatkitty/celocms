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
    $pattern = '/\{\{#(?P<name>\w+): (?P<args>.*)\}\}/';
    while(preg_match($pattern, $doc)) {
      $doc = preg_replace_callback($pattern, function ($matches) {
        global $wspf;
        
        $name = $matches['name'];
	  
        if(isset($wspf[$matches['name']]))
          return call_user_func($wspf[$matches['name']], $matches['args']);
        return '&#123;&#123;#' . $matches['name'] . ': ' . $matches['args'] . '&#125;&#125;';
      }, $doc);
    }

    // Zamień zmienne.
    $pattern = '/\{\{(?P<path>[\w\.-]+)\}\}/';
    while(preg_match($pattern, $doc)) {
      $doc = preg_replace_callback($pattern, function ($matches) {
        $name = $matches[1];
        global $ws;
        $value = get_dotted_value($ws, $matches['path']);
        if(isset($value)) return $value;
	      return '&#123;&#123;' . $matches['path'] . '&#125;&#125;';
      }, $doc);
    }
    
    return preg_match('/\{\{[^\s][^\.]*\}\}/', $doc) ? parser_process($doc) : $doc;
  }
?>