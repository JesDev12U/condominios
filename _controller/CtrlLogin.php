<?php
require_once "_model/Model.php";

class CtrlLogin
{
  private $vista = "_view/login.php";
  private $css = "css/login.css";
  private $js = "js/login.js";
  public $model;
  public $opciones;
  public $title = "Inicio de sesión";

  public function __construct()
  {
    $this->model = new Model();
    $this->opciones = [
      ["nombre" => "Home", "href" => $this->model->baseURL, "id" => "home"]
    ];
  }

  public function renderContent()
  {
    include $this->vista;
  }

  public function renderCSS()
  {
    include $this->css;
  }

  public function renderJS()
  {
    include $this->js;
  }
}
