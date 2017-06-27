<?php
  $pf_name = 'notarchaic';

  $pf_handler = function($arg) {
    global $ws;
      
    if($ws['Theme'] != 'archaic') return $arg;
    return '';
  };
?>