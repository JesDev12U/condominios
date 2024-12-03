<?php
ini_set('display_errors', E_ALL); //Esta linea solo es para pruebas, no dejar en produccion
require_once "_controller/CtrlPaginaPrincipal.php";
$ctrl = new CtrlPaginaPrincipal();
require_once "_controller/condomino/CtrlInvitados.php";
$ctrl = new CtrlInvitados();
include "_view/master.html";
