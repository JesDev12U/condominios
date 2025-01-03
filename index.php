<?php
session_start();
ini_set('display_errors', E_ALL); //Esta linea solo es para pruebas, no dejar en produccion
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . "/config/Global.php";

// Capturar los parámetros de la URL
$page = null;
if (isset($_GET['page'])) {
  if ($_GET['page'] === "index.php") $page = 'principal';
  else $page = $_GET['page'];
} else $page = 'principal';
$action = isset($_GET['action']) ? $_GET['action'] : null;
$id = isset($_GET['id']) ? $_GET['id'] : null;

if (isset($_SESSION["loggeado"]) && $_SESSION["loggeado"]) {
  if ($page !== $_SESSION["usuario"]) {
    $page = $_SESSION["usuario"];
    $action = NULL;
    $id = NULL;
  }
} else {
  if ($page === "condomino" || $page === "administrador" || $page === "empleado") {
    $page = "principal";
  }
}

//Router
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
    //Router del condomino
    switch ($action) {
      case NULL:
        require_once __DIR__ . "/_controller/condomino/CtrlPaginaPrincipal.php";
        $ctrl = new CtrlPaginaPrincipal();
        break;
      case "invitados":
        require_once __DIR__ . "/_controller/condomino/invitados/CtrlInvitados.php";
        $ctrl = new CtrlInvitados($_SESSION["datos"]["id_condomino"]);
        break;
      case "mto-invitados":
        if (is_null($id)) {
          require_once __DIR__ . "/_controller/condomino/invitados/CtrlMtoInvitados.php";
          $ctrl = new CtrlMtoInvitados("INSERT");
          break;
        } else if ($id > 0) {
          require_once __DIR__ . "/_controller/condomino/invitados/CtrlMtoInvitados.php";
          $ctrl = new CtrlMtoInvitados("UPDATE", $id);
          $registro = $ctrl->seleccionaRegistro($id);
          if (count($registro) == 0) {
            //Pagina no encontrada
            require_once __DIR__ . "/_controller/errors/CtrlError404.php";
            http_response_code(404);
            $ctrl = new CtrlError404();
          }
          break;
        } else {
          //Pagina no encontrada
          require_once __DIR__ . "/_controller/errors/CtrlError404.php";
          http_response_code(404);
          $ctrl = new CtrlError404();
        }
      case "configuracion":
        require_once __DIR__ . "/_controller/admin/gestor_condominos/CtrlMtoCondominos.php";
        $ctrl = new CtrlMtoCondominos("UPDATE", $_SESSION["datos"]["id_condomino"]);
        break;
      default:
        //Pagina no encontrada
        require_once __DIR__ . "/_controller/errors/CtrlError404.php";
        http_response_code(404);
        $ctrl = new CtrlError404();
    }
    break;
  case 'administrador':
    //Router del administrador
    switch ($action) {
      case NULL:
        require_once __DIR__ . "/_controller/admin/CtrlPaginaPrincipal.php";
        $ctrl = new CtrlPaginaPrincipal();
        break;
      case "configuracion":
        require_once __DIR__ . "/_controller/admin/CtrlMtoAdministrador.php";
        $ctrl = new CtrlMtoAdministrador($_SESSION["datos"]["id_administrador"]);
        break;
      case "gestor-empleados":
        require_once __DIR__ . "/_controller/admin/gestor_empleados/CtrlGestorEmpleados.php";
        $ctrl = new CtrlGestorEmpleados();
        break;
      case "gestor-condominos":
        require_once __DIR__ . "/_controller/admin/gestor_condominos/CtrlGestorCondominos.php";
        $ctrl = new CtrlGestorCondominos();
        break;
      case "mto-empleados":
        if (is_null($id)) {
          require_once __DIR__ . "/_controller/admin/gestor_empleados/CtrlMtoEmpleados.php";
          $ctrl = new CtrlMtoEmpleados("INSERT");
          break;
        } else if ($id > 0) {
          require_once __DIR__ . "/_controller/admin/gestor_empleados/CtrlMtoEmpleados.php";
          $ctrl = new CtrlMtoEmpleados("UPDATE", $id);
          $registro = $ctrl->seleccionaRegistro($id);
          if (count($registro) == 0) {
            //Pagina no encontrada
            require_once __DIR__ . "/_controller/errors/CtrlError404.php";
            http_response_code(404);
            $ctrl = new CtrlError404();
          }
          break;
        } else {
          //Pagina no encontrada
          require_once __DIR__ . "/_controller/errors/CtrlError404.php";
          http_response_code(404);
          $ctrl = new CtrlError404();
        }
      case "mto-condominos":
        if (is_null($id)) {
          require_once __DIR__ . "/_controller/admin/gestor_condominos/CtrlMtoCondominos.php";
          $ctrl = new CtrlMtoCondominos("INSERT");
          break;
        } else if ($id > 0) {
          require_once __DIR__ . "/_controller/admin/gestor_condominos/CtrlMtoCondominos.php";
          $ctrl = new CtrlMtoCondominos("UPDATE", $id);
          $registro = $ctrl->seleccionaRegistro($id);
          if (count($registro) == 0) {
            //Pagina no encontrada
            require_once __DIR__ . "/_controller/errors/CtrlError404.php";
            http_response_code(404);
            $ctrl = new CtrlError404();
          }
          break;
        } else {
          //Pagina no encontrada
          require_once __DIR__ . "/_controller/errors/CtrlError404.php";
          http_response_code(404);
          $ctrl = new CtrlError404();
        }
      default:
        //Pagina no encontrada
        require_once __DIR__ . "/_controller/errors/CtrlError404.php";
        http_response_code(404);
        $ctrl = new CtrlError404();
    }
    break;
  case 'empleado':
    //Router del empleado
    switch ($action) {
      case NULL:
        require_once __DIR__ . "/_controller/empleado/CtrlPaginaPrincipal.php";
        $ctrl = new CtrlPaginaPrincipal();
        break;
      case "escaneo-acceso":
        require_once __DIR__ . "/_controller/empleado/escaneoqr/CtrlEscaneoQR.php";
        $ctrl = new CtrlEscaneoQR();
        break;
      case "visitas":
        require_once __DIR__ . "/_controller/empleado/visitas/CtrlVisitas.php";
        $ctrl = new CtrlVisitas();
        break;
      case "configuracion":
        require_once __DIR__ . "/_controller/admin/gestor_empleados/CtrlMtoEmpleados.php";
        $ctrl = new CtrlMtoEmpleados("UPDATE", $_SESSION["datos"]["id_empleado"]);
        break;
      default:
        //Pagina no encontrada
        require_once __DIR__ . "/_controller/errors/CtrlError404.php";
        http_response_code(404);
        $ctrl = new CtrlError404();
    }
    break;
  default:
    //Pagina no encontrada
    require_once __DIR__ . "/_controller/errors/CtrlError404.php";
    http_response_code(404);
    $ctrl = new CtrlError404();
}

include __DIR__ . "/_view/master.php";
