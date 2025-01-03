<?php
require_once __DIR__ . "/../../../config/Global.php";
require_once __DIR__ . "/../../condomino/invitados/CtrlMtoInvitados.php";
require_once __DIR__ . "/../visitas/CtrlVisitas.php";
session_start();
ini_set('display_errors', E_ALL); // Solo para pruebas

$json_qr_cifrado = file_get_contents("php://input");

//Desencriptamos el JSON
$iv_length = openssl_cipher_iv_length(METODO_ENCRIPTACION);
$iv = openssl_random_pseudo_bytes($iv_length);
$datos = base64_decode($json_qr_cifrado);
$iv_extraido = substr($datos, 0, $iv_length);
$cifrado_extraido = substr($datos, $iv_length);
$json_qr = openssl_decrypt($cifrado_extraido, METODO_ENCRIPTACION, KEY_ENCRIPTACION, 0, $iv_extraido);

header('Content-Type: application/json');

$json = json_decode($json_qr);

//Verificamos que el JSON tenga lo esperado
$id_invitado = $json->{'id_invitado'} ?? null;
$id_condomino = $json->{'id_condomino'} ?? null;
$curp = $json->{'curp'} ?? null;

if (!$id_invitado || !$id_condomino || !$curp) {
  echo json_encode(["result" => 0, "msg" => "Datos incompletos, no se puede procesar el QR, $json"]);
  die();
}

//Verificamos que el CURP sea válido
$mtoInvitados = new CtrlMtoInvitados();

if (!$mtoInvitados->existeCURP($curp, $id_condomino)) {
  echo json_encode(["result" => 0, "msg" => "No existe el CURP"]);
  die();
}

//Con todo correcto, registramos la visita
$visitas = new CtrlVisitas();
$id_empleado = $_SESSION["datos"]["id_empleado"];

if ($visitas->registrarVisita($id_invitado, $id_condomino, $id_empleado)) {
  echo json_encode(["result" => 1, "msg" => "¡Visita registrada correctamente!"]);
  die();
} else {
  echo json_encode(["result" => 0, "msg" => "Problema de inserción en la BD, $id_invitado, $id_condomino, $id_empleado"]);
  die();
}
