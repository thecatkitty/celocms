<?php
$pl_initialize = function () {
  // Przekieruj na połączenie szyfrowane
  if (substr($_SERVER['HTTP_HOST'], 0, 4) == 'www.')
    if (!Session\archaic_agent() || preg_match('/MSIE (9|10)/', $_SERVER['HTTP_USER_AGENT'])) {
      header("Location: https://" . substr($_SERVER['HTTP_HOST'], 4) . $_SERVER['REQUEST_URI'], true, 301);
      exit();
    }
};
?>