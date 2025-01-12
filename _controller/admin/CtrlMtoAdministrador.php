<?php
require_once __DIR__ . "/../../_model/Model.php";

class CtrlMtoAdministrador
{
  const VISTA = __DIR__ . "/../../_view/admin/mto_administrador.php";
  const CSS = __DIR__ . "/../../css/admin/mto_administrador.css";
  const JS = __DIR__ . "/../../js/admin/mto_administrador.js";
  public $id_administrador;
  public $nombre;
  public $email;
  public $title = "Configuración de la cuenta";
  public $opciones = [
    ["nombre" => ICON_HOME, "href" => SITE_URL . RUTA_ADMINISTRADOR, "id" => "home"],
    ["nombre" => ICON_CONDOMINOS, "href" => SITE_URL . RUTA_ADMINISTRADOR . "gestor-condominos", "id" => "gestor-condominos"],
    ["nombre" => ICON_EMPLEADOS, "href" => SITE_URL . RUTA_ADMINISTRADOR . "gestor-empleados", "id" => "gestor-empleados"],
    ["nombre" => ICON_RESERVACIONES, "href" => SITE_URL . RUTA_ADMINISTRADOR . "gestor-reservaciones", "id" => "gestor-reservaciones"],
    ["nombre" => ICON_VISITAS, "href" => SITE_URL . RUTA_ADMINISTRADOR . "reporte-visitas", "id" => "reporte-visitas"],
    ["nombre" => ICON_CERRAR_SESION, "href" => SITE_URL . RUTA_CERRAR_SESION, "id" => "cerrar-sesion"]
  ];

  public function __construct($id_administrador = null)
  {
    $this->id_administrador = $id_administrador;
    if ($id_administrador !== null) {
      $res = $this->seleccionaRegistro($id_administrador);
      if (count($res) !== 0) {
        $this->nombre = $res[0]["nombre"];
        $this->email = $res[0]["email"];
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

  public function validaAtributos($id_administrador = null, $nombre = null, $email = null, $password = null)
  {
    $res = true;
    if (!is_null($id_administrador)) {
      $id_administrador = (int)$id_administrador;
      $res = $res && is_integer(($id_administrador)) && $id_administrador > 0;
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
    return $res;
  }

  public function seleccionaRegistro($id_administrador)
  {
    $model = new Model();
    return $model->seleccionaRegistros("administrador", ["*"], "id_administrador=$id_administrador");
  }

  public function modificaRegistro($id_administrador, $nombre, $email, $password)
  {
    $model = new Model();
    $campos = [];
    $variables = [];
    if ($password === null) {
      $campos = ["nombre", "email"];
      $variables = [$nombre, $email];
    } else {
      $campos = ["nombre", "email", "password"];
      $variables = [$nombre, $email, $password];
    }
    return $model->modificaRegistro("administrador", $campos, "id_administrador=$id_administrador", $variables);
  }
}
