<?php
  date_default_timezone_set('Europe/Warsaw');
  
  $ws = array(
    // Postawowe informacje o witrynie
    //'SiteName' => '',
    'SiteAuthor' => 'Mateusz Karcz',
    
    // Informacje do stopki
    //'Address' => '',
    'Contact' => 'kontakt(at)celones.pl',
    'Social' => array(
      'facebook' => 'https://www.facebook.com/pages/Projekt-Matriksoft-Oprogramowanie/478939018949835'
    ),
    //'FooterText' => '',
    //'Copyright' => '',
    
    // Ustawienia
    'Theme' => 'modern',
    'HomePage' => 'home',
    'Languages' => 'pl|en|pl-kociewie|la',
    'Language' => 'pl',
    'CacheTime' => 18000,
    
    // Ścieżki systemowe
    'PATH_ROOT' => str_replace('index.php', '', $_SERVER['PHP_SELF']),
    
    'PATH_CORE' => 'core/',
    'PATH_IMAGES' => 'images/',
    'PATH_SCRIPTS' => 'js/',
    'PATH_CONTENT' => 'text/',
    'PATH_THEME' => 'theme/',
    'PATH_LOCALE' => 'locale/',
    'PATH_CACHE' => 'cache/'
  );
?>