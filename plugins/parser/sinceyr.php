<?php
  $pex_name = 'sinceyr';

  $pex_handler = function($arg) {
    if($arg == date('Y')) return $arg;
    return $arg . '-' . date('Y');
  };
?>