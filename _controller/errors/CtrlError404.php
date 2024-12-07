<?php
require_once "_model/Model.php";
class CtrlError404
{
  public $model;
  private $vista = "_view/errors/error404.php";
  public $opciones;

  public function __construct()
  {
    $this->model = new Model();
    $this->opciones  = [
      ["nombre" => "Home", "href" => $this->model->baseURL, "id" => "home"]
    ];
  }

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
