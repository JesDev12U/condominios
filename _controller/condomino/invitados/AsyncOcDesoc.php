<?php
ini_set('display_errors', E_ALL); //Esta linea solo es para pruebas, no dejar en produccion
require_once __DIR__ . "/../../../config/Global.php";
require_once __DIR__ . "/CtrlMtoInvitados.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  echo json_encode(["result" => 0, "msg" => "Método no permitido"]);
  die();
}

//Recepción de los datos
$id = isset($_POST['id']) ? (int)($_POST['id']) : null;
$operacion = isset($_POST['operacion']) ? $_POST['operacion'] : null;

if (!$id && !$operacion) {
  echo json_encode(["result" => 0, "msg" => "Petición incorrecta"]);
  die();
}

//Verificar si el ID existe
$ctrl = new CtrlMtoInvitados("UPDATE");
if (count($ctrl->seleccionaRegistro($id)) === 0) {
  echo json_encode(["result" => 0, "msg" => "El ID del usuario no existe"]);
  die();
}

//Una vez verificado, podemos proseguir con la operacion
switch ($operacion) {
  case "ocultar":
    if ($ctrl->ocultarRegistro($id)) {
      echo json_encode(["result" => 1, "msg" => "Invitado ocultado correctamente"]);
    } else {
      echo json_encode(["result" => 0, "msg" => "ERROR: Problema para actualizar el registro en la BD"]);
    }
    break;
  case "desocultar":
    if ($ctrl->desocultarRegistro($id)) {
      echo json_encode(["result" => 1, "msg" => "Invitado desocultado correctamente"]);
    } else {
      echo json_encode(["result" => 0, "msg" => "ERROR: Problema para actualizar el registro en la BD"]);
    }
    break;
  default:
    echo json_encode(["result" => 0, "msg" => "Operación inválida"]);
    die();
}
