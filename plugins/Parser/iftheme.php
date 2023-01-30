<?php
$pf_name = 'iftheme';

$pf_handler = function ($args) {
  global $ws;

  $cond = $args[0];
  $cont = $args[1];

  if (!preg_match('/(?P<not>not\s)?(?P<name>\w+)/', $cond, $matches))
    return '&#123;&#123;#iftheme error&#125;&#125;';

  $result = $ws['Theme'] == $matches['name'];
  if (isset($matches['not']))
    $result = !$result;

  if ($result)
    return $cont;
  return '';
};
?>