<?php
  function cacher_get_filename($pagename, $language, $theme) {
    global $ws;
    return $ws['PATH_CACHE'] . str_replace('/', '_', $pagename) . '$' . $language . '$' . $theme . '.html';
  }
  
  function cacher_cached($pagename, $language, $theme) {
    global $ws;
    $filename = cacher_get_filename($pagename, $language, $theme);
    if(!file_exists($filename)) return false;
    if(time() - $ws['CacheTime'] > filemtime($filename)) return false;
    return true;
  }
  
  function cacher_get($pagename, $language, $theme) {
    if(cacher_cached($pagename, $language, $theme))
      return file_get_contents(cacher_get_filename($pagename, $language, $theme));
    return false;
  }
  
  function cacher_put($pagename, $language, $theme, $doc) {
    global $ws;
    
    $filename = cacher_get_filename($pagename, $language, $theme);
    if(file_exists($filename)) unlink($filename);
    $doc .= "\r\n" . '<!-- ' . $ws['lang']['cached'];
    $doc .= date(' j ') . $ws['lang']['months']['genitive'][date('n')-1] . date(' o, H:i:s T');
    $doc .= '. -->';
    file_put_contents($filename, $doc);
  }
?>