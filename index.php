<?php
    require_once "_controller/CtrlPaginaPrincipal.php";
    $ctrl = new CtrlPaginaPrincipal();
    require_once "_controller/condomino/CtrlInvitados.php";
    $ctrl = new CtrlInvitados();
    require_once "_controller/condomino/eventos/CtrlReservarEventos.php";
    $ctrl = new CtrlReservarEventos();
    require_once "_controller/admin/reporte_visitas/CtrlReporteVisitas.php";
    $ctrl = new CtrlReporteVisitas();

    include "_view/master.html";
?>