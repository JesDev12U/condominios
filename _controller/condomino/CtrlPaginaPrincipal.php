<?php
class CtrlPaginaPrincipal
{
  const VISTA = __DIR__ . "/../../_view/condomino/principal.php";
  const CSS = __DIR__ . "/../../css/condomino/principal.css";
  const JS = __DIR__ . "/../../js/condomino/principal.js";
  public $opciones = [
    ["nombre" => "Home", "href" => SITE_URL . "condomino", "id" => "home"],
    ["nombre" => "Cerrar sesión", "href" => SITE_URL . RUTA_CERRAR_SESION, "id" => "cerrar-sesion"]
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
