<?php
require_once "_model/Model.php";
class CtrlGestorEmpleados
{
    private $vista = "_view/admin/gestor_empleados/gestor_empleados.php";

    public function renderContent()
    {
        include $this->vista;
    }
}
