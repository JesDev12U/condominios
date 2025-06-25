<?php
ini_set('display_errors', E_ALL); //Esta linea solo es para pruebas, no dejar en produccion
require_once __DIR__ . "/../../../config/Global.php";
require_once __DIR__ . "/CtrlMtoReservarEventos.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  echo json_encode(["result" => 0, "msg" => "Método no permitido"]);
  die();
}

//Recepción de los datos
$id_evento = isset($_POST['id_evento']) ? (int)$_POST['id_evento'] : null;
$id_condomino = isset($_POST['id_condomino']) ? (int)$_POST['id_condomino'] : null;
$operacion = isset($_POST['operacion']) ? $_POST['operacion'] : null;

if (!$id_evento || !$operacion) {
  echo json_encode(["result" => 0, "msg" => "Petición incorrecta"]);
  die();
}

//Verificar si el ID del evento existe
$ctrl = new CtrlMtoReservarEventos("UPDATE");
if (count($ctrl->seleccionaRegistro($id_evento, $id_condomino)) === 0) {
  echo json_encode(["result" => 0, "msg" => "El ID del evento no existe"]);
  die();
}

//Ya con todo correcto, se hace la solicitud
switch ($operacion) {
  case "cancelar":
    if ($ctrl->cancelarEvento($id_evento)) {
      echo json_encode(["result" => 1, "msg" => "Evento cancelado correctamente"]);
    } else {
      echo json_encode(["result" => 0, "msg" => "ERROR: Problema para actualizar el registro en la BD"]);
    }
    break;
  case "reagendar":
    $query = $ctrl->seleccionaRegistro($id_evento, $id_condomino);
    if ($ctrl->hayTraslape($query[0]["fecha"], $query[0]["turno"], $id_evento)) {
      echo json_encode(["result" => 0, "msg" => "Ya hay un evento asignado para esa fecha y turno, modifica ambos campos para poder reagendar"]);
    } else if ($ctrl->reagendarEvento($id_evento)) {
      echo json_encode(["result" => 1, "msg" => "Evento reagendado correctamente"]);
    } else {
      echo json_encode(["result" => 0, "msg" => "ERROR: Problema para actualizar el registro en la BD"]);
    }
    break;
  default:
    echo json_encode(["result" => 0, "msg" => "Operación inválida"]);
    die();
}
