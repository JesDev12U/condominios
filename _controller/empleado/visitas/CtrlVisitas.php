<?php
require_once __DIR__ . "/../../../_model/Model.php";

class CtrlVisitas
{
  const VISTA = __DIR__ . "/../../../_view/empleado/visitas/visitas.php";
  const CSS = __DIR__ . "/../../../css/empleado/visitas.css";
  const JS = __DIR__ . "/../../../js/empleado/visitas.js";

  public $datos = null;

  function __construct()
  {
    $model = new Model();
    $this->datos = $model->seleccionaRegistros(
      "visitas",
      [
        "condominos.nombre as nombre_condomino",
        "invitados.nombre as nombre_invitado",
        "visitas.horario_entrada",
        "visitas.horario_salida",
        "visitas.asunto",
        "visitas.integrantes"
      ],
      null,
      null,
      "INNER JOIN condominos ON visitas.id_condomino = condominos.id_condomino INNER JOIN invitados ON visitas.id_invitado = invitados.id_invitado;"
    );
  }

  public $opciones = [
    ["nombre" => "Home", "href" => SITE_URL . RUTA_EMPLEADO, "id" => "home"],
    ["nombre" => "Cerrar sesión", "href" => SITE_URL . RUTA_CERRAR_SESION, "id" => "cerrar-sesion"]
  ];

  public $title = "Visitas";

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
