<?php
ini_set('display_errors', E_ALL); //Esta linea solo es para pruebas, no dejar en produccion

require_once __DIR__ . "/../../../config/Global.php";
require_once __DIR__ . "/CtrlMtoReservarEventos.php";
require_once __DIR__ . "/../../guardarFoto.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  echo json_encode(["result" => 0, "msg" => "Método no permitido"]);
  die();
}

//Recepción de los datos
$peticion = isset($_POST['peticion']) ? $_POST['peticion'] : "";
$id_evento = isset($_POST['id_evento']) ? $_POST['id_evento'] : "";
$id_condomino = isset($_POST['id_condomino']) ? $_POST['id_condomino'] : "";
$cantidad_personas = isset($_POST['cantidad_personas']) ? $_POST['cantidad_personas'] : "";
$fecha = isset($_POST['fecha']) ? $_POST['fecha'] : "";
$turno = isset($_POST['turno']) ? $_POST['turno'] : "";
$detalles_evento = isset($_POST['detalles_evento']) ? $_POST['detalles_evento'] : "";
$tipo_evento = isset($_POST['tipo_evento']) ? $_POST['tipo_evento'] : "";

if (!$peticion && !$id_evento && !$id_condomino && !$cantidad_personas && !$fecha && !$turno && !$detalles_evento && !$tipo_evento) {
  header('Content-Type: application/json');
  $jsonData = file_get_contents('php://input');
  $data = json_encode($jsonData, true);
  $peticion = $data['peticion'] ?? null;
  $id_evento = $data['id_evento'] ?? null;
  $id_condomino = $data['id_condomino'] ?? null;
  $cantidad_personas = $data['cantidad_personas'] ?? null;
  $fecha = $data['fecha'] ?? null;
  $turno = $data['turno'] ?? null;
  $detalles_evento = $data['turno'] ?? null;
  $tipo_evento = $data['tipo_evento'] ?? null;
}

//Procesamiento de los datos
switch ($peticion) {
  case "INSERT":
    $ctrl = new CtrlMtoReservarEventos("INSERT");
    if (!$ctrl->validaAtributos(null, $id_condomino, $cantidad_personas, $fecha, $turno, $detalles_evento, $tipo_evento)) {
      echo json_encode(["result" => 0, "msg" => "ERROR: Datos inválidos"]);
    } else if ($ctrl->hayTraslape($fecha, $turno, 0)) {
      echo json_encode(["result" => 0, "msg" => "Ya hay un evento asignado con esa fecha y turno"]);
    } else {
      $foto_path = guardarFoto(null, null, "eventos", "fotos_eventos");
      if ($foto_path === SITE_URL . "uploads/placeholderimage.jpg") {
        echo json_encode(["result" => 0, "msg" => "No se recibió ninguna foto, por favor sube una"]);
      } else if ($ctrl->insertaRegistro($id_condomino, $cantidad_personas, $fecha, $turno, $detalles_evento, $tipo_evento, $foto_path)) {
        echo json_encode(["result" => 1, "msg" => "Evento agendado correctamente"]);
      } else {
        echo json_encode(["result" => 0, "msg" => "ERROR: Problema de inserción en BD"]);
      }
    }
    break;
  case "UPDATE":
    $ctrl = new CtrlMtoReservarEventos("UPDATE", $id_evento, $id_condomino);
    if (!$ctrl->validaAtributos($id_evento, $id_condomino, $cantidad_personas, $fecha, $turno, $detalles_evento, $tipo_evento)) {
      echo json_encode(["result" => 0, "msg" => "ERROR: Datos inválidos"]);
    } else if ($ctrl->hayTraslape($fecha, $turno, $id_evento)) {
      echo json_encode(["result" => 0, "msg" => "Ya hay un evento asignado con esa fecha y turno"]);
    } else {
      $foto_path = guardarFoto("UPDATE", $id_evento, "eventos", "fotos_eventos");
      if ($ctrl->modificaRegistro($id_evento, $id_condomino, $cantidad_personas, $fecha, $turno, $detalles_evento, $tipo_evento, $foto_path)) {
        echo json_encode(["result" => 1, "msg" => "Evento modificado correctamente"]);
      } else {
        echo json_encode(["result" => 0, "msg" => "ERROR: Problema de modificación en BD"]);
      }
    }
    break;
  default:
    echo json_encode(["result" => 0, "msg" => "ERROR: Petición inválida"]);
    die();
}
