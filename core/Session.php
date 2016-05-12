<?php
  function nachama($name) {
    return isset($_GET[$name]) || isset($_SESSION[$name]);
  }

  function get_nachama($name, $default = false) {
    if(!nachama($name)) return $default;
    
    if(!isset($_SESSION[$name]))
      $_SESSION[$name] = $_GET[$name];
      
    return $_SESSION[$name];
  }
  
  function ishttp1() {
    return $_SERVER['SERVER_PROTOCOL'] == 'HTTP/1.0';
  }
?>