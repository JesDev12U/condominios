<?php
require_once "_model/Model.php";
class CtrlGestorEmpleados{
    private $vista = "_view/admin/gestor_empleados/gestor_empleados.html";

    public function renderContent(){
        include $this ->vista;
    }
}