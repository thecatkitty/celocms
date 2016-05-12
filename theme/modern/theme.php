<?php
  function emit_section($section) {
    global $ws;
    
    echo '<section id="' . $section->id . '" class="' . $section->classes . '">';
    echo file_get_contents($section->filename);
    echo '</section>';
  }
  
  function endify($doc) {
    return $doc;
  }
  
  $wsp['MainMenu'] = function($param) {
    global $page;
    global $ws;
    global $menu;
    
    $ret = '';
    foreach($menu as $item) {
      $add = '';
      if($item['href'] == $ws['Page']) $add = ' style="color: white"';
      $ret .= '<li><a href="' . $ws['PATH_ROOT'] . $item['href'] . '"' . $add . '>' .$item['title'] . '</a></li>';
      if($add != '') $ret .= '{?PageMenu ?}';
    }
    if(!strpos($ret, '{?PageMenu ?}'))
      $ret .= '<li><a style="color: white">' .$page->title . '</a></li>' . '{?PageMenu ?}';
    return $ret;
  };
  
  $pagemenu = false;
  $wsp['PageMenu'] = function($param) {
    global $page;
    global $pagemenu;
    
    $ret = '';
    if(!$pagemenu) {
      $pagemenu = true;
      foreach($page->sections as $i => $section) {
        if($section->short != '') 
          $ret .= '<li><a class="smoothscroll" href="#' . $section->id . '">' . $section->short . '</a></li>';
      }
    }
    
    return $ret;
  };
  
  $wsp['SocialMenu'] = function($param) {
    global $ws;
    
    $ret = '';
    foreach($ws['Social'] as $name => $href) {
      $ret .= '<li><a href="' . $href . '"><i class="fa fa-' . $name . '"></i></a></li>';
    }
    return $ret;
  };
?>