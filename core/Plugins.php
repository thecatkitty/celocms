<?php
  namespace Plugins;
  
  class Plugin {
    public $package_manifest;
	
	public $cb_initialize;
    public $cb_render;
    public $cb_finish;

    public function __construct() {
      if(func_num_args()) {
        $filename = func_get_arg(0);
        if(file_exists($filename))
          $this->package_manifest = json_decode(file_get_contents($filename));
      }
    }

    public function initialize() {
      if(isset($this->cb_initialize))
        return call_user_func($this->cb_initialize);
      return false;
    }

    public function render() {
      if(isset($this->cb_render))
        return call_user_func($this->cb_render);
      return false;
    }

    public function finish() {
      if(isset($this->cb_finish))
        return call_user_func($this->cb_finish);
      return false;
    }
  }

  $plugins = array();

  function load() {
    global $ws;
    global $plugins;

    $dir = opendir($ws['PATH_PLUGINS']);
    while($filename = readdir($dir)) {
      $filepath = $ws['PATH_PLUGINS'] . $filename;
      if(is_dir($filepath) && $filename[0] != '.') {
        $filepath .= '/plugin.php';
        if(file_exists($filepath)) {
          $pl = false;
          $manifest = $ws['PATH_PLUGINS'] . $filename . '/manifest.json';
          if(file_exists($manifest))
            $pl = new Plugin($manifest);
          else $pl = new Plugin;
          
          $pl_initialize = NULL;
          $pl_render = NULL;
          $pl_finish = NULL;
          include_once($filepath);

          if(isset($pl_initialize))
            $pl->cb_initialize = $pl_initialize;
          if(isset($pl_render))
            $pl->cb_render = $pl_render;
          if(isset($pl_finish))
            $pl->cb_finish = $pl_finish;

          $plugins[$filename] = $pl;
        }
      }
    }
  }

  function initialize() {
    global $ws;
    global $plugins;

    foreach($ws['Plugins']['initialize'] as $pl)
      $plugins[$pl]->initialize();
  }

  function render() {
    global $ws;
    global $plugins;

    foreach($ws['Plugins']['render'] as $pl)
      if($plugins[$pl]->render()) return true;
    return false;
  }
  
  function finish() {
    global $ws;
    global $plugins;

    foreach($ws['Plugins']['finish'] as $pl)
      $plugins[$pl]->finish();
  }
?>