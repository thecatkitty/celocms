<?php
  $ws['lang'] = array();
  
  function localizer_load_language($code) {
    global $ws;
    
    if(!preg_match('/^[\w-]+$/', $code)) return false;
    $filename = $ws['PATH_LOCALE'] . $code . '.json';
    if(!file_exists($filename)) return false;
    $ws['lang'] = json_decode(file_get_contents($filename), true);
    
    if(isset($ws['lang']['config'])) {
      foreach($ws['lang']['config'] as $key => $value)
        $ws[$key] = $value;
      unset($ws['lang']['config']);
    }
      
    return true;
  }
?>