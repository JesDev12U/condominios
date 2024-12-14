<?php
require_once __DIR__ . "/../../../_model/Model.php";
class CtrlReservarEventos
{
    private $vista = "_view/condomino/eventos/reservar_eventos.php";

    public function renderContent()
    {
        include $this->vista;
    }
}
