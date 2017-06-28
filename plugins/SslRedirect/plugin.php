<?php
  $pl_initialize = function() {
    // Przekieruj na połączenie szyfrowane
    if($_SERVER['HTTP_HOST'] == 'www.celones.pl')
      if(!Session\archaic_agent()) {
        header("Location: https://celones.pl" . $_SERVER['REQUEST_URI'], true, 301);
        exit();
      }
  };
?>