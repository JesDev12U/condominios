<?php
require_once __DIR__ . "/../../../_model/Model.php";

class CtrlMtoCondominos
{
  const VISTA = __DIR__ . "/../../../_view/admin/gestor_condominos/mto_condominos.php";
  const CSS = __DIR__ . "/../../../css/admin/mto_condominos.css";
  const JS = __DIR__ . "/../../../js/admin/mto_condominos.js";
  public $peticion;
  public $id_condomino;
  public $nombre;
  public $email;
  public $telefono;
  public $telefono_emergencia;
  public $torre;
  public $departamento;
  public $tipo;
  public $foto_path;
  public $habilitado;
  public $title;
  public $opciones;

  public function __construct($peticion = null, $id_condomino = null, $usuario = "administrador")
  {
    if ($usuario === "administrador") {
      $this->title = "Mantenimiento de condóminos";
      $this->opciones = [
        ["nombre" => ICON_HOME, "href" => SITE_URL . RUTA_ADMINISTRADOR, "id" => "home"],
        ["nombre" => ICON_CONDOMINOS, "href" => SITE_URL . RUTA_ADMINISTRADOR . "gestor-condominos", "id" => "gestor-condominos"],
        ["nombre" => ICON_EMPLEADOS, "href" => SITE_URL . RUTA_ADMINISTRADOR . "gestor-empleados", "id" => "gestor-empleados"],
        ["nombre" => ICON_RESERVACIONES, "href" => SITE_URL . RUTA_ADMINISTRADOR . "gestor-reservaciones", "id" => "gestor-reservaciones"],
        ["nombre" => ICON_VISITAS, "href" => SITE_URL . RUTA_ADMINISTRADOR . "reporte-visitas", "id" => "reporte-visitas"],
        ["nombre" => ICON_CUENTA, "href" => SITE_URL . RUTA_ADMINISTRADOR . "configuracion", "id" => "configuracion"],
        ["nombre" => ICON_CERRAR_SESION, "href" => SITE_URL . RUTA_CERRAR_SESION, "id" => "cerrar-sesion"]
      ];
    } else {
      $this->title = "Configuración de la cuenta";
      $this->opciones = [
        ["nombre" => ICON_HOME, "href" => SITE_URL . RUTA_CONDOMINO, "id" => "home"],
        ["nombre" => ICON_EVENTOS, "href" => SITE_URL . RUTA_CONDOMINO . "reservar-eventos", "id" => "reservar-eventos"],
        ["nombre" => ICON_INVITADOS, "href" => SITE_URL . RUTA_CONDOMINO . "invitados", "id" => "invitados"],
        ["nombre" => ICON_CERRAR_SESION, "href" => SITE_URL . RUTA_CERRAR_SESION, "id" => "cerrar-sesion"]
      ];
    }
    $this->peticion = $peticion;
    $this->id_condomino = $id_condomino;
    if ($id_condomino !== null) {
      $res = $this->seleccionaRegistro($id_condomino);
      if (count($res) !== 0) {
        $this->nombre = $res[0]["nombre"];
        $this->email = $res[0]["email"];
        $this->telefono = $res[0]["telefono"];
        $this->telefono_emergencia = $res[0]["telefono_emergencia"];
        $this->torre = $res[0]["torre"];
        $this->departamento = $res[0]["departamento"];
        $this->tipo = $res[0]["tipo"];
        $this->foto_path = $res[0]["foto_path"];
        $this->habilitado = $res[0]["habilitado"];
      }
    }
  }



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

  public function validaAtributos($id_condomino = null, $nombre = null, $email = null, $password = null, $telefono = null, $telefono_emergencia = null, $torre = null, $departamento = null, $tipo = null)
  {
    $res = true;
    if (!is_null($id_condomino)) {
      $id_condomino = (int)$id_condomino;
      $res = $res && is_integer(($id_condomino)) && $id_condomino > 0;
    }
    if (!is_null($nombre)) {
      $res = $res && $nombre !== "" && strlen($nombre) <= 50;
    }
    if (!is_null($email)) {
      $res = $res && preg_match('/^[\w\.-]+@([\w-]+\.)+[\w-]{2,4}$/', $email, $matches) && strlen($email) <= 80;
    }
    if (!is_null($password)) {
      $res = $res && $password !== "" && strlen($password) <= 16;
    }
    if (!is_null($telefono)) {
      $res = $res && preg_match('/[0-9]{10}/', $telefono, $matches);
    }
    if (!is_null($telefono_emergencia)) {
      $res = $res && preg_match('/[0-9]{10}/', $telefono_emergencia, $matches);
    }
    if (!is_null($torre)) {
      $res = $res && $torre !== "" && strlen($torre) <= 5;
    }
    if (!is_null($departamento)) {
      $res = $res && $departamento !== "" && strlen($departamento) <= 30;
    }
    if (!is_null($tipo)) {
      $res = $res && $tipo !== "" && strlen($tipo) <= 15;
    }
    return $res;
  }

  public function seleccionaRegistro($id_condomino)
  {
    $model = new Model();
    return $model->seleccionaRegistros("condominos", ["*"], "id_condomino=$id_condomino");
  }

  public function seleccionaFoto($id_condomino)
  {
    $model = new Model();
    return $model->seleccionaRegistros("condominos", ['foto_path'], "id_condomino=$id_condomino");
  }

  public function insertaRegistro($nombre, $email, $password, $telefono, $telefono_emergencia, $torre, $departamento, $tipo, $foto_path)
  {
    $model = new Model();
    return $model->agregaRegistro(
      "condominos",
      [
        "nombre",
        "email",
        "password",
        "telefono",
        "telefono_emergencia",
        "torre",
        "departamento",
        "tipo",
        "foto_path",
        "habilitado"
      ],
      [
        $nombre,
        $email,
        $password,
        $telefono,
        $telefono_emergencia,
        $torre,
        $departamento,
        $tipo,
        $foto_path,
        true
      ]
    );
  }

  public function modificaRegistro($id_condomino, $nombre, $email, $password, $telefono, $telefono_emergencia, $torre, $departamento, $tipo, $foto_path)
  {
    $model = new Model();
    //Comprobación de que la foto no se debe subir vacía
    $foto_path = $foto_path  === "" ? $this->foto_path : $foto_path;
    $campos = [];
    $variables = [];
    if ($password === null) {
      $campos = [
        "nombre",
        "email",
        "telefono",
        "telefono_emergencia",
        "torre",
        "departamento",
        "tipo",
        "foto_path"
      ];
      $variables = [
        $nombre,
        $email,
        $telefono,
        $telefono_emergencia,
        $torre,
        $departamento,
        $tipo,
        $foto_path
      ];
    } else {
      $campos = [
        "nombre",
        "email",
        "password",
        "telefono",
        "telefono_emergencia",
        "torre",
        "departamento",
        "tipo",
        "foto_path"
      ];
      $variables = [
        $nombre,
        $email,
        $password,
        $telefono,
        $telefono_emergencia,
        $torre,
        $departamento,
        $tipo,
        $foto_path
      ];
    }
    return $model->modificaRegistro("condominos", $campos, "id_condomino=$id_condomino", $variables);
  }

  public function deshabilitarRegistro($id_condomino)
  {
    $model = new Model();
    return $model->modificaRegistro("condominos", ["habilitado"], "id_condomino=$id_condomino", [0]);
  }

  public function habilitarRegistro($id_condomino)
  {
    $model = new Model();
    return $model->modificaRegistro("condominos", ["habilitado"], "id_condomino=$id_condomino", [1]);
  }
}
