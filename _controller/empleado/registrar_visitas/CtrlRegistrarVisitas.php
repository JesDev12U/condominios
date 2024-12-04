<?php
require_once "_model/Model.php";
class CtrlRegistrarVisitas{
    private $vista = "_view/empleado/registrar_visitas/registrar_visitas.html";

    public function renderContent(){
        include $this ->vista;
    }
}