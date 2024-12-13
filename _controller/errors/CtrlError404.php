<?php
require_once "_model/Model.php";
class CtrlError404
{
  public $model;
  private $vista = "_view/errors/error404.php";
  public $opciones = [
    ["nombre" => "Home", "href" => SITE_URL, "id" => "home"]
  ];

  public $title = "404 Not Found";

  public function renderContent()
  {
    include $this->vista;
  }

  public function renderCSS()
  {
    echo "";
  }

  public function renderJS()
  {
    echo "";
  }
}
