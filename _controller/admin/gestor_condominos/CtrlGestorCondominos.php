<?php
require_once __DIR__ . "/../../../_model/Model.php";

class CtrlGestorCondominos
{
  const VISTA = __DIR__ . "/../../../_view/admin/gestor_condominos/gestor_condominos.php";
  const CSS = __DIR__ . "/../../../css/admin/gestor_condominos.css";
  const JS = __DIR__ . "/../../../js/admin/gestor_condominos.js";
  public $datos = null;

  function __construct()
  {
    $model = new Model();
    $this->datos = $model->seleccionaRegistros("condominos", ["*"]);
  }

  public $opciones = [
    ["nombre" => ICON_HOME, "href" => SITE_URL . RUTA_ADMINISTRADOR, "id" => "home"],
    ["nombre" => ICON_EMPLEADOS, "href" => SITE_URL . RUTA_ADMINISTRADOR . "gestor-empleados", "id" => "gestor-empleados"],
    ["nombre" => ICON_RESERVACIONES, "href" => SITE_URL . RUTA_ADMINISTRADOR . "gestor-reservaciones", "id" => "gestor-reservaciones"],
    ["nombre" => ICON_VISITAS, "href" => SITE_URL . RUTA_ADMINISTRADOR . "reporte-visitas", "id" => "reporte-visitas"],
    ["nombre" => ICON_CUENTA, "href" => SITE_URL . RUTA_ADMINISTRADOR . "configuracion", "id" => "configuracion"],
    ["nombre" => ICON_CERRAR_SESION, "href" => SITE_URL . RUTA_CERRAR_SESION, "id" => "cerrar-sesion"]
  ];
  public $title = "Gestor de condóminos";

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
