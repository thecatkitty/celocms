<?php
  header('Content-Type: text/html; charset=US-ASCII');
  
  function theme_section($section) {
    global $ws;
    
    echo '<a name="' . $section->id . '"></a>';
    echo '<div>';
    echo file_get_contents($section->filename);
    echo '</div>';
    echo '<hr>';
  }
  
  require_once('dediacritizer.php');
  function theme_process($doc) {
    // Usuń "ogonki"
    $doc = str_remove_diacritics($doc);
    
    // Zamień odwołania do PNG na GIF
    $pattern = '/<img([^<>]*) src="([\w\/-]+)\.png"/';
    while(preg_match($pattern, $doc))
      $doc = preg_replace($pattern, '<img${1} src="${2}.gif"', $doc);
    
    // Zamień tagi XHTML na HTML
    $pattern = '/<(img|br)([^<>]*)\/>/';
    while(preg_match($pattern, $doc))
      $doc = preg_replace($pattern, '<${1}${2}>', $doc);

    // Usuń niewspierane atrybuty
    $pattern = '/<([^<>]+) ((lang|id|class|title)="[^<>"]+")([^<>]*)>/s';
    while(preg_match($pattern, $doc))
      $doc = preg_replace($pattern, '<${1}${4}>', $doc);
    
    // Usuń obramowania linków obrazkowych
    $pattern = '/(<a[^<>]* href="[^<>]+"[^<>]*>.*<img[^<>]*)[^"]>(.*)<\/a>/s';
    while(preg_match($pattern, $doc))
      $doc = preg_replace($pattern, '${1} border="0">${2}</a>', $doc);
    
    // Zwróć wynik
    return $doc;
  }
  
  $wspf['MainMenu'] = function($param) {
    global $page;
    global $ws;
    global $menu;
    
    $ret = '';
    foreach($menu as $i => $item) {
      if($i) $ret .= ' | ';
      $ret .= '<a href="' . $ws['PATH_ROOT'] . $item['href'] . '">' . $item['title'] . '</a>';
    }
    return $ret;
  };
  
  $wspf['PageMenu'] = function($param) {
    global $page;
    
    $ret = '';
    $first = true;
    if(!count($page->sections))
      $ret .= '<b>{lang.archaic.jumpto}:</b> ';
    foreach($page->sections as $i => $section) {
      if($section->short != '') {
        if($first) $first = false;
        else $ret .= ' | ';
        $ret .= '<a href="#' . $section->id . '">' . $section->short . '</a>';
      }
      
    }
    return $ret;
  };
  
  $wspf['LangMenu'] = function($str) {
    global $ws;
      
    $ret = '';
    $langs = explode('|', $ws['Languages']);
    foreach($langs as $i => $l) {
      if($i) $ret .= '| ';
      $ret .= '<a href="' . $ws['PATH_ROOT'] . $ws['Page'] . '?lang=' . $l . '">' . $l . '</a> ';
    }
    return $ret;
  };
?>