<?php
require_once "classes/MySQLAux.php";
class Model
{
  public function seleccionaRegistros($tabla, $campos, $condicion = null, $params = null)
  {
    $bd = new MySQLAux($_ENV["DB_SERVER"], $_ENV["DB_NAME"], $_ENV["DB_USER"], $_ENV["DB_PASS"]);
    return $bd->selectRows($tabla, $campos, $condicion, $params);
  }
}
