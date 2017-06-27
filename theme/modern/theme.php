<?php
  function theme_section($section) {
    global $ws;
    
    echo '<section id="' . $section->id . '" class="' . $section->classes . '">';
    echo file_get_contents($section->filename);
    echo '</section>';
  }
  
  function theme_process($doc) {
    return $doc;
  }
  
  $wspex['MainMenu'] = function($param) {
    global $page;
    global $ws;
    global $menu;
    
    $ret = '';
    foreach($menu as $item) {
      $add = '';
      if($item['href'] == $ws['Page']) $add = ' class="thispage"';
      $ret .= '<li' . $add . '><a href="' . $ws['PATH_ROOT'] . $item['href'] . '">' .$item['title'] . '</a></li>';
      if($add != '') $ret .= '{?PageMenu ?}';
    }
    if(!strpos($ret, '{?PageMenu ?}'))
      $ret .= '<li class="thispage"><a>' .$page->title . '</a></li>' . '{?PageMenu ?}';
    return $ret;
  };
  
  $pagemenu = false;
  $wspex['PageMenu'] = function($param) {
    global $page;
    global $pagemenu;
    
    $ret = '';
    if(!$pagemenu) {
      $pagemenu = true;
      foreach($page->sections as $i => $section) {
        if($section->short != '') 
          $ret .= '<li class="local"><a class="smoothscroll" href="#' . $section->id . '">' . $section->short . '</a></li>';
      }
    }
    
    return $ret;
  };
  
  $wspex['LangMenu'] = function($str) {
    global $ws;
      
    $ret = '';
    $langs = explode('|', $ws['Languages']);
    foreach($langs as $i => $l) {
      if($i) $ret .= '| ';
      $ll = json_decode(file_get_contents($ws['PATH_LOCALE'] . $l . '.json'), true);
      $ret .= '<a href="' . $ws['PATH_ROOT'] . $ws['Page'] . '?lang=' . $l . '">' . $ll['name'] . '</a> ';
    }
    return $ret;
  };
  
  $wspex['SocialMenu'] = function($param) {
    global $ws;
    
    $ret = '';
    foreach($ws['Social'] as $name => $href) {
      $ret .= '<li><a href="' . $href . '">';
      if($param == 'icon') $ret .= '<i class="fa fa-';
      $ret .= $name;
      if($param == 'icon') $ret .= '"></i>';
      $ret .= '</a></li>';
    }
    return $ret;
  };

  $ws['ThemeConsts'] = array(
    'halfwidth' => 'six columns',
    'fullwidth' => 'twelve columns',
    'button' => 'button'
  );
?>