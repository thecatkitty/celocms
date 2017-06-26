<?php
  $lang = array();
  
  function localizer_set_language($code) {
    global $ws;
    global $lang;
    
    if(!preg_match('/^[\w-]+$/', $code)) return false;
    $filename = $ws['PATH_LOCALE'] . $code . '.json';
    if(!file_exists($filename)) return false;
    $lang = json_decode(file_get_contents($filename), true);
    
    if(isset($lang['config'])) foreach($lang['config'] as $key => $value)
      $ws[$key] = $value;
      
    return true;
  }
  
  function get_tree_value($arr, $path) {
    $dest = $arr;
    $finalKey = array_pop($path);
    foreach ($path as $key) {
      $dest = $dest[$key];
    }
    return $dest[$finalKey];
  }

  
  function localizer_get_text($str) {
    global $lang;
    
    $toks = explode('.', $str);
    $ret = get_tree_value($lang, $toks);
    
    return $ret;
  }
  
  function localizer_process($doc) {
    $pattern = '/\{lang\.([\w\.-]+)\}/';
    while(preg_match($pattern, $doc)) {
      $doc = preg_replace_callback($pattern, function ($matches) {
        return localizer_get_text($matches[1]);
      }, $doc);
    }
    return $doc;
  }
?>