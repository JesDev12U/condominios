<?php
require_once "_model/Model.php";
class CtrlPaginaPrincipal
{
    private $vista = "_view/principal.php";
    public $opciones = [
        ["nombre" => "Home", "href" => "#home", "id" => "home"],
        ["nombre" => "Eventos", "href" => "#eventos", "id" => "eventos"],
        ["nombre" => "opcion", "href" => "#opcion", "id" => "opcion"]

    ];
    public $title = "Principal";
    public $datos = [];

    public function renderContent()
    {
        include $this->vista;
    }
}
