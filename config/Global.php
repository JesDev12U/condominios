<?php
set_include_path(
  get_include_path() .
    PATH_SEPARATOR . realpath(__DIR__ . '/..') . '/_model' .
    PATH_SEPARATOR . realpath(__DIR__ . '/..') . '/_controller' .
    PATH_SEPARATOR . realpath(__DIR__ . '/..') . '/classes'
);

define("SITE_URL", "http://localhost/condominios/");
define("RUTA_ADMINISTRADOR", "administrador/");
define("RUTA_EMPLEADO", "empleado/");
define("RUTA_CONDOMINO", "condomino/");
define("RUTA_CERRAR_SESION", "_controller/cerrarSesion.php");
define("DB_HOST", "127.0.0.1");
define("DB_BASE", "condominios");
define("DB_USR", "root");
define("DB_PASS", "Str0ngPassword!");
define("METODO_ENCRIPTACION", "AES-256-CBC");
define("KEY_ENCRIPTACION", "u7<fijrf0AKI./");
