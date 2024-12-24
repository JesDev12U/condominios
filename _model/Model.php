<?php
require_once __DIR__ . "/../classes/MySQLAux.php";
class Model
{
  public function seleccionaRegistros($tabla, $campos, $condicion = null, $params = null)
  {
    $bd = new MySQLAux(DB_HOST, DB_BASE, DB_USR, DB_PASS);
    return $bd->selectRows($tabla, $campos, $condicion, $params);
  }

  public function agregaRegistro($tabla, $campos, $params)
  {
    $bd = new MySQLAux(DB_HOST, DB_BASE, DB_USR, DB_PASS);
    return $bd->insertRow($tabla, $campos, $params) > 0;
  }
}
