<?php
  $menu = array();
  
  function load_menu() {
    global $ws;
    global $lang;
    global $menu;
    
    $menu = json_decode(file_get_contents($ws['PATH_CONTENT'] . 'menu.json'), true);
    $menu = $menu[$lang['code']];
  }
?>