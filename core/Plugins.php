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
    
    'langmenu' => function($str) {
      global $ws;
      
      $ret = '';
      $langs = explode('|', $ws['Languages']);
      foreach($langs as $i => $l) {
        if($i) $ret .= '| ';
        $ret .= '<a href="' . $ws['PATH_ROOT'] . $ws['Page'] . '?lang=' . $l . '">' . $l . '</a> ';
      }
      return $ret;
    },
  );
?>