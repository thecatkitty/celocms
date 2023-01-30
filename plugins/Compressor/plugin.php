<?php
$pl_finish = function () {
  global $ws;
  global $content;

  // Usuń zbędne dodatkowe spacje
  $pattern = '/>\s\s+/s';
  while (preg_match($pattern, $content))
    $content = preg_replace($pattern, '> ', $content);
  $pattern = '/\s\s+</s';
  while (preg_match($pattern, $content))
    $content = preg_replace($pattern, ' <', $content);

  // Usuń komentarze
  $pattern = '/<!---?\s+[^<>]*-->/';
  while (preg_match($pattern, $content))
    $content = preg_replace($pattern, '', $content);

  return true;
};
?>