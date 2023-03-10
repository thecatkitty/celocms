<?php
  namespace Theme;

  function section($section) {
    global $ws;
    
    echo '<section id="' . $section->id . '" class="container ' . $section->classes . '">';
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
    }
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
          $ret .= '<li><a class="smoothscroll" href="#' . $section->id . '">' . $section->short . '</a></li>';
        else
          $ret .= '<li class="hidden"><a class="smoothscroll" href="#' . $section->id . '"></a></li>';
      }
    }
    
    return $ret;
  };
  
  $wspf['LangMenu'] = function($str) {
    global $ws;
      
    $ret = '<div class="dropup">'
         . '<button class="btn btn-sm dropdown-toggle" type="button" data-toggle="dropdown">{{lang.language}}: {{lang.name}} <span class="caret"></span></button>'
         . '<ul class="dropdown-menu">';

    foreach($ws['Languages'] as $i => $l) {
      $ll = json_decode(file_get_contents($ws['PATH_LOCALE'] . $l . '.json'), true);
      $ret .= '<li class="small"><a href="' . $ws['PATH_ROOT'] . $ws['Page'] . '?lang=' . $l . '">' . $ll['name'] . '</a></li>';
    }

    $ret .= '</ul></div>';
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
    'halfwidth' => 'col-xs-12 col-sm-6',
    'fullwidth' => 'col-xs-12',
    'button' => 'btn btn-default'
  );
?>