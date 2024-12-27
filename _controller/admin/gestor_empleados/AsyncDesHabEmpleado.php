<?php
ini_set('display_errors', E_ALL); //Esta linea solo es para pruebas, no dejar en produccion
require_once __DIR__ . "/../../../config/Global.php";
require_once __DIR__ . "/CtrlMtoEmpleados.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  echo json_encode(["result" => 0, "msg" => "Método no permitido"]);
  die();
}

//Recepción de los datos
$id_empleado = isset($_POST['id_empleado']) ? (int)$_POST['id_empleado'] : null;
$operacion = isset($_POST["operacion"]) ? $_POST["operacion"] : null;

if (!$id_empleado || !$operacion) {
  echo json_encode(["result" => 0, "msg" => "Petición incorrecta"]);
  die();
}

//Verificar si el ID del Empleado existe
$ctrl = new CtrlMtoEmpleados("UPDATE");
if (count($ctrl->seleccionaRegistro($id_empleado)) === 0) {
  echo json_encode(["result" => 0, "msg" => "El ID del empleado no existe"]);
  die();
}

//Ya con todo correcto, se hace la solicitud
$ctrl = new CtrlMtoEmpleados("UPDATE", $id_empleado);
switch ($operacion) {
  case "deshabilitar":
    if ($ctrl->deshabilitarRegistro($id_empleado)) {
      echo json_encode(["result" => 1, "msg" => "Empleado deshabilitado correctamente"]);
    } else {
      echo json_encode(["result" => 0, "msg" => "ERROR: Problema para actualizar el registro en la BD"]);
    }
    break;
  case "habilitar":
    if ($ctrl->habilitarRegistro($id_empleado)) {
      echo json_encode(["result" => 1, "msg" => "Empleado habilitado correctamente"]);
    } else {
      echo json_encode(["result" => 0, "msg" => "ERROR: Problema para actualizar el registro en la BD"]);
    }
    break;
  default:
    echo json_encode(["result" => 0, "msg" => "Operación inválida"]);
    die();
}
