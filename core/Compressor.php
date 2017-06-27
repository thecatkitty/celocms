<?php
  function compressor_minimize_html($html) {
    // Usuń zbędne dodatkowe spacje
    $pattern = '/>\s\s+</s';
    while(preg_match($pattern, $html))
      $html = preg_replace($pattern, '> <', $html);
    
    // Usuń komentarze
    $pattern = '/<!---?\s+[^<>]*-->/';
    while(preg_match($pattern, $html))
      $html = preg_replace($pattern, '', $html);
    
    return $html;
  }
?>