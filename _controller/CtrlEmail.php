<?php
require_once __DIR__ . "/../_model/Model.php";
class CtrlEmail
{
  public $email;

  public function __construct($email)
  {
    $this->email = $email;
  }

  public function existeEmail()
  {
    $model = new Model();
    return $model->seleccionaRegistros("administrador", ["email"], "email='$this->email'")
      || $model->seleccionaRegistros("empleados", ["email"], "email='$this->email'")
      || $model->seleccionaRegistros("condominos", ["email"], "email='$this->email'");
  }
}
