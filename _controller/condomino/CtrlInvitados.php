<?php
require_once __DIR__ . "/../../_model/Model.php";
class CtrlInvitados
{
    private $vista = "_view/condomino/invitados.php";

    public function renderContent()
    {
        include $this->vista;
    }
}
