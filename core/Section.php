<?php
class Section
{
  public $filename;

  public $id;
  public $short;
  public $classes;

  public function get_contents()
  {
    return file_get_contents($filename);
  }
}
?>