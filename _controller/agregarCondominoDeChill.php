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
    "habilitado"
  ],
  [
    $nombre,
    $email,
    password_hash($password, PASSWORD_DEFAULT),
    true
  ]
);

// $nombre = "Patito";
// $email = "condomino@gmail.com";
// $password = "patito";
// $telefono = "5555555555";
// $telefono_emergencia = "4444444444";
// $torre = "nose";
// $departamento = "nose";
// $tipo = "nose";
// $foto_path = "nose";
// $bd = new MySQLAux("127.0.0.1", "condominios", "root", "Str0ngPassword!");
// $bd->insertRow(
//   "condominos",
//   [
//     "nombre",
//     "email",
//     "password",
//     "telefono",
//     "telefono_emergencia",
//     "torre",
//     "departamento",
//     "tipo",
//     "foto_path",
//     "habilitado"
//   ],
//   [
//     $nombre,
//     $email,
//     password_hash($password, PASSWORD_DEFAULT),
//     $telefono,
//     $telefono_emergencia,
//     $torre,
//     $departamento,
//     $tipo,
//     $foto_path,
//     true
//   ]
// );

// $nombre = "Patito";
// $email = "empleado@gmail.com";
// $password = "patito";
// $telefono = "5555555555";
// $telefono_emergencia = "4444444444";
// $foto_path = "nose";
// $bd = new MySQLAux("127.0.0.1", "condominios", "root", "Str0ngPassword!");
// $bd->insertRow(
//   "empleados",
//   [
//     "nombre",
//     "email",
//     "password",
//     "telefono",
//     "telefono_emergencia",
//     "foto_path",
//     "habilitado"
//   ],
//   [
//     $nombre,
//     $email,
//     password_hash($password, PASSWORD_DEFAULT),
//     $telefono,
//     $telefono_emergencia,
//     $foto_path,
//     true
//   ]
// );
