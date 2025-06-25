<?php
ini_set('display_errors', E_ALL); //Esta linea solo es para pruebas, no dejar en produccion
require_once __DIR__ . "/../../config/Global.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  echo json_encode(["result" => 0, "msg" => "Método no permitido"]);
  die();
}

//Recepción de los datos
$id = isset($_POST['id']) ? (int)$_POST['id'] : null;
$usuario = isset($_POST['usuario']) ? $_POST['usuario'] : null;
$operacion = isset($_POST["operacion"]) ? $_POST["operacion"] : null;

if (!$id || !$usuario || !$operacion) {
  echo json_encode(["result" => 0, "msg" => "Petición incorrecta"]);
  die();
}

//Verificar si el ID existe
if ($usuario === "condomino") {
  require_once __DIR__ . "/gestor_condominos/CtrlMtoCondominos.php";
  $ctrl = new CtrlMtoCondominos("UPDATE");
} else if ($usuario === "empleado") {
  require_once __DIR__ . "/gestor_empleados/CtrlMtoEmpleados.php";
  $ctrl = new CtrlMtoEmpleados("UPDATE");
} else {
  echo json_encode(["result" => 0, "msg" => "Usuario inválido"]);
  die();
}
if (count($ctrl->seleccionaRegistro($id)) === 0) {
  echo json_encode(["result" => 0, "msg" => "El ID del usuario no existe"]);
  die();
}

//Ya con todo correcto, se hace la solicitud
if ($usuario === "condomino") $ctrl = new CtrlMtoCondominos("UPDATE", $id);
else $ctrl = new CtrlMtoEmpleados("UPDATE", $id);
switch ($operacion) {
  case "deshabilitar":
    if ($ctrl->deshabilitarRegistro($id)) {
      echo json_encode(["result" => 1, "msg" => "Usuario deshabilitado correctamente"]);
    } else {
      echo json_encode(["result" => 0, "msg" => "ERROR: Problema para actualizar el registro en la BD"]);
    }
    break;
  case "habilitar":
    if ($ctrl->habilitarRegistro($id)) {
      echo json_encode(["result" => 1, "msg" => "Usuario habilitado correctamente"]);
    } else {
      echo json_encode(["result" => 0, "msg" => "ERROR: Problema para actualizar el registro en la BD"]);
    }
    break;
  default:
    echo json_encode(["result" => 0, "msg" => "Operación inválida"]);
    die();
}
