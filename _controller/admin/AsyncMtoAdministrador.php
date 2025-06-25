<?php
ini_set('display_errors', E_ALL); //Esta linea solo es para pruebas, no dejar en produccion
session_start();

require_once __DIR__ . "/../../config/Global.php";
require_once __DIR__ . "/CtrlMtoAdministrador.php";
require_once __DIR__ . "/../CtrlEmail.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  echo json_encode(["result" => 0, "msg" => "Método no permitido"]);
  die();
}

//Recepción de los datos
$id_administrador = isset($_POST['id_administrador']) ? $_POST['id_administrador'] : "";
$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : "";
$email = isset($_POST['email']) ? $_POST['email'] : "";
$password = isset($_POST['password']) ? $_POST['password'] : "";

if (!$id_administrador && !$nombre && !$email && !$password) {
  header('Content-Type: application/json');
  $jsonData = file_get_contents("php://input");
  $data = json_encode($jsonData, true);
  $id_administrador = $data['id_administrador'] ?? null;
  $nombre = $data['nombre'] ?? null;
  $email = $data['email'] ?? null;
  $password = $data['password'] ?? null;
}

//Procesamiento de los datos
$ctrl = new CtrlMtoAdministrador($id_administrador);
if ($password === "") $password = null;
if (!$ctrl->validaAtributos(null, $nombre, $email, $password)) {
  echo json_encode(["result" => 0, "msg" => "ERROR: Datos inválidos"]);
} else {
  $ctrlEmail = new CtrlEmail($email);
  $oldEmail = $ctrl->seleccionaRegistro($id_administrador)[0]["email"];
  if ($ctrlEmail->existeEmail() && $email !== $oldEmail) {
    echo json_encode(["result" => 0, "msg" => "El correo electrónico enviado ya existe, elige otro"]);
  } else if ($ctrl->modificaRegistro($id_administrador, $nombre, $email, $password === null ? null : password_hash($password, PASSWORD_DEFAULT))) {
    $_SESSION["datos"]["nombre"] = $nombre;
    $_SESSION["datos"]["email"] = $email;
    echo json_encode(
      [
        "result" => 1,
        "msg" => "Registro modificado correctamente",
        "nuevos_datos" => [
          "nombre" => $nombre,
          "email" => $email
        ]
      ]
    );
  } else {
    echo json_encode(["result" => 0, "msg" => "ERROR: Problema de modificación en BD"]);
  }
}
