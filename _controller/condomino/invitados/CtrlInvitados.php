<?php
require_once __DIR__ . "/../../../_model/Model.php";

class CtrlInvitados
{
  const VISTA = __DIR__ . "/../../../_view/condomino/invitados/invitados.php";
  const CSS = __DIR__ . "/../../../css/condomino/invitados.css";
  const JS = __DIR__ . "/../../../js/condomino/invitados.js";
  public $datos = null;

  function __construct($id_condomino)
  {
    $model = new Model();
    $this->datos = $model->seleccionaRegistros(
      "invitados",
      ["*"],
      "id_condomino=$id_condomino",
      null,
      "INNER JOIN detalle_invitados ON invitados.id_invitado = detalle_invitados.id_invitado"
    );
  }

  public $opciones = [
    ["nombre" => ICON_HOME, "href" => SITE_URL . RUTA_CONDOMINO, "id" => "home"],
    ["nombre" => ICON_EVENTOS, "href" => SITE_URL . RUTA_CONDOMINO . "reservar-eventos", "id" => "reservar-eventos"],
    ["nombre" => ICON_CUENTA, "href" => SITE_URL . RUTA_CONDOMINO . "configuracion", "id" => "configuracion"],
    ["nombre" => ICON_CERRAR_SESION, "href" => SITE_URL . RUTA_CERRAR_SESION, "id" => "cerrar-sesion"]
  ];

  public $title = "Invitados";

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
