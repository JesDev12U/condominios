<?php
require_once __DIR__ . "/../../../_model/Model.php";
require_once __DIR__ . "/../../../config/Global.php";

class CtrlMtoInvitados
{
  const VISTA = __DIR__ . "/../../../_view/condomino/invitados/mto_invitados.php";
  const CSS = __DIR__ . "/../../../css/condomino/mto_invitados.css";
  const JS = __DIR__ . "/../../../js/condomino/mto_invitados.js";
  public $peticion;
  public $id_invitado;
  public $nombre;
  public $curp;
  public $id_condomino;
  public $horario_inicio;
  public $horario_final;
  public $json_qr;
  public $asunto;
  public $integrantes;
  public $ocultar;

  public $title = "Mantenimiento de invitados";

  public function __construct($peticion = null, $id_invitado = null)
  {
    $this->peticion = $peticion;
    $this->id_invitado = $id_invitado;
    if ($id_invitado !== null) {
      $res = $this->seleccionaRegistro($id_invitado);
      if (count($res) !== 0) {
        $this->nombre = $res[0]["nombre"];
        $this->curp = $res[0]["curp"];
        $this->id_condomino = $res[0]["id_condomino"];
        $this->horario_inicio = $res[0]["horario_inicio"];
        $this->horario_final = $res[0]["horario_final"];
        $this->json_qr = $res[0]["json_qr"];
        $this->asunto = $res[0]["asunto"];
        $this->integrantes = $res[0]["integrantes"];
        $this->ocultar = $res[0]["ocultar"];
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

  private function cifrarJSONQR($json_qr)
  {
    $iv_length = openssl_cipher_iv_length(METODO_ENCRIPTACION);
    $iv = openssl_random_pseudo_bytes($iv_length);
    $cifrado = openssl_encrypt($json_qr, METODO_ENCRIPTACION, KEY_ENCRIPTACION, 0, $iv);
    return base64_encode($iv . $cifrado);
  }

  private function validarHora($hora)
  {
    $formato = 'H:i'; // Formato de 24 horas: HH:mm
    $fecha = DateTime::createFromFormat($formato, $hora);

    // Verifica si la hora coincide con el formato y es válida
    return $fecha && $fecha->format($formato) === $hora;
  }

  public function validaAtributos(
    $id_invitado,
    $nombre,
    $curp,
    $id_condomino,
    $horario_inicio,
    $horario_final,
    $asunto,
    $integrantes
  ) {
    $res = true;
    if (!is_null($id_invitado)) {
      $id_invitado = (int)$id_invitado;
      $res = $res && is_integer($id_invitado) && $id_invitado > 0;
    }
    if (!is_null($nombre)) {
      $res = $res && $nombre !== "";
    }
    if (!is_null($curp)) {
      $res = preg_match('/^([A-Z][AEIOUX][A-Z]{2}\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])[HM](?:AS|B[CS]|C[CLMSH]|D[FG]|G[TR]|HG|JC|M[CNS]|N[ETL]|OC|PL|Q[TR]|S[PLR]|T[CSL]|VZ|YN|ZS)[B-DF-HJ-NP-TV-Z]{3}[A-Z\d])(\d)$/', $curp, $matches);
    }
    if (!is_null($id_condomino)) {
      $id_condomino = (int)$id_condomino;
      $res = $res && is_integer($id_condomino) && $id_condomino > 0;
    }
    if (!is_null($horario_inicio)) {
      $res = $res && $this->validarHora($horario_inicio);
    }
    if (!is_null($horario_final)) {
      $res = $res && $this->validarHora($horario_final);
    }
    if (!is_null($asunto)) {
      $res = $res && $asunto !== "";
    }
    if (!is_null($integrantes)) {
      $integrantes = (int)$integrantes;
      $res = $res && is_integer($integrantes) && $integrantes > 0;
    }
    return $res;
  }

  public function seleccionaRegistro($id_invitado)
  {
    $model = new Model();
    return $model->seleccionaRegistros(
      "invitados",
      ["*"],
      "invitados.id_invitado=$id_invitado",
      null,
      "INNER JOIN detalle_invitados ON invitados.id_invitado = detalle_invitados.id_invitado"
    );
  }

  public function insertaRegistro(
    $nombre,
    $curp,
    $id_condomino,
    $horario_inicio,
    $horario_final,
    $asunto,
    $integrantes
  ) {
    $model = new Model();
    $registroInvitado = $model->agregaRegistroID(
      "invitados",
      [
        "nombre",
        "curp"
      ],
      [
        $nombre,
        $curp
      ]
    );

    $data = [
      "id_invitado" => $registroInvitado,
      "id_condomino" => $id_condomino,
      "curp" => $curp
    ];

    $json_qr = json_encode($data);

    $json_qr_cifrado = $this->cifrarJSONQR($json_qr);

    $registroDetalleInvitados = $model->agregaRegistroID(
      "detalle_invitados",
      [
        "id_condomino",
        "id_invitado",
        "horario_inicio",
        "horario_final",
        "json_qr",
        "asunto",
        "integrantes",
        "ocultar"
      ],
      [
        $id_condomino,
        $registroInvitado,
        $horario_inicio,
        $horario_final,
        $json_qr_cifrado,
        $asunto,
        $integrantes,
        0
      ]
    );
    return $registroInvitado > 0 && $registroDetalleInvitados == 0;
  }

  public function modificaRegistro(
    $id_invitado,
    $nombre,
    $curp,
    $id_condomino,
    $horario_inicio,
    $horario_final,
    $asunto,
    $integrantes
  ) {
    $model = new Model();
    $data = [
      "id_invitado" => $id_invitado,
      "id_condomino" => $id_condomino,
      "curp" => $curp
    ];

    // Convertir el array a JSON
    $json_qr = json_encode($data);
    $json_qr_cifrado = $this->cifrarJSONQR($json_qr);

    $modificacionInvitado = $model->modificaRegistro(
      "invitados",
      [
        "nombre",
        "curp"
      ],
      "id_invitado=$id_invitado",
      [
        $nombre,
        $curp
      ]
    );
    $modificacionDetalleInvitados = $model->modificaRegistro(
      "detalle_invitados",
      [
        "horario_inicio",
        "horario_final",
        "json_qr",
        "asunto",
        "integrantes"
      ],
      "id_invitado=$id_invitado",
      [
        $horario_inicio,
        $horario_final,
        $json_qr_cifrado,
        $asunto,
        $integrantes
      ]
    );
    return $modificacionInvitado && $modificacionDetalleInvitados;
  }

  public function ocultarRegistro($id_invitado)
  {
    $model = new Model();
    return $model->modificaRegistro("detalle_invitados", ["ocultar"], "id_invitado=$id_invitado", [1]);
  }

  public function desocultarRegistro($id_invitado)
  {
    $model = new Model();
    return $model->modificaRegistro("detalle_invitados", ["ocultar"], "id_invitado=$id_invitado", [0]);
  }

  public function existeCURP($curp, $id_condomino)
  {
    $model = new Model();
    return count($model->seleccionaRegistros(
      "invitados",
      ["curp"],
      "curp='$curp' AND id_condomino=$id_condomino",
      null,
      "INNER JOIN detalle_invitados ON invitados.id_invitado = detalle_invitados.id_invitado"
    )) !== 0;
  }
}
