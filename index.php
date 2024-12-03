<?php
    require_once "_controller/CtrlPaginaPrincipal.php";
    $ctrl = new CtrlPaginaPrincipal();
    require_once "_controller/condomino/CtrlInvitados.php";
    $ctrl = new CtrlInvitados();
    include "_view/master.html";
?>