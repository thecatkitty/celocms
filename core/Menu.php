<?php
  namespace Menu;
  
  $ws['menu'] = array();
  
  function load() {
    global $ws;
    
    $ws['menu'] = json_decode(file_get_contents($ws['PATH_CONTENT'] . 'menu.json'), true);
    $ws['menu'] = $ws['menu'][$ws['lang']['code']];
  }
?>