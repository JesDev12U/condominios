<?php
require_once __DIR__ . "/../_model/Model.php";
require_once __DIR__ . "/../config/Global.php";

class CtrlLogin
{
  const VISTA = __DIR__ . "/../_view/login.php";
  const CSS = __DIR__ . "/../css/login.css";
  const JS = __DIR__ . "/../js/login.js";
  public $model;
  public $opciones = [
    ["nombre" => "Home", "href" => SITE_URL, "id" => "home"]
  ];
  public $title = "Inicio de sesión";

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

  /** 
   * Función que nos ayudará a comprobar las credenciales del usuario
   * @param string $email Correo electrónico del usuario
   * @param string $password Contraseña en crudo (Sin hash)
   * @return string|null Si las credenciales son correctas, devuelve un string indicando
   * el usuario, en caso contrario, regresa null
   */
  public function credencialesCorrectas($email, $password)
  {
    $model = new Model();
    $tabla = "";
    $usuario = null;
    // Buscamos tabla por tabla hasta encontrar al usuario correspondiente  
    $tabla = "condominos";
    $resultado = $model->seleccionaRegistros($tabla, ["email", "password"], "email='$email'");
    if (count($resultado) === 0) {
      $tabla = "empleados";
      $resultado = $model->seleccionaRegistros($tabla, ["email", "password"], "email='$email'");
    }
    if (count($resultado) === 0) {
      $tabla = "administrador";
      $resultado = $model->seleccionaRegistros($tabla, ["email", "password"], "email='$email'");
    }

    if (count($resultado) !== 0) {
      //Si encontro un usuario, se verifica la contraseña
      if (password_verify($password, $resultado[0]['password'])) {
        if ($tabla === "condominos") $usuario = "condomino";
        else if ($tabla === "empleados") $usuario = "empleado";
        else $usuario = "administrador";
      }
    }

    return $usuario;
  }
}
