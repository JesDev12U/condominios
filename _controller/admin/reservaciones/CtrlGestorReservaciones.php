<?php
require_once "_model/Model.php";
class CtrlGestorReservaciones
{
    private $vista = "_view/admin/reservaciones/gestor_reservaciones.php";

    public function renderContent()
    {
        include $this->vista;
    }
}
