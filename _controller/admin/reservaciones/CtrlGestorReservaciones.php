<?php
require_once __DIR__ . "/../../../_model/Model.php";

class CtrlGestorReservaciones
{
  const VISTA = __DIR__ . "/../../../_view/admin/reservaciones/gestor_reservaciones.php";
  const CSS = __DIR__ . "/../../../css/admin/gestor_reservaciones.css";
  const JS = __DIR__ . "/../../../js/admin/gestor_reservaciones.js";
  public $datos = null;

  function __construct()
  {
    $model = new Model();
    $this->datos = $model->seleccionaRegistros(
      "eventos",
      [
        "eventos.id_evento",
        "eventos.id_condomino",
        "condominos.nombre",
        "eventos.cantidad_personas",
        "eventos.fecha",
        "eventos.turno",
        "eventos.detalles_evento",
        "eventos.tipo_evento",
        "eventos.foto_path",
        "eventos.cancelado"
      ],
      null,
      null,
      "INNER JOIN condominos ON eventos.id_condomino = condominos.id_condomino"
    );
  }

  public $opciones = [
    ["nombre" => "Home", "href" => SITE_URL . RUTA_ADMINISTRADOR, "id" => "home"],
    ["nombre" => "Cerrar sesión", "href" => SITE_URL . RUTA_CERRAR_SESION, "id" => "cerrar-sesion"]
  ];

  public $title = "Gestor de reservaciones";

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
}
