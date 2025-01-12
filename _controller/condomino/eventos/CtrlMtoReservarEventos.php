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
    ["nombre" => ICON_HOME, "href" => SITE_URL . RUTA_CONDOMINO, "id" => "home"],
    ["nombre" => ICON_EVENTOS, "href" => SITE_URL . RUTA_CONDOMINO . "reservar-eventos", "id" => "reservar-eventos"],
    ["nombre" => ICON_INVITADOS, "href" => SITE_URL . RUTA_CONDOMINO . "invitados", "id" => "invitados"],
    ["nombre" => ICON_CUENTA, "href" => SITE_URL . RUTA_CONDOMINO . "configuracion", "id" => "configuracion"],
    ["nombre" => ICON_CERRAR_SESION, "href" => SITE_URL . RUTA_CERRAR_SESION, "id" => "cerrar-sesion"]
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

  public function seleccionaFoto($id_evento)
  {
    $model = new Model();
    return $model->seleccionaRegistros("eventos", ['foto_path'], "id_evento=$id_evento");
  }

  public function validaAtributos(
    $id_evento = null,
    $id_condomino = null,
    $cantidad_personas = null,
    $fecha = null,
    $turno = null,
    $detalles_evento = null,
    $tipo_evento = null,
  ) {
    $res = true;
    if (!is_null($id_evento)) {
      $id_evento = (int)$id_evento;
      $res = $res && is_integer($id_evento) && $id_evento > 0;
    }
    if (!is_null($id_condomino)) {
      $id_condomino = (int)$id_condomino;
      $res = $res && is_integer($id_condomino) && $id_condomino > 0;
    }
    if (!is_null($cantidad_personas)) {
      $cantidad_personas = (int)($cantidad_personas);
      $res = $res && is_integer($cantidad_personas) && $cantidad_personas > 0;
    }
    if (!is_null($fecha)) {
      $fecha = new DateTime($fecha);
      $res = $res && $fecha > new DateTime();
    }
    if (!is_null($turno)) {
      $res = $res && ($turno === "Matutino" || $turno === "Vespertino");
    }
    if (!is_null($detalles_evento)) {
      $res = $res && $detalles_evento !== "";
    }
    if (!is_null($tipo_evento)) {
      $res = $res && $tipo_evento !== "";
    }
    return $res;
  }

  public function hayTraslape($fecha, $turno, $id_evento)
  {
    $model = new Model();
    return count($model->seleccionaRegistros(
      "eventos",
      ["*"],
      "fecha='$fecha' AND turno='$turno' AND cancelado=false AND id_evento<>$id_evento"
    )) !== 0;
  }

  public function insertaRegistro($id_condomino, $cantidad_personas, $fecha, $turno, $detalles_evento, $tipo_evento, $foto_path)
  {
    $model = new Model();
    return $model->agregaRegistro(
      "eventos",
      [
        "id_condomino",
        "cantidad_personas",
        "fecha",
        "turno",
        "detalles_evento",
        "tipo_evento",
        "foto_path",
        "cancelado"
      ],
      [
        $id_condomino,
        $cantidad_personas,
        $fecha,
        $turno,
        $detalles_evento,
        $tipo_evento,
        $foto_path,
        0
      ]
    );
  }

  public function modificaRegistro($id_evento, $id_condomino, $cantidad_personas, $fecha, $turno, $detalles_evento, $tipo_evento, $foto_path)
  {
    $model = new Model();
    //Comprobación de que la foto no se debe subir vacía
    $foto_path = $foto_path === "" ? $this->foto_path : $foto_path;
    return $model->modificaRegistro(
      "eventos",
      [
        "id_condomino",
        "cantidad_personas",
        "fecha",
        "turno",
        "detalles_evento",
        "tipo_evento",
        "foto_path"
      ],
      "id_evento=$id_evento",
      [
        $id_condomino,
        $cantidad_personas,
        $fecha,
        $turno,
        $detalles_evento,
        $tipo_evento,
        $foto_path
      ],
    );
  }

  public function cancelarEvento($id_evento)
  {
    $model = new Model();
    return $model->modificaRegistro(
      "eventos",
      ["cancelado"],
      "id_evento=$id_evento",
      [1]
    );
  }

  public function reagendarEvento($id_evento)
  {
    $model = new Model();
    return $model->modificaRegistro(
      "eventos",
      ["cancelado"],
      "id_evento=$id_evento",
      [0]
    );
  }
}
