<?php
require_once "_model/Model.php";
class CtrlGestorReservaciones{
    private $vista = "_view/admin/reservaciones/gestor_reservaciones.html";

    public function renderContent(){
        include $this ->vista;
    }
}