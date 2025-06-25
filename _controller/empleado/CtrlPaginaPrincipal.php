<?php
class CtrlPaginaPrincipal
{
  const VISTA = __DIR__ . "/../../_view/empleado/principal.php";
  const CSS = __DIR__ . "/../../css/empleado/principal.css";
  const JS = __DIR__ . "/../../js/empleado/principal.js";

  public $opciones = [
    ["nombre" => ICON_ESCANEO_QR, "href" => SITE_URL . RUTA_EMPLEADO . "escaneo-acceso", "id" => "escaneo-acceso"],
    ["nombre" => ICON_VISITAS, "href" => SITE_URL . RUTA_EMPLEADO . "visitas", "id" => "visitas"],
    ["nombre" => ICON_CUENTA, "href" => SITE_URL . RUTA_EMPLEADO . "configuracion", "id" => "configuracion"],
    ["nombre" => ICON_CERRAR_SESION, "href" => SITE_URL . RUTA_CERRAR_SESION, "id" => "cerrar-sesion"]
  ];
  public $title = "Empleado";

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
