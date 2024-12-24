<?php
require_once __DIR__ . "/../../../_model/Model.php";

class CtrlMtoEmpleados
{
  const VISTA = __DIR__ . "/../../../_view/admin/gestor_empleados/mto_empleados.php";
  const CSS = __DIR__ . "/../../../css/admin/mto_empleados.css";
  const JS = __DIR__ . "/../../../js/admin/mto_empleados.js";
  private $peticion;
  public $id_empleado;
  public $nombre;
  public $email;
  public $telefono;
  public $telefono_emergencia;
  public $foto_path;

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
        $this->telefono_emergencia[0]["telefono_emergencia"];
        $this->foto_path = $res[0]["foto_path"];
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

  public function seleccionaRegistro($id_empleado)
  {
    $model = new Model();
    return $model->seleccionaRegistros("empleados", ["*"], "id_empleado=$id_empleado");
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
        "foto_path"
      ],
      [
        $nombre,
        $email,
        $password,
        $telefono,
        $telefono_emergencia,
        $foto_path
      ]
    );
  }
}
