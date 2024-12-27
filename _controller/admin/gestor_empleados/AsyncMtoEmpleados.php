<?php
ini_set('display_errors', E_ALL); //Esta linea solo es para pruebas, no dejar en produccion

require_once __DIR__ . "/../../../config/Global.php";
require_once __DIR__ . "/CtrlMtoEmpleados.php";
require_once __DIR__ . "/../../CtrlEmail.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  echo json_encode(["result" => 0, "msg" => "Método no permitido"]);
  die();
}

//Recepción de los datos
$peticion = isset($_POST['peticion']) ? $_POST['peticion'] : "";
$id_empleado = isset($_POST['id_empleado']) ? $_POST['id_empleado'] : "";
$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : "";
$email = isset($_POST['email']) ? $_POST['email'] : "";
$password = isset($_POST['password']) ? $_POST['password'] : "";
$telefono = isset($_POST['telefono']) ? $_POST['telefono'] : "";
$telefono_emergencia = isset($_POST['telefono_emergencia']) ? $_POST['telefono_emergencia'] : "";

if (!$peticion && !$id_empleado && !$nombre && !$email && !$password && !$telefono && !$telefono_emergencia) {
  header('Content-Type: application/json');
  $jsonData = file_get_contents("php://input");
  $data = json_encode($jsonData, true);
  $peticion = $data['peticion'] ?? null;
  $id_empleado = $data['id_empleado'] ?? null;
  $nombre = $data['nombre'] ?? null;
  $email = $data['email'] ?? null;
  $password = $data['password'] ?? null;
  $telefono = $data['telefono'] ?? null;
  $telefono_emergencia = $data['telefono_emergencia'] ?? null;
}

function guardarFoto($peticion = null, $id_empleado = null)
{
  $foto_path = "";
  if (isset($_FILES['foto_path']) && $_FILES['foto_path']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['foto_path']['tmp_name'];
    $fileName = $_FILES['foto_path']['name'];
    $fileSize = $_FILES['foto_path']['size'];
    $fileType = $_FILES['foto_path']['type'];
    $uploadDir = __DIR__ . "/../../../uploads/fotos_users/";
    //Extensión del archivo
    $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
    //Verificación de que el archivo es una imágen
    $allowedFileTypes = ['image/jpeg', 'image/png', 'image/gif'];
    if (in_array($fileType, $allowedFileTypes)) {
      //Verificación del tamaño del archivo a 5MB
      if ($fileSize <= 5 * 1024 * 1024) {
        //Nombre único
        $uniqueName = uniqid('empleado_', true) . '.' . $fileExtension;
        //Ruta completa para guardar el archivo
        $destPath = $uploadDir . $uniqueName;

        //Mover el archivo de la carpeta temporal a la carpeta destino
        if (move_uploaded_file($fileTmpPath, $destPath)) {
          $foto_path = str_replace(__DIR__ . "/../../../", SITE_URL, $destPath);
          //Eliminar la foto anterior si es que se trata de un UPDATE
          if ($peticion === "UPDATE") {
            $ctrl = new CtrlMtoEmpleados("UPDATE", $id_empleado);
            $query = $ctrl->seleccionaFoto($id_empleado);
            $foto_anterior = $query[0]['foto_path'];
            $foto_anterior = str_replace(SITE_URL, __DIR__ . "/../../../", $foto_anterior);
            if (file_exists($foto_anterior)) unlink($foto_anterior);
          }
        } else {
          echo json_encode(["result" => 0, "msg" => "Hubo un problema para almacenar la foto"]);
          die();
        }
      } else {
        echo json_encode(["result" => 0, "msg" => "El archivo excede el tamaño máximo permitido de 5MB."]);
        die();
      }
    } else {
      echo json_encode(["result" => 0, "msg" => "Solo se permiten archivos JPEG, PNG o GIF."]);
      die();
    }
  }
  return $foto_path;
}


//Procesamiento de los datos
switch ($peticion) {
  case "INSERT":
    $ctrl = new CtrlMtoEmpleados("INSERT");
    if (!$ctrl->validaAtributos(null, $nombre, $email, $password, $telefono, $telefono_emergencia)) {
      echo json_encode(["result" => 0, "msg" => "ERROR: Datos inválidos"]);
    } else {
      $foto_path = guardarFoto();
      $ctrlEmail = new CtrlEmail($email);
      if ($foto_path === "") {
        echo json_encode(["result" => 0, "msg" => "No se recibió ninguna foto, por favor sube una"]);
      } else if ($ctrlEmail->existeEmail()) {
        echo json_encode(["result" => 0, "msg" => "El correo electrónico enviado ya existe, elige otro"]);
      } else if ($ctrl->insertaRegistro($nombre, $email, password_hash($password, PASSWORD_DEFAULT), $telefono, $telefono_emergencia, $foto_path)) {
        echo json_encode(["result" => 1, "msg" => "Registro insertado correctamente"]);
      } else {
        echo json_encode(["result" => 0, "msg" => "ERROR: Problema de inserción en BD"]);
      }
    }
    break;
  case "UPDATE":
    $ctrl = new CtrlMtoEmpleados("UPDATE", $id_empleado);
    if (!$ctrl->validaAtributos(null, $nombre, $email, null, $telefono, $telefono_emergencia)) {
      echo json_encode(["result" => 0, "msg" => "ERROR: Datos inválidos"]);
    } else {
      $foto_path = guardarFoto("UPDATE", $id_empleado);
      $ctrlEmail = new CtrlEmail($email);
      $oldEmail = $ctrl->seleccionaRegistro($id_empleado)[0]["email"];
      if ($ctrlEmail->existeEmail() && $email !== $oldEmail) {
        echo json_encode(["result" => 0, "msg" => "El correo electrónico enviado ya existe, elige otro"]);
      } else if ($ctrl->modificaRegistro($id_empleado, $nombre, $email, $telefono, $telefono_emergencia, $foto_path)) {
        echo json_encode(["result" => 1, "msg" => "Registro modificado correctamente"]);
      } else {
        echo json_encode(["result" => 0, "msg" => "ERROR: Problema de modificación en BD"]);
      }
    }
    break;
  default:
    echo json_encode(["result" => 0, "msg" => "ERROR: Petición inválida"]);
    die();
}
