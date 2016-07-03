<?php
  function nachama($name) {
    return isset($_GET[$name]) || isset($_SESSION[$name]);
  }

  function get_nachama($name, $default = false) {
    if(!nachama($name)) return $default;
    if(isset($_GET[$name]))
      $_SESSION[$name] = $_GET[$name];
    return $_SESSION[$name];
  }
  
  function isarchaic() {
    if($_SERVER['SERVER_PROTOCOL'] == 'HTTP/1.0')
      return true;

    if(!preg_match("/Trident|Gecko/", $_SERVER['HTTP_USER_AGENT']))
      return true;
  }
?>