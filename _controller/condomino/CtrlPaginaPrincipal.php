<?php
class CtrlPaginaPrincipal
{
  const VISTA = "_view/condomino/principal.php";
  const CSS = "css/condomino/principal.css";
  const JS = "js/condomino/principal.js";
  public $opciones = [
    ["nombre" => "Home", "href" => SITE_URL . "condomino", "id" => "home"]
  ];
  public $title = "Condómino";

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
