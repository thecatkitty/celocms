<?php
  function get_tree_value($arr, $path) {
    $dest = $arr;
    $finalKey = array_pop($path);
    foreach ($path as $key) {
      if(isset($dest[$key]))
        $dest = $dest[$key];
      else return NULL;
    }
    return $dest[$finalKey];
  }

  function get_dotted_value($arr, $path) {
    $toks = explode('.', $path);
    return get_tree_value($arr, $toks);
  }
?>