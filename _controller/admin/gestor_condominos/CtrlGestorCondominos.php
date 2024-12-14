<?php
require_once __DIR__ . "/../../../_model/Model.php";
class CtrlGestorCondominos
{
    private $vista = "_view/admin/gestor_condominos/gestor_condominos.php";

    public function renderContent()
    {
        include $this->vista;
    }
}
