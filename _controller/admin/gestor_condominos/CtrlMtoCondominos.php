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

  public function __construct($peticion = null, $id_condomino = null)
  {
    $this->title = "Mantenimiento de condominos";
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

  public $opciones = [
    ["nombre" => "Home", "href" => SITE_URL . RUTA_CONDOMINO, "id" => "home"],
    ["nombre" => "Cerrar sesión", "href" => SITE_URL . RUTA_CERRAR_SESION, "id" => "cerrar-sesion"]
  ];


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
    if (!is_null($torre)) {
      $res = $res && $torre !== "";
    }
    if (!is_null($departamento)) {
      $res = $res && $departamento !== "";
    }
    if (!is_null($tipo)) {
      $res = $res && $tipo !== "";
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
