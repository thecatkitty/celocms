<?php
class Page
{
  public $title;
  public $desc;
  public $path;

  public $sections;

  public function __construct()
  {
    global $ws;

    if (func_num_args()) {
      $id = func_get_arg(0);
      if (strpos($id, '.') === false)
        $this->path = $ws['PATH_CONTENT'] . $ws['lang']['code'] . '/' . $id . '/';
      else
        throw new HttpError(403);

      if (!file_exists($this->path))
        $this->path = str_replace('/' . $ws['lang']['code'] . '/', '/' . $ws['Language'] . '/', $this->path);
      if (!file_exists($this->path))
        throw new HttpError(404);

      $desc = json_decode(file_get_contents($this->path . 'page.json'), true);
      $this->title = $desc['title'];
      $this->desc = $desc['description'];

      $sections = array();

      $dir = opendir($this->path);

      while ($filename = readdir($dir)) {
        if (preg_match('/^(\d{3})-([\w-]+).html$/', $filename, $matches)) {
          $i = intval($matches[1]);

          $this->sections[$i] = new Section;
          $this->sections[$i]->id = $matches[2];
          $this->sections[$i]->filename = $this->path . '/' . $filename;
          $this->sections[$i]->short = $this->sections[$i]->id;

          $file = fopen($this->sections[$i]->filename, 'r');
          if (preg_match('/^<!-- #([^<>\|]+)( \| ([\w\s-]+))? -->/', fgets($file), $matches))
            $this->sections[$i]->short = $matches[1];
          else
            $this->sections[$i]->short = '';
          if (isset($matches[3]))
            $this->sections[$i]->classes = $matches[3];
          fclose($file);
        }
      }
      ksort($this->sections);
    } else {
      $title = '';
      $desc = '';
      $path = '';
      $sections = array();
    }
  }
}
?>