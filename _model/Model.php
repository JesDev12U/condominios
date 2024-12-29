<?php
require_once __DIR__ . "/../classes/MySQLAux.php";
class Model
{
  public function seleccionaRegistros($tabla, $campos, $condicion = null, $params = null, $joins = null)
  {
    $bd = new MySQLAux(DB_HOST, DB_BASE, DB_USR, DB_PASS);
    return $bd->selectRows($tabla, $campos, $condicion, $params, $joins);
  }

  public function agregaRegistro($tabla, $campos, $params)
  {
    $bd = new MySQLAux(DB_HOST, DB_BASE, DB_USR, DB_PASS);
    return $bd->insertRow($tabla, $campos, $params) > 0;
  }

  public function agregaRegistroID($tabla, $campos, $params)
  {
    $bd = new MySQLAux(DB_HOST, DB_BASE, DB_USR, DB_PASS);
    return $bd->insertRow($tabla, $campos, $params);
  }

  public function modificaRegistro($tabla, $campos, $condicion, $params)
  {
    $bd = new MySQLAux(DB_HOST, DB_BASE, DB_USR, DB_PASS);
    return $bd->updateRow($tabla, $campos, $condicion, $params) > 0;
  }

  public function eliminaRegistro($tabla, $condicion, $params = null)
  {
    $bd = new MySQLAux(DB_HOST, DB_BASE, DB_USR, DB_PASS);
    return $bd->deleteRow($tabla, $condicion, $params);
  }
}
