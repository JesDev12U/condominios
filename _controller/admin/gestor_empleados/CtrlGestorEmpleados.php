<?php
require_once __DIR__ . "/../../../_model/Model.php";
class CtrlGestorEmpleados
{
    const VISTA = __DIR__ . "/../../../_view/admin/gestor_empleados/gestor_empleados.php";
    const CSS = __DIR__ . "/../../../css/admin/gestor_empleados.css";
    const JS = __DIR__ . "/../../../js/admin/gestor_empleados.js";
    public $datos = null;

    function __construct()
    {
        $model = new Model();
        $this->datos = $model->seleccionaRegistros("empleados", ["*"]);
    }

    public $opciones = [
        ["nombre" => ICON_HOME, "href" => SITE_URL . RUTA_ADMINISTRADOR, "id" => "home"],
        ["nombre" => ICON_CONDOMINOS, "href" => SITE_URL . RUTA_ADMINISTRADOR . "gestor-condominos", "id" => "gestor-condominos"],
        ["nombre" => ICON_RESERVACIONES, "href" => SITE_URL . RUTA_ADMINISTRADOR . "gestor-reservaciones", "id" => "gestor-reservaciones"],
        ["nombre" => ICON_VISITAS, "href" => SITE_URL . RUTA_ADMINISTRADOR . "reporte-visitas", "id" => "reporte-visitas"],
        ["nombre" => ICON_CUENTA, "href" => SITE_URL . RUTA_ADMINISTRADOR . "configuracion", "id" => "configuracion"],
        ["nombre" => ICON_CERRAR_SESION, "href" => SITE_URL . RUTA_CERRAR_SESION, "id" => "cerrar-sesion"]
    ];
    public $title = "Gestor de empleados";

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
