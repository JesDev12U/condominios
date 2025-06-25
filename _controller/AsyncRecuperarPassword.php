<?php
ini_set('display_errors', E_ALL); //Esta linea solo es para pruebas, no dejar en produccion
session_start();

require_once __DIR__ . "/../config/Global.php";
require_once __DIR__ . "/CtrlRecuperarPassword.php";
require_once __DIR__ . "/CtrlEmail.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  echo json_encode(["result" => 0, "msg" => "Método no permitido"]);
  die();
}

//Recepción de los datos
$operacion = isset($_POST['operacion']) ? $_POST['operacion'] : "";
$email = isset($_POST['email']) ? $_POST['email'] : "";
$codigo = isset($_POST['codigo']) ? $_POST['codigo'] : "";
$password = isset($_POST['password']) ? $_POST['password'] : "";

if (!$operacion && !$email && !$codigo && !$password) {
  header('Content-Type: application/json');
  $jsonData = file_get_contents("php://input");
  $data = json_encode($jsonData, true);
  $operacion = $data['operacion'] ?? null;
  $email = $data['email'] ?? null;
  $codigo = $data['codigo'] ?? null;
  $password = $data['password'] ?? null;
}

//Procesamiento de los datos
switch ($operacion) {
  case "enviar_codigo":
    //Verificar si existe el correo en la base de datos
    $ctrlEmail = new CtrlEmail($email);
    if (!$ctrlEmail->existeEmail()) {
      echo json_encode(["result" => 0, "msg" => "El correo ingresado no existe en la base de datos"]);
    } else {
      $ctrl = new CtrlRecuperarPassword();
      $codigoVerificacion = $ctrl->enviarCodigo($email);
      if ($codigoVerificacion === null) {
        echo json_encode(["result" => 0, "msg" => "Error al enviar el código"]);
      } else {
        $_SESSION['codigo'] = $codigoVerificacion;
        $_SESSION['email'] = $email;
        echo json_encode(["result" => 1, "msg" => "Código enviado correctamente"]);
      }
    }
    break;
  case "comprobar_codigo":
    if (!isset($_SESSION['codigo'])) {
      echo json_encode(["result" => 0, "msg" => "No haz solicitado el código"]);
    } else if ($codigo != $_SESSION['codigo']) {
      echo json_encode(["result" => 0, "msg" => "Código inválido"]);
    } else if ($codigo == $_SESSION['codigo']) {
      echo json_encode(["result" => 1, "msg" => "Código correcto"]);
    }
    break;
  case "cambiar_password":
    $ctrl = new CtrlRecuperarPassword();
    if (!isset($_SESSION['codigo']) || !isset($_SESSION['email'])) {
      echo json_encode(["result" => 0, "msg" => "Solicitud inválida"]);
    } else if ($ctrl->cambiarPassword($_SESSION['email'], $password)) {
      session_unset();
      session_destroy();
      echo json_encode(["result" => 1, "msg" => "Contraseña actualizada correctamente"]);
    } else {
      echo json_encode(["result" => 0, "msg" => "No se pudo actualizar la contraseña"]);
    }
    break;
  default:
    echo json_encode(["result" => 0, "msg" => "ERROR: Petición inválida"]);
    die();
}
