<?php
require_once "_model/Model.php";
class CtrlReporteVisitas
{
    private $vista = "_view/admin/reporte_visitas/reporte_visitas.php";

    public function renderContent()
    {
        include $this->vista;
    }
}
