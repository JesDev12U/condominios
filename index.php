<?php
ini_set('display_errors', E_ALL); //Esta linea solo es para pruebas, no dejar en produccion

// Capturar los parámetros de la URL
$page = null;
if (isset($_GET['page'])) {
  if ($_GET['page'] === "index.php") $page = 'principal';
  else $page = $_GET['page'];
} else $page = 'principal';
$action = isset($_GET['action']) ? $_GET['action'] : null;
$id = isset($_GET['id']) ? $_GET['id'] : null;

//Router
switch ($page) {
  case 'principal':
    require_once "_controller/CtrlPaginaPrincipal.php";
    $ctrl = new CtrlPaginaPrincipal();
    break;

  case 'login':
    if ($action !== null || $id !== null) {
      require_once "_controller/errors/CtrlError404.php";
      http_response_code(404);
      $ctrl = new CtrlError404();
    } else {
      require_once "_controller/CtrlLogin.php";
      $ctrl = new CtrlLogin();
    }
    break;

  default:
    //Pagina no encontrada
    require_once "_controller/errors/CtrlError404.php";
    http_response_code(404);
    $ctrl = new CtrlError404();
}

include "_view/master.php";
