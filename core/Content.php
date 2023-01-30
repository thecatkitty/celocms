<?php
namespace Content;

$ws['menu'] = array();

function load_menu()
{
  global $ws;

  $ws['menu'] = json_decode(file_get_contents($ws['PATH_CONTENT'] . 'menu.json'), true);
  $ws['menu'] = $ws['menu'][$ws['lang']['code']];
}

function load_page($uri)
{
  global $ws;

  // Wczytaj treść strony
  try {
    $p = new \Page($ws['Page']);
    $ws['PageTitle'] = $p->title;
    $ws['PageDescription'] = $p->desc;
    return $p;
    // Obsłuż błędy HTTP
  } catch (\HttpError $e) {
    $ws['ErrorCode'] = $e->getCode();
    $ws['ErrorMessage'] = $e->getMessage();

    header('HTTP/1.0 ' . $ws['ErrorCode'] . ' ' . $ws['ErrorMessage']);
    // Obsłuż wyjątki PHP
  } catch (\Exception $e) {
    $ws['ErrorCode'] = 'PHP Exception';
    $ws['ErrorMessage'] = '[' . $e->getCode() . '] ' . $e->getMessage();
  }
}

function load_error()
{
  global $ws;

  $ws['Cache'] = false;

  $p = new \Page;
  $ws['Page'] = 'error';
  $ws['PageTitle'] = '{{lang.error}}';
  $ws['PageDescription'] = $ws['ErrorCode'] . ': ' . $ws['ErrorMessage'];

  $p->sections[0] = new \Section;
  $p->sections[0]->id = 'error';
  $p->sections[0]->filename = $ws['PATH_CONTENT'] . 'error.html';
  $p->sections[0]->short = '';
  $p->sections[0]->classes = 'alternate';

  return $p;
}
?>