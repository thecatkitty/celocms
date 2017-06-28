<?php
  require_once('functions.php');
  
  $pl_initialize = function() {
    global $ws;

    $ws['Cache'] = Session\get_forced('cache', true);
  };

  $pl_render = function() {
    global $ws;
    global $content;

    if($ws['Cache'] && Plugin\Cacher\cached($ws['Page'], $ws['lang']['code'], $ws['Theme'])) {
      if(Plugin\Cacher\stale($ws['Page'], $ws['lang']['code'], $ws['Theme'])) {
        Plugin\Cacher\clear($ws['Page'], $ws['lang']['code'], $ws['Theme']);
        return false;
      }
      
      $content = Plugin\Cacher\get($ws['Page'], $ws['lang']['code'], $ws['Theme']);
      return true;
    }
    return false;
  };

  $pl_finish = function() {
    global $ws;
    global $content;

    if($ws['Page'] != 'error' && $ws['Cache'] && !Plugin\Cacher\cached($ws['Page'], $ws['lang']['code'], $ws['Theme']))
      Plugin\Cacher\put($ws['Page'], $ws['lang']['code'], $ws['Theme'], $content);
  };
?>