<?php
$pf_name = 'thimg';

$pf_handler = function ($args) {
  global $ws;
  $img = $args[0];

  $override_url = $ws['PATH_IMAGES'] . $ws['Theme'] . '/' . $img;
  if (file_exists($override_url))
    return $ws['PATH_ROOT'] . $override_url;

  return $ws['URL_THEME'] . $ws['Theme'] . '/img/' . $img;
};
?>