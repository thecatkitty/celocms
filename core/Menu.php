<?php
  $menu = array();
  
  function menu_load() {
    global $ws;
    global $menu;
    
    $menu = json_decode(file_get_contents($ws['PATH_CONTENT'] . 'menu.json'), true);
    $menu = $menu[$ws['lang']['code']];
  }
?>