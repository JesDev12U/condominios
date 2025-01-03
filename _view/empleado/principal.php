<?php
if (!isset($_SESSION["loggeado"]) || $_SESSION["loggeado"] === false || $_SESSION["usuario"] !== "empleado")
  header("Location: " . SITE_URL);
?>
<div class="container-name">
  <h1>¡Bienvenido <i><?php echo $_SESSION["datos"]["nombre"] ?></i>!</h1>
  <p>¿Qué desea realizar hoy?</p>
</div>
<div class="container" id="menu">
  <div class="row">
    <div class="col">
      <a href="<?php echo SITE_URL . RUTA_EMPLEADO ?>escaneo-acceso">
        <img src="<?php echo SITE_URL ?>img/menu_icons/escaneo_acceso.png" alt="Escaneo de acceso">
        <p>Escaneo de acceso</p>
      </a>
    </div>
    <div class="col">
      <a href="<?php echo SITE_URL . RUTA_EMPLEADO ?>visitas">
        <img src="<?php echo SITE_URL ?>img/menu_icons/reservar_eventos.png" alt="Registro de visitas">
        <p>Visitas</p>
      </a>
    </div>
    <div class="col">
      <a href="<?php echo SITE_URL . RUTA_EMPLEADO ?>configuracion">
        <img src="<?php echo SITE_URL ?>img/menu_icons/configuracion.png" alt="Modificar datos de la cuenta">
        <p>Modificar datos de la cuenta</p>
      </a>
    </div>
  </div>
</div>