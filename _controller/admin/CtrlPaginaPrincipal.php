<?php
class CtrlPaginaPrincipal
{
  const VISTA = __DIR__ . "/../../_view/admin/principal.php";
  const CSS = __DIR__ . "/../../css/admin/principal.css";
  const JS = __DIR__ . "/../../js/admin/principal.js";

  public $opciones = [
    ["nombre" => ICON_CONDOMINOS, "href" => SITE_URL . RUTA_ADMINISTRADOR . "gestor-condominos", "id" => "gestor-condominos"],
    ["nombre" => ICON_EMPLEADOS, "href" => SITE_URL . RUTA_ADMINISTRADOR . "gestor-empleados", "id" => "gestor-empleados"],
    ["nombre" => ICON_RESERVACIONES, "href" => SITE_URL . RUTA_ADMINISTRADOR . "gestor-reservaciones", "id" => "gestor-reservaciones"],
    ["nombre" => ICON_VISITAS, "href" => SITE_URL . RUTA_ADMINISTRADOR . "reporte-visitas", "id" => "reporte-visitas"],
    ["nombre" => ICON_CUENTA, "href" => SITE_URL . RUTA_ADMINISTRADOR . "configuracion", "id" => "configuracion"],
    ["nombre" => ICON_CERRAR_SESION, "href" => SITE_URL . RUTA_CERRAR_SESION, "id" => "cerrar-sesion"]
  ];
  public $title = "Administrador";

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
