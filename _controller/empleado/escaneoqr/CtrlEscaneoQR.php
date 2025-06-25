<?php

class CtrlEscaneoQR
{
  const VISTA = __DIR__ . "/../../../_view/empleado/escaneoqr/escaneoQR.php";
  const CSS = __DIR__ . "/../../../css/empleado/escaneoQR.css";
  const JS = __DIR__ . "/../../../js/empleado/escaneoQR.js";

  public $opciones = [
    ["nombre" => ICON_HOME, "href" => SITE_URL . RUTA_EMPLEADO, "id" => "home"],
    ["nombre" => ICON_VISITAS, "href" => SITE_URL . RUTA_EMPLEADO . "visitas", "id" => "visitas"],
    ["nombre" => ICON_CUENTA, "href" => SITE_URL . RUTA_EMPLEADO . "configuracion", "id" => "configuracion"],
    ["nombre" => ICON_CERRAR_SESION, "href" => SITE_URL . RUTA_CERRAR_SESION, "id" => "cerrar-sesion"]
  ];

  public $title = "Escaneo de acceso";

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
