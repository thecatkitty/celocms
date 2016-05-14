<?php
  function emit_section($section) {
    global $ws;
    
    echo '<a name="' . $section->id . '"></a>';
    echo '<div>';
    echo file_get_contents($section->filename);
    echo '</div>';
    echo '<hr>';
  }
  
  function endify($doc) {
    static $map = [
      // Rozszerzona łacinka
      'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'ą' => 'a', 'å' => 'a', 'ā' => 'a', 'ă' => 'a', 'ǎ' => 'a', 'ǻ' => 'a', 'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Ą' => 'A', 'Å' => 'A', 'Ā' => 'A', 'Ă' => 'A', 'Ǎ' => 'A', 'Ǻ' => 'A',
      'ç' => 'c', 'ć' => 'c', 'ĉ' => 'c', 'ċ' => 'c', 'č' => 'c', 'Ç' => 'C', 'Ć' => 'C', 'Ĉ' => 'C', 'Ċ' => 'C', 'Č' => 'C',
      'ď' => 'd', 'đ' => 'd', 'Ð' => 'D', 'Ď' => 'D', 'Đ' => 'D',
      'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ę' => 'e', 'ē' => 'e', 'ĕ' => 'e', 'ė' => 'e', 'ě' => 'e', 'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ę' => 'E', 'Ē' => 'E', 'Ĕ' => 'E', 'Ė' => 'E', 'Ě' => 'E',
      'ƒ' => 'f',
      'ĝ' => 'g', 'ğ' => 'g', 'ġ' => 'g', 'ģ' => 'g', 'Ĝ' => 'G', 'Ğ' => 'G', 'Ġ' => 'G', 'Ģ' => 'G',
      'ĥ' => 'h', 'ħ' => 'h', 'Ĥ' => 'H', 'Ħ' => 'H',
      'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 'ĩ' => 'i', 'ī' => 'i', 'ĭ' => 'i', 'į' => 'i', 'ſ' => 'i', 'ǐ' => 'i', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 'Ĩ' => 'I', 'Ī' => 'I', 'Ĭ' => 'I', 'Į' => 'I', 'İ' => 'I', 'Ǐ' => 'I',
      'ĵ' => 'j', 'Ĵ' => 'J',
      'ķ' => 'k', 'Ķ' => 'K',
      'ł' => 'l', 'ĺ' => 'l', 'ļ' => 'l', 'ľ' => 'l', 'ŀ' => 'l', 'Ł' => 'L', 'Ĺ' => 'L', 'Ļ' => 'L', 'Ľ' => 'L', 'Ŀ' => 'L',
      'ñ' => 'n', 'ń' => 'n', 'ņ' => 'n', 'ň' => 'n', 'ŉ' => 'n', 'Ñ' => 'N', 'Ń' => 'N', 'Ņ' => 'N', 'Ň' => 'N',
      'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ð' => 'o', 'ø' => 'o', 'ō' => 'o', 'ŏ' => 'o', 'ő' => 'o', 'ơ' => 'o', 'ǒ' => 'o', 'ǿ' => 'o', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ø' => 'O', 'Ō' => 'O', 'Ŏ' => 'O', 'Ő' => 'O', 'Ơ' => 'O', 'Ǒ' => 'O', 'Ǿ' => 'O',
      'ŕ' => 'r', 'ŗ' => 'r', 'ř' => 'r', 'Ŕ' => 'R', 'Ŗ' => 'R', 'Ř' => 'R',
      'ś' => 's', 'š' => 's', 'ŝ' => 's', 'ş' => 's', 'Ś' => 'S', 'Š' => 'S', 'Ŝ' => 'S', 'Ş' => 'S',
      'ţ' => 't', 'ť' => 't', 'ŧ' => 't', 'Ţ' => 'T', 'Ť' => 'T', 'Ŧ' => 'T',
      'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ũ' => 'u', 'ū' => 'u', 'ŭ' => 'u', 'ů' => 'u', 'ű' => 'u', 'ų' => 'u', 'ư' => 'u', 'ǔ' => 'u', 'ǖ' => 'u', 'ǘ' => 'u', 'ǚ' => 'u', 'ǜ' => 'u', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ũ' => 'U', 'Ū' => 'U', 'Ŭ' => 'U', 'Ů' => 'U', 'Ű' => 'U', 'Ų' => 'U', 'Ư' => 'U', 'Ǔ' => 'U', 'Ǖ' => 'U', 'Ǘ' => 'U', 'Ǚ' => 'U', 'Ǜ' => 'U',
      'ŵ' => 'w', 'Ŵ' => 'W',
      'ý' => 'y', 'ÿ' => 'y', 'ŷ' => 'y', 'Ý' => 'Y', 'Ÿ' => 'Y', 'Ŷ' => 'Y',
      'ż' => 'z', 'ź' => 'z', 'ž' => 'z', 'Ż' => 'Z', 'Ź' => 'Z', 'Ž' => 'Z',

      'Æ' => 'AE', 'æ' => 'ae', 'Ǽ' => 'AE', 'ǽ' => 'ae', 'Œ' => 'OE', 'œ' => 'oe', 
	  
	  // Interpunkcja
	  '„' => '"', '”' => '"',
	  
	  // Symbole
	  '©' => '(C)', '®' => '(R)', '™' => '(TM)', 
    ];
    
    // Usuń "ogonki"
    $doc = strtr($doc, $map);
    
    // Zamień odwołania do PNG na GIF
    $pattern = '/<img([^<>]*) src="([\w\/-]+)\.png"/';
    while(preg_match($pattern, $doc))
      $doc = preg_replace($pattern, '<img${1} src="${2}.gif"', $doc);
    
    // Zamień tagi XHTML na HTML
    $pattern = '/<(img|br)([^<>]*)\/>/';
    while(preg_match($pattern, $doc))
      $doc = preg_replace($pattern, '<${1}${2}>', $doc);
    
    // Usuń obramowania linków obrazkowych
    $pattern = '/(<a[^<>]* href="[^<>]+"[^<>]*>.*<img[^<>]*)[^"]>(.*)<\/a>/s';
    while(preg_match($pattern, $doc))
      $doc = preg_replace($pattern, '${1} border="0">${2}</a>', $doc);
    
    // Zwróć wynik
    return $doc;
  }
  
  $wsp['MainMenu'] = function($param) {
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
  
  $wsp['PageMenu'] = function($param) {
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
?>