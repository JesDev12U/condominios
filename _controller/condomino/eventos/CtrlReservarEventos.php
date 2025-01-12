<?php
require_once __DIR__ . "/../../../_model/Model.php";

class CtrlReservarEventos
{
  const VISTA = __DIR__ . "/../../../_view/condomino/eventos/reservar_eventos.php";
  const CSS = __DIR__ . "/../../../css/condomino/reservar_eventos.css";
  const JS = __DIR__ . "/../../../js/condomino/reservar_eventos.js";
  public $datos = null;

  function __construct($id_condomino)
  {
    $model = new Model();
    $this->datos = $model->seleccionaRegistros(
      "eventos",
      ["*"],
      "id_condomino=$id_condomino"
    );
  }

  public $opciones = [
    ["nombre" => ICON_HOME, "href" => SITE_URL . RUTA_CONDOMINO, "id" => "home"],
    ["nombre" => ICON_INVITADOS, "href" => SITE_URL . RUTA_CONDOMINO . "invitados", "id" => "invitados"],
    ["nombre" => ICON_CUENTA, "href" => SITE_URL . RUTA_CONDOMINO . "configuracion", "id" => "configuracion"],
    ["nombre" => ICON_CERRAR_SESION, "href" => SITE_URL . RUTA_CERRAR_SESION, "id" => "cerrar-sesion"]
  ];

  public $title = "Eventos";

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
