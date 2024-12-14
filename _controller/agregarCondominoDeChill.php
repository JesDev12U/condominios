<?php
ini_set('display_errors', E_ALL); //Esta linea solo es para pruebas, no dejar en produccion

//ARCHIVO DE PRUEBAS, SE ELIMINARÁ LUEGO
require_once __DIR__ . "/../classes/MySQLAux.php";
require_once __DIR__ . "/../config/Global.php";
$nombre = "Patito";
$email = "condomino@gmail.com";
$password = "patito";
$telefono = "5555555555";
$telefono_emergencia = "4444444444";
$torre = "nose";
$departamento = "nose";
$tipo = "nose";
$foto_path = "nose";

$bd = new MySQLAux(DB_HOST, DB_BASE, DB_USR, DB_PASS);
$bd->insertRow(
  "condominos",
  [
    "nombre",
    "email",
    "password",
    "telefono",
    "telefono_emergencia",
    "torre",
    "departamento",
    "tipo",
    "foto_path"
  ],
  [
    $nombre,
    $email,
    password_hash($password, PASSWORD_DEFAULT),
    $telefono,
    $telefono_emergencia,
    $torre,
    $departamento,
    $tipo,
    $foto_path
  ]
);
