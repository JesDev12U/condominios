<?php
class CtrlError404
{
  private $vista = "_view/errors/error404.php";
  public $opciones = [
    ["nombre" => "Home", "href" => "index.php", "id" => "home"]
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
