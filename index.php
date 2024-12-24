<?php
session_start();
ini_set('display_errors', E_ALL); //Esta linea solo es para pruebas, no dejar en produccion

require_once __DIR__ . "/config/Global.php";

// Capturar los parámetros de la URL
$page = null;
if (isset($_GET['page'])) {
  if ($_GET['page'] === "index.php") $page = 'principal';
  else $page = $_GET['page'];
} else $page = 'principal';
$action = isset($_GET['action']) ? $_GET['action'] : null;
$id = isset($_GET['id']) ? $_GET['id'] : null;

//Router
if (isset($_SESSION["loggeado"]) && $_SESSION["loggeado"] === true)
  $page = $_SESSION["usuario"];
switch ($page) {
  case 'principal':
    require_once __DIR__ . "/_controller/CtrlPaginaPrincipal.php";
    $ctrl = new CtrlPaginaPrincipal();
    break;

  case 'login':
    if ($action !== null || $id !== null) {
      require_once __DIR__ . "/_controller/errors/CtrlError404.php";
      http_response_code(404);
      $ctrl = new CtrlError404();
    } else if (!(isset($_SESSION["loggeado"]) && $_SESSION["loggeado"] === true)) {
      require_once __DIR__ . "/_controller/CtrlLogin.php";
      $ctrl = new CtrlLogin();
    }
    break;

  case 'condomino':
    require_once __DIR__ . "/_controller/condomino/CtrlPaginaPrincipal.php";
    $ctrl = new CtrlPaginaPrincipal();
    break;
  case 'administrador':
    //Router del administrador
    switch ($action) {
      case NULL:
        require_once __DIR__ . "/_controller/admin/CtrlPaginaPrincipal.php";
        $ctrl = new CtrlPaginaPrincipal();
        break;
      case "gestor-empleados":
        require_once __DIR__ . "/_controller/admin/gestor_empleados/CtrlGestorEmpleados.php";
        $ctrl = new CtrlGestorEmpleados();
        break;
      case "mto-empleados":
        require_once __DIR__ . "/_controller/admin/gestor_empleados/CtrlMtoEmpleados.php";
        $ctrl = new CtrlMtoEmpleados();
        break;
      default:
        //Pagina no encontrada
        require_once __DIR__ . "/_controller/errors/CtrlError404.php";
        http_response_code(404);
        $ctrl = new CtrlError404();
    }
    break;
  case 'empleado':
    require_once __DIR__ . "/_controller/empleado/CtrlPaginaPrincipal.php";
    $ctrl = new CtrlPaginaPrincipal();
    break;
  default:
    //Pagina no encontrada
    require_once __DIR__ . "/_controller/errors/CtrlError404.php";
    http_response_code(404);
    $ctrl = new CtrlError404();
}

include __DIR__ . "/_view/master.php";
