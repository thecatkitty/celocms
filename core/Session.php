<?php
  function nachama($name) {
    return isset($_GET[$name]);
  }

  function get_nachama($name, $default = false) {
    return nachama($name) ? $_GET[$name] : $default;
  }
  
  function ishttp1() {
    return $_SERVER['SERVER_PROTOCOL'] == 'HTTP/1.0';
  }
?>