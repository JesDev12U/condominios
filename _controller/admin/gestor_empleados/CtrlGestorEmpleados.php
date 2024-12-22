<?php
require_once __DIR__ . "/../../../_model/Model.php";
class CtrlGestorEmpleados
{
    const VISTA = __DIR__ . "/../../../_view/admin/gestor_condominos/gestor_condominos.php";
    const CSS = __DIR__ . "/../../../css/admin/gestor_condominos.css";
    const JS = __DIR__ . "/../../../js/admin/gestor_condominos.js";

    public $opciones = [
        ["nombre" => "Home", "href" => SITE_URL . "administrador", "id" => "home"],
        ["nombre" => "Cerrar sesión", "href" => SITE_URL . RUTA_CERRAR_SESION, "id" => "cerrar-sesion"]
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
