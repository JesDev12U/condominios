<?php
require_once "_model/Model.php";
class CtrlPaginaPrincipal{
    private $vista = "_view/condomino/invitados.html";

    public function renderContent(){
        include $this ->vista;
    }
}