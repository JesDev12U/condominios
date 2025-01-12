<?php
ini_set('display_errors', E_ALL); // Solo para pruebas

require_once __DIR__ . "/../../../_model/Model.php";

class CtrlReporteVisitas
{
  const VISTA = __DIR__ . "/../../../_view/admin/reporte_visitas/reporte_visitas.php";
  const CSS = __DIR__ . "/../../../css/admin/reporte_visitas.css";
  const JS = __DIR__ . "/../../../js/admin/reporte_visitas.js";

  public $datos = null;

  function __construct()
  {
    $model = new Model();
    $this->datos = $model->seleccionaRegistros(
      "visitas",
      [
        "condominos.nombre AS nombre_condomino",
        "invitados.nombre AS nombre_invitado",
        "empleados.nombre AS nombre_empleado",
        "visitas.fecha",
        "visitas.horario_entrada",
        "visitas.horario_salida",
        "visitas.asunto",
        "visitas.integrantes"
      ],
      null,
      null,
      "INNER JOIN
        condominos
      ON
        visitas.id_condomino = condominos.id_condomino
      INNER JOIN
        invitados
      ON
        visitas.id_invitado = invitados.id_invitado
      INNER JOIN
        empleados
      ON
        visitas.id_empleado = empleados.id_empleado"
    );
  }

  public $opciones = [
    ["nombre" => ICON_HOME, "href" => SITE_URL . RUTA_ADMINISTRADOR, "id" => "home"],
    ["nombre" => ICON_CONDOMINOS, "href" => SITE_URL . RUTA_ADMINISTRADOR . "gestor-condominos", "id" => "gestor-condominos"],
    ["nombre" => ICON_EMPLEADOS, "href" => SITE_URL . RUTA_ADMINISTRADOR . "gestor-empleados", "id" => "gestor-empleados"],
    ["nombre" => ICON_RESERVACIONES, "href" => SITE_URL . RUTA_ADMINISTRADOR . "gestor-reservaciones", "id" => "gestor-reservaciones"],
    ["nombre" => ICON_CUENTA, "href" => SITE_URL . RUTA_ADMINISTRADOR . "configuracion", "id" => "configuracion"],
    ["nombre" => ICON_CERRAR_SESION, "href" => SITE_URL . RUTA_CERRAR_SESION, "id" => "cerrar-sesion"]
  ];

  public $title = "Reporte de visitas";

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
