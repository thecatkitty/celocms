<?php
  $pf_name = 'sinceyr';

  $pf_handler = function($args) {
    $year = $args[0];
    
    if($year == date('Y')) return $year;
    return $year . '-' . date('Y');
  };
?>