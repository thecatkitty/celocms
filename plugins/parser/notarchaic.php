<?php
  $pex_name = 'notarchaic';

  $pex_handler = function($arg) {
    global $ws;
      
    if($ws['Theme'] != 'archaic') return $arg;
    return '';
  };
?>