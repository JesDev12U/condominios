<?php
class CtrlLogin
{
  const VISTA = "_view/login.php";
  const CSS = "css/login.css";
  const JS = "js/login.js";
  public $model;
  public $opciones = [
    ["nombre" => "Home", "href" => SITE_URL, "id" => "home"]
  ];
  public $title = "Inicio de sesión";

  public function renderContent()
  {
    include self::VISTA;
  }

  public function renderCSS()
  {
    include self::CSS;
  }

  public function renderJS()
  {
    include self::JS;
  }
}
