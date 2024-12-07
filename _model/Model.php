<?php
require_once "classes/MySQLAux.php";
require __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

// Cargar las variables del archivo .env
$dotenv = Dotenv::createImmutable(__DIR__ . "/../config/");
$dotenv->load();

class Model
{
  public $baseURL = "/condominios/";

  public function seleccionaRegistros($tabla, $campos, $condicion = null, $params = null)
  {
    $bd = new MySQLAux($_ENV["DB_SERVER"], $_ENV["DB_NAME"], $_ENV["DB_USER"], $_ENV["DB_PASS"]);
    return $bd->selectRows($tabla, $campos, $condicion, $params);
  }
}
