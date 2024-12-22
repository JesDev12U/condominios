<?php
ini_set('display_errors', E_ALL); //Esta linea solo es para pruebas, no dejar en produccion

//ARCHIVO DE PRUEBAS, SE ELIMINARÁ LUEGO
require_once __DIR__ . "/../classes/MySQLAux.php";
require_once __DIR__ . "/../config/Global.php";
$nombre = "Patito";
$email = "admin@admin.com";
$password = "patito";

$bd = new MySQLAux(DB_HOST, DB_BASE, DB_USR, DB_PASS);
$bd->insertRow(
  "administrador",
  [
    "nombre",
    "email",
    "password",
  ],
  [
    $nombre,
    $email,
    password_hash($password, PASSWORD_DEFAULT)
  ]
);
