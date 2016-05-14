<?php
  $wsp = array(
    'sinceyr' => function($y) {
	    if($y == date('Y')) return $y;
	    return $y . '-' . date('Y');
    },
    
    'notarchaic' => function($str) {
      global $ws;
      
      if($ws['Theme'] != 'archaic') return $str;
      return '';
    },
  );
?>