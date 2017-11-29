<?php
  namespace Session;

  function is_forced($name) {
    return isset($_GET[$name]) || isset($_SESSION[$name]);
  }

  function get_forced($name, $default = false) {
    if(!is_forced($name)) return $default;
    if(isset($_GET[$name]))
      $_SESSION[$name] = $_GET[$name];
    return $_SESSION[$name];
  }
  
  function archaic_agent() {
    if($_SERVER['SERVER_PROTOCOL'] == 'HTTP/1.0')
      return true;

    if(preg_match('/MSIE [1-8]\.0/'))
      return true;

    if(!preg_match('/Trident|Gecko|Opera\/9|bot|spider|crawl|slurp|facebook/', $_SERVER['HTTP_USER_AGENT']))
      return true;

    return false;
  }
?>