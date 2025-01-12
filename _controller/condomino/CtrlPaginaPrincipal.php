<?php
class CtrlPaginaPrincipal
{
  const VISTA = __DIR__ . "/../../_view/condomino/principal.php";
  const CSS = __DIR__ . "/../../css/condomino/principal.css";
  const JS = __DIR__ . "/../../js/condomino/principal.js";
  public $opciones = [
    ["nombre" => ICON_EVENTOS, "href" => SITE_URL . RUTA_CONDOMINO . "reservar-eventos", "id" => "reservar-eventos"],
    ["nombre" => ICON_INVITADOS, "href" => SITE_URL . RUTA_CONDOMINO . "invitados", "id" => "invitados"],
    ["nombre" => ICON_CUENTA, "href" => SITE_URL . RUTA_CONDOMINO . "configuracion", "id" => "configuracion"],
    ["nombre" => ICON_CERRAR_SESION, "href" => SITE_URL . RUTA_CERRAR_SESION, "id" => "cerrar-sesion"]
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
