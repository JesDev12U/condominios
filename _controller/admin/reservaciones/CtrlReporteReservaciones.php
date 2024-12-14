<?php
require_once __DIR__ . "/../../../_model/Model.php";
class CtrlReporteReservaciones
{
    private $vista = "_view/admin/reservaciones/reporte_reservaciones.php";

    public function renderContent()
    {
        include $this->vista;
    }
}
