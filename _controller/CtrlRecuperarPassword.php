<?php
require_once __DIR__ . "/../_model/Model.php";
require_once __DIR__ . "/../config/Global.php";
require_once __DIR__ . '/../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class CtrlRecuperarPassword
{
  const VISTA = __DIR__ . "/../_view/recuperar_password.php";
  const CSS = __DIR__ . "/../css/recuperar_password.css";
  const JS = __DIR__ . "/../js/recuperar_password.js";

  public $opciones = [
    ["nombre" => ICON_HOME, "href" => SITE_URL, "id" => "home"]
  ];

  public $title = "Recuperar contraseña";

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

  public function enviarCodigo($email)
  {
    $numeroAleatorio = rand(10000, 99999);
    $mail = new PHPMailer(true);
    try {
      $mail->isSMTP();
      $mail->Host = 'smtp.gmail.com';
      $mail->SMTPAuth = true;
      $mail->Username = EMAIL;
      $mail->Password = PASSWORD_EMAIL;
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
      $mail->Port = 465;

      // Configuración del correo
      $mail->setFrom(EMAIL, 'Condominios');
      $mail->addAddress($email);
      $mail->Subject = 'Código para cambiar contraseña en el sistema Condominios';
      $mail->CharSet = 'UTF-8';
      $mail->isHTML(true);
      $mail->Body = "
        <html>
        <head>
          <style>
            .container {
              font-family: Arial, sans-serif;
              padding: 20px;
              border: 1px solid #ddd;
              border-radius: 5px;
              background-color: #f9f9f9;
            }
            .header {
              font-size: 24px;
              font-weight: bold;
              margin-bottom: 20px;
            }
            .content {
              font-size: 16px;
              margin-bottom: 20px;
            }
            .footer {
              font-size: 12px;
              color: #777;
            }
          </style>
        </head>
        <body>
          <div class='container'>
            <div class='header'>Código para cambiar contraseña</div>
            <div class='content'>
              Ingresa este código en el sistema: <strong>$numeroAleatorio</strong>
            </div>
            <div class='footer'>
              Si no solicitaste este código, por favor ignora este correo.
            </div>
          </div>
        </body>
        </html>
      ";
      $mail->send();
    } catch (Exception $e) {
      echo "No se pudo enviar el correo. Error: {$mail->ErrorInfo}";
      return null;
    }
    return $numeroAleatorio;
  }

  public function cambiarPassword($email, $newPassword)
  {
    $model = new Model();
    $tabla = "";
    // Buscamos tabla por tabla hasta encontrar al usuario correspondiente  
    $tabla = "condominos";
    $resultado = $model->seleccionaRegistros($tabla, ["email"], "email='$email'");
    if (count($resultado) === 0) {
      $tabla = "empleados";
      $resultado = $model->seleccionaRegistros($tabla, ["email"], "email='$email'");
    }
    if (count($resultado) === 0) {
      $tabla = "administrador";
      $resultado = $model->seleccionaRegistros($tabla, ["email"], "email='$email'");
    }

    if (count($resultado) !== 0) {
      //Si encontro un usuario, se cambia la contraseña
      return $model->modificaRegistro($tabla, ['password'], "email='$email'", [password_hash($newPassword, PASSWORD_DEFAULT)]);
    }
    return false;
  }
}
