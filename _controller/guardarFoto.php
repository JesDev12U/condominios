<?php
require_once __DIR__ . "/../config/Global.php";

function guardarFoto($peticion = null, $id = null, $user)
{
  $foto_path = "";
  if (isset($_FILES['foto_path']) && $_FILES['foto_path']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['foto_path']['tmp_name'];
    $fileName = $_FILES['foto_path']['name'];
    $fileSize = $_FILES['foto_path']['size'];
    $fileType = $_FILES['foto_path']['type'];
    $uploadDir = __DIR__ . "/../uploads/fotos_users/";
    //Extensión del archivo
    $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
    //Verificación de que el archivo es una imágen
    $allowedFileTypes = ['image/jpeg', 'image/png', 'image/gif'];
    if (in_array($fileType, $allowedFileTypes)) {
      //Verificación del tamaño del archivo a 5MB
      if ($fileSize <= 5 * 1024 * 1024) {
        //Nombre único
        $uniqueName = uniqid($user . '_', true) . '.' . $fileExtension;
        //Ruta completa para guardar el archivo
        $destPath = $uploadDir . $uniqueName;

        //Mover el archivo de la carpeta temporal a la carpeta destino
        if (move_uploaded_file($fileTmpPath, $destPath)) {
          $foto_path = str_replace(__DIR__ . "/../", SITE_URL, $destPath);
          //Eliminar la foto anterior si es que se trata de un UPDATE
          if ($peticion === "UPDATE") {
            switch ($user) {
              case "empleado":
                require_once __DIR__ . "/admin/gestor_empleados/CtrlMtoEmpleados.php";
                $ctrl = new CtrlMtoEmpleados("UPDATE", $id);
                break;
              case "condomino":
                require_once __DIR__ . "/admin/gestor_condominos/CtrlMtoCondominos.php";
                $ctrl = new CtrlMtoCondominos("UPDATE", $id);
                break;
              default:
                echo json_encode(["result" => 0, "msg" => "Usuario inválido"]);
                die();
            }
            $query = $ctrl->seleccionaFoto($id);
            $foto_anterior = $query[0]['foto_path'];
            $foto_anterior = str_replace(SITE_URL, __DIR__ . "/../", $foto_anterior);
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
