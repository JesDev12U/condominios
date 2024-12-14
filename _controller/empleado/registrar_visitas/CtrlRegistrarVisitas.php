<?php
require_once __DIR__ . "/../../../_model/Model.php";
class CtrlRegistrarVisitas
{
    private $vista = __DIR__ . "/../../../_view/empleado/registrar_visitas/registrar_visitas.php";

    public function renderContent()
    {
        include $this->vista;
    }
}
