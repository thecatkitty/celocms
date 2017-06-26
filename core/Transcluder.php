<?php
  function trasncluder_process($doc) {
    // Przetwórz funkcje.
    $pattern = '/\{\?(\w+) (.*)\?\}/';
    while(preg_match($pattern, $doc)) {
      $doc = preg_replace_callback($pattern, function ($matches) {
        global $wsp;
        
        $name = $matches[1];
	  
        if(isset($wsp[$name])) return call_user_func($wsp[$name], $matches[2]);
        return '&#123;?' . $name . ' ' . $matches[2] . '?&#125;';
      }, $doc);
    }
  
    // Zamień zmienne.
    $pattern = '/\{(\w+)\}/';
    while(preg_match($pattern, $doc)) {
      $doc = preg_replace_callback($pattern, function ($matches) {
        $name = $matches[1];
        global $ws;
	      if(isset($ws[$name])) return $ws[$name];
	      return '&#123;' . $name . '&#125;';
      }, $doc);
    }

    // Zamień elementy zależne od motywu
    global $ws;
    if(isset($ws['ThemeConsts'])) {
      $pattern = '/\{theme\.([\w\-]+)\}/';
      while(preg_match($pattern, $doc)) {
        $doc = preg_replace_callback($pattern, function ($matches) {
          $name = $matches[1];
          global $ws;
	        if(isset($ws['ThemeConsts'][$name])) return $ws['ThemeConsts'][$name];
	        return '&#123;theme.' . $name . '&#125;';
        }, $doc);
      }
    }
    
    return preg_match('/\{[^\s][^\.]*\}/', $doc) ? trasncluder_process($doc) : $doc;
  }
?>