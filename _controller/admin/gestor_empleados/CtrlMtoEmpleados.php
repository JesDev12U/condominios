<?php
require_once __DIR__ . "/../../../_model/Model.php";

class CtrlMtoEmpleados
{
  const VISTA = __DIR__ . "/../../../_view/admin/gestor_empleados/mto_empleados.php";
  const CSS = __DIR__ . "/../../../css/admin/mto_empleados.css";
  const JS = __DIR__ . "/../../../js/admin/mto_empleados.js";
  public $peticion;
  public $id_empleado;
  public $nombre;
  public $email;
  public $telefono;
  public $telefono_emergencia;
  public $foto_path;
  public $habilitado;

  public function __construct($peticion = null, $id_empleado = null)
  {
    $this->peticion = $peticion;
    $this->id_empleado = $id_empleado;
    if ($id_empleado !== null) {
      $res = $this->seleccionaRegistro($id_empleado);
      if (count($res) !== 0) {
        $this->nombre = $res[0]["nombre"];
        $this->email = $res[0]["email"];
        $this->telefono = $res[0]["telefono"];
        $this->telefono_emergencia = $res[0]["telefono_emergencia"];
        $this->foto_path = $res[0]["foto_path"];
        $this->habilitado = $res[0]["habilitado"];
      }
    }
  }

  public $opciones = [
    ["nombre" => "Home", "href" => SITE_URL . "administrador", "id" => "home"],
    ["nombre" => "Gestor de empleados", "href" => SITE_URL . RUTA_ADMINISTRADOR . "gestor-empleados", "id" => "gestor-empleados"],
    ["nombre" => "Cerrar sesión", "href" => SITE_URL . RUTA_CERRAR_SESION, "id" => "cerrar-sesion"]
  ];

  public $title = "Mantenimiento de empleados";

  public function renderContent()
  {
    include self::VISTA;
  }

  public function renderCSS()
  {
    include self::CSS;
  }

  public function renderJS()
  {
    include self::JS;
  }

  public function validaAtributos($id_empleado = null, $nombre = null, $email = null, $password = null, $telefono = null, $telefono_emergencia = null)
  {
    $res = true;
    if (!is_null($id_empleado)) {
      $id_empleado = (int)$id_empleado;
      $res = $res && is_integer(($id_empleado)) && $id_empleado > 0;
    }
    if (!is_null($nombre)) {
      $res = $res && $nombre !== "";
    }
    if (!is_null($email)) {
      $res = preg_match('/^[\w\.-]+@([\w-]+\.)+[\w-]{2,4}$/', $email, $matches);
    }
    if (!is_null($password)) {
      $res = $res && $password !== "";
    }
    if (!is_null($telefono)) {
      $res = preg_match('/[0-9]{10}/', $telefono, $matches);
    }
    if (!is_null($telefono_emergencia)) {
      $res = preg_match('/[0-9]{10}/', $telefono_emergencia, $matches);
    }
    return $res;
  }

  public function seleccionaRegistro($id_empleado)
  {
    $model = new Model();
    return $model->seleccionaRegistros("empleados", ["*"], "id_empleado=$id_empleado");
  }

  public function seleccionaFoto($id_empleado)
  {
    $model = new Model();
    return $model->seleccionaRegistros("empleados", ['foto_path'], "id_empleado=$id_empleado");
  }

  public function insertaRegistro($nombre, $email, $password, $telefono, $telefono_emergencia, $foto_path)
  {
    $model = new Model();
    return $model->agregaRegistro(
      "empleados",
      [
        "nombre",
        "email",
        "password",
        "telefono",
        "telefono_emergencia",
        "foto_path",
        "habilitado"
      ],
      [
        $nombre,
        $email,
        $password,
        $telefono,
        $telefono_emergencia,
        $foto_path,
        true
      ]
    );
  }
  public function modificaRegistro($id_empleado, $nombre, $email, $telefono, $telefono_emergencia, $foto_path)
  {
    $model = new Model();
    //Comprobación de que la foto no se debe subir vacía
    $foto_path = $foto_path === "" ? $this->foto_path : $foto_path;
    return $model->modificaRegistro(
      "empleados",
      [
        "nombre",
        "email",
        "telefono",
        "telefono_emergencia",
        "foto_path"
      ],
      "id_empleado=$id_empleado",
      [
        $nombre,
        $email,
        $telefono,
        $telefono_emergencia,
        $foto_path
      ]
    );
  }

  public function deshabilitarRegistro($id_empleado)
  {
    $model = new Model();
    return $model->modificaRegistro("empleados", ["habilitado"], "id_empleado=$id_empleado", [0]);
  }

  public function habilitarRegistro($id_empleado)
  {
    $model = new Model();
    return $model->modificaRegistro("empleados", ["habilitado"], "id_empleado=$id_empleado", [1]);
  }
}
