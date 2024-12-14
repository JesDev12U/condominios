<?php
//ARCHIVO DE PRUEBAS, SE ELIMINARÁ LUEGO
require_once "../classes/MySQLAux.php";
$nombre = "Patito";
$email = "condomino@gmail.com";
$password = "patito";
$telefono = "5555555555";
$telefono_emergencia = "4444444444";
$torre = "nose";
$departamento = "nose";
$tipo = "nose";
$foto_path = "nose";

$bd = new MySQLAux("127.0.0.1", "condominios", "root", "Str0ngPassword!");
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
