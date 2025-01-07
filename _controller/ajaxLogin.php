<?php
ini_set('display_errors', E_ALL); //Esta linea solo es para pruebas, no dejar en produccion
require_once __DIR__ . "/CtrlLogin.php";
session_start();
//Recibe datos JSON desde el cliente
$input = file_get_contents("php://input");
$data = json_decode($input, true);
$resultado = false;
$usuario = "";

//Validamos los datos
if (isset($data['email'], $data['password'])) {
  $ctrlLogin = new CtrlLogin();
  $peticion = $ctrlLogin->credencialesCorrectas($data['email'], $data['password']);
  if ($peticion !== null) {
    if (isset($_SESSION['codigo']) || isset($_SESSION['email'])) {
      session_unset();
    }
    $_SESSION["loggeado"] = true;
    $usuario = $_SESSION["usuario"] = $peticion;
    $_SESSION["datos"] = $ctrlLogin->obtenerDatosUsuario($peticion, $data['email']);
    $resultado = true;
  } else $resultado = false;
} else {
  $resultado = false;
}

echo json_encode(["resultado" => $resultado, "usuario" => $usuario]);
