<?php
ini_set('display_errors', E_ALL); //Esta linea solo es para pruebas, no dejar en produccion
session_start();

require_once __DIR__ . "/../../../config/Global.php";
require_once __DIR__ . "/CtrlMtoInvitados.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  echo json_encode(["result" => 0, "msg" => "Método no permitido"]);
  die();
}

//Recepción de los datos
$peticion = isset($_POST['peticion']) ? $_POST['peticion'] : "";
$id_invitado = isset($_POST['id_invitado']) ? $_POST['id_invitado'] : "";
$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : "";
$curp = isset($_POST['curp']) ? $_POST['curp'] : "";
$horario_inicio = isset($_POST['horario_inicio']) ? $_POST['horario_inicio'] : "";
$horario_final = isset($_POST['horario_final']) ? $_POST['horario_final'] : "";
$asunto = isset($_POST['asunto']) ? $_POST['asunto'] : "";
$integrantes = isset($_POST['integrantes']) ? $_POST['integrantes'] : "";

if (!$peticion && !$nombre && !$curp && !$horario_inicio && !$horario_final && !$asunto && !$integrantes) {
  header('Content-Type: application/json');
  $jsonData = file_get_contents('php://input');
  $data = json_encode($jsonData, true);
  $peticion = $data['peticion'] ?? null;
  $id_invitado = $data['id_invitado'] ?? null;
  $nombre = $data['nombre'] ?? null;
  $curp = $data['curp'] ?? null;
  $horario_inicio = $data['horario_inicio'] ?? null;
  $horario_final = $data['horario_final'] ?? null;
  $asunto = $data['asunto'] ?? null;
  $integrantes = $data['integrantes'] ?? null;
}

$id_condomino = $_SESSION["datos"]["id_condomino"];
//Procesamiento de los datos
switch ($peticion) {
  case "INSERT":
    $ctrl = new CtrlMtoInvitados("INSERT");
    if (!$ctrl->validaAtributos(
      null,
      $nombre,
      $curp,
      $id_condomino,
      $horario_inicio,
      $horario_final,
      $asunto,
      $integrantes
    )) {
      echo json_encode(["result" => 0, "msg" => "ERROR: Datos inválidos"]);
    } else if ($ctrl->existeCURP($curp, $id_condomino)) {
      echo json_encode(["result" => 0, "msg" => "Ese CURP ya existe"]);
    } else if ($ctrl->insertaRegistro(
      $nombre,
      $curp,
      $id_condomino,
      $horario_inicio,
      $horario_final,
      $asunto,
      $integrantes
    )) {
      echo json_encode(["result" => 1, "msg" => "Registro insertado correctamente"]);
    } else {
      echo json_encode(["result" => 0, "msg" => "ERROR: Problema de inserción en BD"]);
    }
    break;
  case "UPDATE":
    $ctrl = new CtrlMtoInvitados("UPDATE", $id_invitado);
    $oldCURP = $ctrl->seleccionaRegistro($id_invitado)[0]["curp"];
    if (!$ctrl->validaAtributos(
      $id_invitado,
      $nombre,
      $curp,
      $id_condomino,
      $horario_inicio,
      $horario_final,
      $asunto,
      $integrantes
    )) {
      echo json_encode(["result" => 0, "msg" => "ERROR: Datos inválidos"]);
    } else if ($ctrl->existeCURP($curp, $id_condomino) && $curp !== $oldCURP) {
      echo json_encode(["result" => 0, "msg" => "Ese CURP ya existe"]);
    } else if ($ctrl->modificaRegistro(
      $id_invitado,
      $nombre,
      $curp,
      $id_condomino,
      $horario_inicio,
      $horario_final,
      $asunto,
      $integrantes
    )) {
      echo json_encode(
        [
          "result" => 1,
          "msg" => "Registro modificado correctamente",
          "nuevos_datos" => [
            "id_invitado" => $id_invitado,
            "nombre" => $nombre,
            "curp" => $curp,
            "id_condomino" => $id_condomino,
            "horario_inicio" => $horario_inicio,
            "horario_final" => $horario_final,
            "asunto" => $asunto,
            "integrantes" => $integrantes
          ]
        ]
      );
    } else {
      echo json_encode(["result" => 0, "msg" => "ERROR: Problema de modificación en BD"]);
    }
    break;
  default:
    echo json_encode(["result" => 0, "msg" => "ERROR: Petición inválida"]);
    die();
}
