<?php
$pl_initialize = function () {
  // Przekieruj na połączenie szyfrowane
  if ($_SERVER['HTTP_HOST'] == 'www.celones.pl')
    if (!Session\archaic_agent() || preg_match('/MSIE (9|10)/', $_SERVER['HTTP_USER_AGENT'])) {
      header("Location: https://celones.pl" . $_SERVER['REQUEST_URI'], true, 301);
      exit();
    }
};
?>