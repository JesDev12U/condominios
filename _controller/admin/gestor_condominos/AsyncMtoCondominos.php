<?php
ini_set('display_errors', E_ALL); //Esta linea solo es para pruebas, no dejar en produccion
session_start();

require_once __DIR__ . "/../../../config/Global.php";
require_once __DIR__ . "/CtrlMtoCondominos.php";
require_once __DIR__ . "/../../CtrlEmail.php";
require_once __DIR__ . "/../../guardarFoto.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  echo json_encode(["result" => 0, "msg" => "Método no permitido"]);
  die();
}

//Recepción de los datos
$peticion = isset($_POST['peticion']) ? $_POST['peticion'] : "";
$id_condomino = isset($_POST['id_condomino']) ? $_POST['id_condomino'] : "";
$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : "";
$email = isset($_POST['email']) ? $_POST['email'] : "";
$password = isset($_POST['password']) ? $_POST['password'] : "";
$telefono = isset($_POST['telefono']) ? $_POST['telefono'] : "";
$telefono_emergencia = isset($_POST['telefono_emergencia']) ? $_POST['telefono_emergencia'] : "";
$torre = isset($_POST['torre']) ? $_POST['torre'] : "";
$departamento = isset($_POST['departamento']) ? $_POST['departamento'] : "";
$tipo = isset($_POST['tipo']) ? $_POST['tipo'] : "";

if (!$peticion && !$id_condomino && !$nombre && !$email && !$password && !$telefono && !$telefono_emergencia && !$torre && !$departamento && !$tipo) {
  header('Content-Type: application/json');
  $jsonData = file_get_contents('php://input');
  $data = json_encode($jsonData, true);
  $peticion = $data['peticion'] ?? null;
  $id_condomino = $data['id_condomino'] ?? null;
  $nombre = $data['nombre'] ?? null;
  $email = $data['email'] ?? null;
  $password = $data['password'] ?? null;
  $telefono = $data['telefono'] ?? null;
  $telefono_emergencia = $data['telefono_emergencia'] ?? null;
  $torre = $data['torre'] ?? null;
  $departamento = $data['departamento'] ?? null;
  $tipo = $data['tipo'] ?? null;
}

//Procesamiento de los datos
switch ($peticion) {
  case "INSERT":
    $ctrl = new CtrlMtoCondominos("INSERT");
    if (!$ctrl->validaAtributos(null, $nombre, $email, $password, $telefono, $telefono_emergencia, $torre, $departamento, $tipo)) {
      echo json_encode(["result" => 0, "msg" => "ERROR: Datos inválidos"]);
    } else {
      $foto_path = guardarFoto(null, null, "condomino");
      $ctrlEmail = new CtrlEmail($email);
      if ($foto_path === "") {
        echo json_encode(["result" => 0, "msg" => "No se recibió ninguna foto, por favor sube una"]);
      } else if ($ctrlEmail->existeEmail()) {
        echo json_encode(["result" => 0, "msg" => "El correo electrónico enviado ya existe, elige otro"]);
      } else if ($ctrl->insertaRegistro($nombre, $email, password_hash($password, PASSWORD_DEFAULT), $telefono, $telefono_emergencia, $torre, $departamento, $tipo, $foto_path)) {
        echo json_encode(["result" => 1, "msg" => "Registro insertado correctamente"]);
      } else {
        echo json_encode(["result" => 0, "msg" => "ERROR: Problema de inserción en BD"]);
      }
    }
    break;
  case "UPDATE":
    $ctrl = new CtrlMtoCondominos("UPDATE", $id_condomino);
    if ($password === "") $password = null;
    if (!$ctrl->validaAtributos(null, $nombre, $email, $password, $telefono, $telefono_emergencia, $torre, $departamento, $tipo)) {
      echo json_encode(["result" => 0, "msg" => "ERROR: Datos inválidos"]);
    } else {
      $foto_path = guardarFoto("UPDATE", $id_condomino, "condomino");
      $ctrlEmail = new CtrlEmail($email);
      $oldEmail = $ctrl->seleccionaRegistro($id_condomino)[0]["email"];
      if ($ctrlEmail->existeEmail() && $email !== $oldEmail) {
        echo json_encode(["result" => 0, "msg" => "El correo electrónico enviado ya existe, elige otro"]);
      } else if ($ctrl->modificaRegistro($id_condomino, $nombre, $email, $password === null ? null : password_hash($password, PASSWORD_DEFAULT), $telefono, $telefono_emergencia, $torre, $departamento, $tipo, $foto_path)) {
        if ($_SESSION["usuario"] === "condomino") {
          $_SESSION["datos"]["nombre"] = $nombre;
          $_SESSION["datos"]["email"] = $email;
          $_SESSION["datos"]["telefono"] = $telefono;
          $_SESSION["datos"]["telefono_emergencia"] = $telefono_emergencia;
          $_SESSION["datos"]["torre"] = $torre;
          $_SESSION["datos"]["departamento"] = $departamento;
          $_SESSION["datos"]["tipo"] = $tipo;
          if ($foto_path !== "") $_SESSION["datos"]["foto_path"] = $foto_path;
        }
        echo json_encode(
          [
            "result" => 1,
            "msg" => "Registro modificado correctamente",
            "nuevos_datos" => [
              "nombre" => $nombre,
              "email" => $email,
              "telefono" => $telefono,
              "telefono_emergencia" => $telefono_emergencia,
              "torre" => $torre,
              "departamento" => $departamento,
              "tipo" => $tipo,
              "foto_path" => $foto_path
            ],
            "usuario" => $_SESSION["usuario"]
          ]
        );
      } else {
        echo json_encode(["result" => 0, "msg" => "ERROR: Problema de modificación en BD"]);
      }
    }
    break;
  default:
    echo json_encode(["result" => 0, "msg" => "ERROR: Petición inválida"]);
    die();
}
