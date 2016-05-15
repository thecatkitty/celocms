<?php
  function get_cached_name($pagename, $language, $theme) {
    global $ws;
    return $ws['PATH_CACHE'] . str_replace('/', '_', $pagename) . '$' . $language . '$' . $theme . '.html';
  }
  
  function in_cache($pagename, $language, $theme) {
    global $ws;
    $filename = get_cached_name($pagename, $language, $theme);
    if(!file_exists($filename)) return false;
    if(time() - $ws['CacheTime'] > filemtime($filename)) return false;
    return true;
  }
  
  function get_cached($pagename, $language, $theme) {
    if(in_cache($pagename, $language, $theme))
      return file_get_contents(get_cached_name($pagename, $language, $theme));
    return false;
  }
  
  function put_cached($pagename, $language, $theme, $doc) {
    global $lang;
    $filename = get_cached_name($pagename, $language, $theme);
    if(file_exists($filename)) unlink($filename);
    $doc .= "\r\n" . '<!-- ' . $lang['cached'];
    $doc .= date(' j ') . $lang['months']['genitive'][date('n')-1] . date(' o, H:i:s T');
    $doc .= '. -->';
    file_put_contents($filename, $doc);
  }
?>