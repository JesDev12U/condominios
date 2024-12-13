<?php
session_start();
//Recibe datos JSON desde el cliente
$input = file_get_contents("php://input");
$data = json_decode($input, true);
$resultado = false;
$usuario = "";

//sleep(5);

//Validamos los datos
if (isset($data['email'], $data['password'])) {
  //TODO:Busqueda en la base de datos
  //Supongamos que el usuario existe por lo mientras y que es condomino
  $_SESSION["loggeado"] = true;
  $usuario = $_SESSION["usuario"] = "condomino";
  $resultado = true;
} else {
  $resultado = false;
}

echo json_encode(["resultado" => $resultado, "usuario" => $usuario]);
