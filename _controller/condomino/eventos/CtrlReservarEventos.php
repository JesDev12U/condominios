<?php
require_once "_model/Model.php";
class CtrlReservarEventos{
    private $vista = "_view/condomino/eventos/reservar_eventos.html";

    public function renderContent(){
        include $this ->vista;
    }
}