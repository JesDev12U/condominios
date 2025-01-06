<?php
ini_set('display_errors', E_ALL); //Esta linea solo es para pruebas, no dejar en produccion
require_once __DIR__ . "/../../../config/Global.php";
require_once __DIR__ . "/CtrlMtoInvitados.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  echo json_encode(["result" => 0, "msg" => "Método no permitido"]);
  die();
}

//Recepción de los datos
$id_invitado = isset($_POST['id_invitado']) ? (int)($_POST['id_invitado']) : null;
$id_condomino = isset($_POST['id_condomino']) ? (int)($_POST['id_condomino']) : null;
$operacion = isset($_POST['operacion']) ? $_POST['operacion'] : null;

if (!$id_invitado && !$id_condomino && !$operacion) {
  echo json_encode(["result" => 0, "msg" => "Petición incorrecta"]);
  die();
}

//Verificar si el ID existe
$ctrl = new CtrlMtoInvitados("UPDATE");
if (count($ctrl->seleccionaRegistro($id_invitado, $id_condomino)) === 0) {
  echo json_encode(["result" => 0, "msg" => "El ID del usuario no existe"]);
  die();
}

//Una vez verificado, podemos proseguir con la operacion
switch ($operacion) {
  case "ocultar":
    if ($ctrl->ocultarRegistro($id_invitado)) {
      echo json_encode(["result" => 1, "msg" => "Invitado ocultado correctamente"]);
    } else {
      echo json_encode(["result" => 0, "msg" => "ERROR: Problema para actualizar el registro en la BD"]);
    }
    break;
  case "desocultar":
    if ($ctrl->desocultarRegistro($id_invitado)) {
      echo json_encode(["result" => 1, "msg" => "Invitado desocultado correctamente"]);
    } else {
      echo json_encode(["result" => 0, "msg" => "ERROR: Problema para actualizar el registro en la BD"]);
    }
    break;
  default:
    echo json_encode(["result" => 0, "msg" => "Operación inválida"]);
    die();
}
