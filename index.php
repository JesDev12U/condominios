<?php
ini_set('display_errors', E_ALL); //Esta linea solo es para pruebas, no dejar en produccion

//Obtenemos la pagina solicitada desde la URL
$page = isset($_GET['page']) ? $_GET['page'] : 'principal';

//Router
switch ($page) {
  case 'principal':
    require_once "_controller/CtrlPaginaPrincipal.php";
    $ctrl = new CtrlPaginaPrincipal();
    break;

  case 'login':
    require_once "_controller/CtrlLogin.php";
    $ctrl = new CtrlLogin();
    break;

  default:
    //Pagina no encontrada
    require_once "_controller/errors/CtrlError404.php";
    http_response_code(404);
    $ctrl = new CtrlError404();
}

include "_view/master.php";
