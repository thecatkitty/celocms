<?php
$pl_initialize = function () {
  global $ws;

  // Negocjuj motyw
  $ws['Theme'] = Session\get_forced('theme', Session\archaic_agent() ? 'archaic' : $ws['Theme']);
  $ws['ThemePath'] = $ws['PATH_THEME'] . $ws['Theme'] . '/';
  if (!file_exists($ws['ThemePath'] . 'theme.php')) {
    $ws['Theme'] = 'archaic';
    $ws['ThemePath'] = $ws['PATH_THEME'] . $ws['Theme'] . '/';
    $_SESSION['theme'] = 'archaic';
  }

  if ($ws['URL_THEME'][0] != '/') {
    $ws['URL_THEME'] = $ws['PATH_ROOT'] . $ws['URL_THEME'];
  }
};
?>