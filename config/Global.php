<?php
ini_set('display_errors', '0');
set_include_path(
  get_include_path() .
    PATH_SEPARATOR . realpath(__DIR__ . '/..') . '/_model' .
    PATH_SEPARATOR . realpath(__DIR__ . '/..') . '/_controller' .
    PATH_SEPARATOR . realpath(__DIR__ . '/..') . '/classes'
);

$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$domainName = $_SERVER['HTTP_HOST'];
define("SITE_URL", getenv("SITE_URL") ?: $protocol . $domainName . "/");
define("RUTA_ADMINISTRADOR", "administrador/");
define("RUTA_EMPLEADO", "empleado/");
define("RUTA_CONDOMINO", "condomino/");
define("RUTA_CERRAR_SESION", "_controller/cerrarSesion.php");
define("DB_HOST", getenv("DB_HOST") ?: "localhost");
define("DB_BASE", getenv("DB_BASE") ?: "condominios");
define("DB_USR", getenv("DB_USR") ?: "root");
define("DB_PASS", getenv("DB_PASS") ?: "");
define("TIMEZONE", "America/Mexico_City");
define("METODO_ENCRIPTACION", "AES-256-CBC");
define("KEY_ENCRIPTACION", getenv("ENCRYPTION_KEY") ?: "");
define("EMAIL", getenv("EMAIL_USR") ?: "");
define("PASSWORD_EMAIL", getenv("EMAIL_PASS") ?: "");
define("ICON_CERRAR_SESION", '<i class="fa-solid fa-right-from-bracket"></i> Cerrar sesión');
define("ICON_CONDOMINOS", '<i class="fa-solid fa-user"></i> Condóminos');
define("ICON_CUENTA", '<i class="fa-solid fa-gear"></i> Cuenta');
define("ICON_EMPLEADOS", '<i class="fa-solid fa-user-tie"></i> Empleados');
define("ICON_ESCANEO_QR", '<i class="fa-solid fa-qrcode"></i> Acceso');
define("ICON_EVENTOS", '<i class="fa-solid fa-calendar-days"></i> Eventos');
define("ICON_HOME", '<i class="fa-solid fa-house"></i> Home');
define("ICON_INICIAR_SESION", '<i class="fa-solid fa-user"></i> Iniciar sesión');
define("ICON_INVITADOS", '<i class="fa-solid fa-users"></i> Invitados');
define("ICON_RESERVACIONES", '<i class="fa-solid fa-calendar-days"></i> Reservaciones');
define("ICON_VISITAS", '<i class="fa-solid fa-users"></i> Visitas');
define("ICON_DETALLES_ESTABLECIMIENTO", '<i class="fa-solid fa-building"></i> Detalles del establecimiento');
