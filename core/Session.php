<?php
  function session_forced($name) {
    return isset($_GET[$name]) || isset($_SESSION[$name]);
  }

  function session_get_forced($name, $default = false) {
    if(!session_forced($name)) return $default;
    if(isset($_GET[$name]))
      $_SESSION[$name] = $_GET[$name];
    return $_SESSION[$name];
  }
  
  function session_archaic_agent() {
    if($_SERVER['SERVER_PROTOCOL'] == 'HTTP/1.0')
      return true;

    if(!preg_match("/Trident|Gecko|Opera\/9|bot|spider|crawl|slurp/", $_SERVER['HTTP_USER_AGENT']))
      return true;

    return false;
  }
?>