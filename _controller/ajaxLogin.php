<?php
//Recibe datos JSON desde el cliente
$input = file_get_contents("php://input");
$data = json_decode($input, true);
$resultado = false;

//sleep(5);

//Validamos los datos
if (isset($data['user'], $data['email'], $data['password'])) {
  //TODO:Busqueda en la base de datos
  $resultado = false;
} else {
  $resultado = false;
}

echo json_encode(["resultado" => $resultado]);
