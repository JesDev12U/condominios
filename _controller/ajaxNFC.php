<?php
ini_set('display_errors', E_ALL);
require_once __DIR__ . "/../config/Global.php";
require_once __DIR__ . "/../_model/Model.php";


$input = file_get_contents("php://input");
$data = json_decode($input, true);

// Validamos que se nos haya mandado los datos correctamente
if(!isset($data["Tipo"], $data["userID"])) {
  echo "NO AUTORIZADO";
  die();
} else if ($data["Tipo"] !== "Empleado" && $data["Tipo"] !== "Condomino" && $data["Tipo"] !== "Administrador") {
  echo "NO AUTORIZADO";
  die();
} else {
  // Verificamos en base de datos si existe el usuario
  $model = new Model();
  $userID = $data["userID"];
  $tabla = $data["Tipo"] === "Empleado" ? "empleados" : ($data["Tipo"] === "Condomino" ? "condominos" : "administrador");
  $validacionID = $data["Tipo"] === "Empleado" 
	  ? "id_empleado=$userID" 
	  : ($data["Tipo"] === "Condomino" 
	  ? "id_condomino=$userID" 
	  : "id_administrador=$userID");
  $resultado = $model->seleccionaRegistros($tabla, ["habilitado"], $validacionID);
  if (count($resultado) === 0) {
    // No encontró nada
    echo "NO AUTORIZADO";
    die();
  }
  // Si hay un registro, se verifica si está habilitado
  if (!$resultado[0]["habilitado"]) {
    echo "NO AUTORIZADO";
    die();
  }
  echo "AUTORIZADO";
}
