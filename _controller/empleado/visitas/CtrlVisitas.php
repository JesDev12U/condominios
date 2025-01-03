<?php
ini_set('display_errors', E_ALL); // Solo para pruebas

date_default_timezone_set("America/Mexico_City");
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
        "visitas.fecha",
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

  public function registrarVisita($id_invitado, $id_condomino, $id_empleado)
  {
    //Verificamos si se trata de una salida
    $model = new Model();
    $query = $model->seleccionaRegistros(
      "visitas",
      ["horario_entrada"],
      "id_invitado = $id_invitado AND horario_salida IS NULL"
    );
    if (count($query) === 0) {
      //Se trata de una entrada
      $datos = $model->seleccionaRegistros(
        "detalle_invitados",
        [
          "asunto",
          "integrantes"
        ],
        "id_invitado=$id_invitado"
      );
      return $model->agregaRegistroID(
        "visitas",
        [
          "id_condomino",
          "id_invitado",
          "id_empleado",
          "fecha",
          "horario_entrada",
          "asunto",
          "integrantes"
        ],
        [
          (int)$id_condomino,
          (int)$id_invitado,
          (int)$id_empleado,
          date("Y-m-d"),
          date("H:i:s"),
          $datos[0]['asunto'],
          $datos[0]['integrantes']
        ]
      ) == 0;
    }
    $horario_entrada = $query[0]["horario_entrada"];
    //Se trata de una salida
    return $model->modificaRegistro(
      "visitas",
      ["horario_salida"],
      "id_invitado=$id_invitado AND horario_entrada = '$horario_entrada'",
      [date("H:i:s")]
    );
  }
}
