<?php
  $pl_initialize = function() {
    global $ws;
    
    // Negocjuj język
    if(Session\is_forced('lang'))
      if(Localizer\language_available(Session\get_forced('lang')))
        $ws['Language'] = Session\get_forced('lang');

    if(isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
      $acc_langs = explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE']);
      foreach($acc_langs as $al) {
        $al = preg_replace('/^([a-z]{2,3})(-[a-zA-Z]+)*$/', '$1', $al);
        foreach($ws['Languages'] as $l)
          if($al == $l) {
            if(Localizer\language_available($al))
              $ws['Language'] = $al;
            return;
          }
      }
    }
  };
?>