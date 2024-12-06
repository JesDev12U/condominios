<?php
require_once "_model/Model.php";

class CtrlLogin
{
  private $vista = "_view/login.php";
  private $css = "css/login.css";
  private $js = "js/login.js";
  public $opciones = [
    ["nombre" => "Home", "href" => "?page=principal", "id" => "home"]
  ];
  public $title = "Inicio de sesión";

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
