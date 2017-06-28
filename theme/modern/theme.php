<?php
  namespace Theme;
  
  function section($section) {
    global $ws;
    
    echo '<section id="' . $section->id . '" class="' . $section->classes . '">';
    echo file_get_contents($section->filename);
    echo '</section>';
  }
  
  function process() { }
  
  $wspf['MainMenu'] = function($param) {
    global $page;
    global $ws;
    
    $ret = '';
    foreach($ws['menu'] as $item) {
      $add = '';
      if($item['href'] == $ws['Page']) $add = ' class="thispage"';
      $ret .= '<li' . $add . '><a href="' . $ws['PATH_ROOT'] . $item['href'] . '">' .$item['title'] . '</a></li>';
      if($add != '') $ret .= '{{#PageMenu: }}';
    }
    if(!strpos($ret, '{{#PageMenu: }}'))
      $ret .= '<li class="thispage"><a>' .$page->title . '</a></li>' . '{{#PageMenu: }}';
    return $ret;
  };
  
  $pagemenu = false;
  $wspf['PageMenu'] = function($param) {
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
  
  $wspf['LangMenu'] = function($str) {
    global $ws;
      
    $ret = '';
    foreach($ws['Languages'] as $i => $l) {
      if($i) $ret .= '| ';
      $ll = json_decode(file_get_contents($ws['PATH_LOCALE'] . $l . '.json'), true);
      $ret .= '<a href="' . $ws['PATH_ROOT'] . $ws['Page'] . '?lang=' . $l . '">' . $ll['name'] . '</a> ';
    }
    return $ret;
  };
  
  $wspf['SocialMenu'] = function($args) {
    global $ws;
    
    $ret = '';
    $style = $args[0];
    foreach($ws['Social'] as $name => $href) {
      $ret .= '<li><a href="' . $href . '">';
      if($style == 'icon') $ret .= '<i class="fa fa-';
      $ret .= $name;
      if($style == 'icon') $ret .= '"></i>';
      $ret .= '</a></li>';
    }
    return $ret;
  };

  $ws['theme'] = array(
    'halfwidth' => 'six columns',
    'fullwidth' => 'twelve columns',
    'button' => 'button'
  );
?>