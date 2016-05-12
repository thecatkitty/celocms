<?php
  $lang = array();
  
  function set_language($code) {
    global $ws;
    global $lang;
    
    $filename = $ws['PATH_LOCALE'] . $code . '.json';
    if(!file_exists($filename)) return false;
    $lang = json_decode(file_get_contents($filename), true);
    
    if(isset($lang['config'])) foreach($lang['config'] as $key => $value)
      $ws[$key] = $value;
      
    return true;
  }
  
  function getValueFromPath($arr, $path) {
    $dest = $arr;
    $finalKey = array_pop($path);
    foreach ($path as $key) {
      $dest = $dest[$key];
    }
    return $dest[$finalKey];
  }

  
  function get_lang($str) {
    global $lang;
    
    $toks = explode('.', $str);
    $ret = getValueFromPath($lang, $toks);
    
    return $ret;
  }
  
  function localize($doc) {
    $pattern = '/\{lang\.([\w\.-]+)\}/';
    while(preg_match($pattern, $doc)) {
      $doc = preg_replace_callback($pattern, function ($matches) {
        return get_lang($matches[1]);
      }, $doc);
    }
    return $doc;
  }
?>