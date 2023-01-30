<?php
namespace Plugin\Cacher;

function get_filename($pagename, $language, $theme)
{
  global $ws;
  return $ws['PATH_CACHE'] . str_replace('/', '_', $pagename) . '$' . $language . '$' . $theme . '.html';
}

function cached($pagename, $language, $theme)
{
  return file_exists(get_filename($pagename, $language, $theme));
}

function stale($pagename, $language, $theme)
{
  global $ws;
  $filename = get_filename($pagename, $language, $theme);
  if (!file_exists($filename))
    return false;

  $pagepath = $ws['PATH_CONTENT'] . $language . '/' . $pagename;
  if (!file_exists($pagepath))
    return true;
  if (!is_dir($pagepath))
    return true;

  $dir = opendir($pagepath);
  while ($sect = readdir($dir))
    if (preg_match('/^(\d{3})-([\w-]+).html$/', $sect))
      if (filemtime($filename) < filemtime($pagepath . '/' . $sect))
        return true;

  return false;
}

function get($pagename, $language, $theme)
{
  if (cached($pagename, $language, $theme))
    return file_get_contents(get_filename($pagename, $language, $theme));
  return false;
}

function put($pagename, $language, $theme, $doc)
{
  global $ws;

  $filename = get_filename($pagename, $language, $theme);
  if (file_exists($filename))
    unlink($filename);
  $doc .= "\r\n" . '<!-- ' . $ws['lang']['cached'];
  $doc .= date(' j ') . $ws['lang']['months']['genitive'][date('n') - 1] . date(' o, H:i:s T');
  $doc .= '. -->';
  file_put_contents($filename, $doc);
}

function clear($pagename, $language, $theme)
{
  if (cached($pagename, $language, $theme))
    unlink(get_filename($pagename, $language, $theme));
}
?>