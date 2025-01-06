<?php
require_once __DIR__ . "/../../../_model/Model.php";

class CtrlMtoReservarEventos
{
  const VISTA = __DIR__ . "/../../../_view/condomino/eventos/mto_reservar_eventos.php";
  const CSS = __DIR__ . "/../../../css/condomino/mto_reservar_eventos.css";
  const JS = __DIR__ . "/../../../js/condomino/mto_reservar_eventos.js";
  public $peticion;
  public $id_evento;
  public $id_condomino;
  public $cantidad_personas;
  public $fecha;
  public $turno;
  public $detalles_evento;
  public $tipo_evento;
  public $foto_path;
  public $cancelado;

  public $title = "Mantenimiento de eventos";

  public function __construct($peticion = null, $id_evento = null, $id_condomino = null)
  {
    $this->peticion = $peticion;
    $this->id_evento = $id_evento;
    $this->id_condomino = $id_condomino;
    if ($id_evento !== null) {
      $res = $this->seleccionaRegistro($id_evento, $id_condomino);
      if (count($res) !== 0) {
        $this->cantidad_personas = $res[0]["cantidad_personas"];
        $this->fecha = $res[0]["fecha"];
        $this->turno = $res[0]["turno"];
        $this->detalles_evento = $res[0]["detalles_evento"];
        $this->tipo_evento = $res[0]["tipo_evento"];
        $this->foto_path = $res[0]["foto_path"];
        $this->cancelado = $res[0]["cancelado"];
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

  public function seleccionaRegistro($id_evento, $id_condomino)
  {
    $model = new Model();
    return $model->seleccionaRegistros(
      "eventos",
      ["*"],
      "id_evento=$id_evento AND id_condomino=$id_condomino"
    ) ?? [];
  }
}
