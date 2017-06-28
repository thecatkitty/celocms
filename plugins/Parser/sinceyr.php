<?php
  $pf_name = 'sinceyr';

  $pf_handler = function($arg) {
    if($arg == date('Y')) return $arg;
    return $arg . '-' . date('Y');
  };
?>