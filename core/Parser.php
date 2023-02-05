<?php
namespace Parser;

function load_extensions()
{
  global $ws;
  global $wspf;

  // Załaduj rozszerzenia parsera.
  $dir = opendir($ws['PATH_PLUGINS'] . 'Parser');
  while ($filename = readdir($dir))
    if (preg_match('/^(\w+).php$/', $filename, $matches) && $filename != 'plugin.php') {
      include_once($ws['PATH_PLUGINS'] . 'Parser/' . $matches[1] . '.php');

      $wspf[$pf_name] = $pf_handler;
    }
}

function get_value($arr, $path)
{
  $toks = explode('.', $path);

  $dest = $arr;
  $finalKey = array_pop($toks);
  foreach ($toks as $key) {
    if (isset($dest[$key]))
      $dest = $dest[$key];
    else
      return NULL;
  }
  return $dest[$finalKey];
}

function process()
{
  global $content;
  // Przetwórz wywołania funkcyj parsera.
  $pattern = '/\{\{#(?P<name>\w+): (?P<args>.*?)\}\}/';
  while (preg_match($pattern, $content)) {
    $content = preg_replace_callback($pattern, function ($matches) {
      global $wspf;

      $name = $matches['name'];
      $args = explode('|', $matches['args']);

      if (isset($wspf[$name]))
        return call_user_func($wspf[$name], $args);
      return '&#123;&#123;#' . $name . ': ' . $matches['args'] . '&#125;&#125;';
    }, $content);
  }

  // Zamień zmienne.
  $pattern = '/\{\{(?P<path>[\w\.-]+)\}\}/';
  while (preg_match($pattern, $content)) {
    $content = preg_replace_callback($pattern, function ($matches) {
      $name = $matches[1];
      global $ws;
      $value = get_value($ws, $matches['path']);
      if (isset($value))
        return $value;
      return '&#123;&#123;' . $matches['path'] . '&#125;&#125;';
    }, $content);
  }

  if (preg_match('/\{\{[^\s][^\.]*\}\}/', $content))
    process();
}
?>