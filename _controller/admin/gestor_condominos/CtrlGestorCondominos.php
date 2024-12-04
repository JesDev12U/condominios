<?php
require_once "_model/Model.php";
class CtrlGestorCondominos{
    private $vista = "_view/admin/gestor_condominos/gestor_condominos.html";

    public function renderContent(){
        include $this ->vista;
    }
}