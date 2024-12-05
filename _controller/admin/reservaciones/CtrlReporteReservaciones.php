<?php
require_once "_model/Model.php";
class CtrlReporteReservaciones
{
    private $vista = "_view/admin/reservaciones/reporte_reservaciones.php";

    public function renderContent()
    {
        include $this->vista;
    }
}
