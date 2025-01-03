<?php
if (!isset($_SESSION["loggeado"]) || $_SESSION["loggeado"] === false || $_SESSION["usuario"] !== "administrador")
  header("Location: " . SITE_URL);
?>
<div class="container-name">
  <h1>¡Bienvenido <i><?php echo $_SESSION["datos"]["nombre"] ?></i>!</h1>
  <p>¿Qué desea realizar hoy?</p>
</div>
<div class="container" id="menu">
  <div class="row">
    <div class="col">
      <a href="<?php echo SITE_URL . RUTA_ADMINISTRADOR ?>gestor-empleados">
        <img src="<?php echo SITE_URL ?>img/menu_icons/gestor_empleados.png" alt="Gestor de empleados">
        <p>Gestor de empleados</p>
      </a>
    </div>
    <div class="col">
      <a href="<?php echo SITE_URL . RUTA_ADMINISTRADOR ?>gestor-condominos">
        <img src="<?php echo SITE_URL ?>img/menu_icons/gestor_condominos.png" alt="Gestor de condominos">
        <p>Gestor de condominos</p>
      </a>
    </div>
    <div class="col">
      <a href="#">
        <img src="<?php echo SITE_URL ?>img/menu_icons/gestor_reservaciones.png" alt="Gestor de reservaciones">
        <p>Gestor de reservaciones</p>
      </a>
    </div>
    <div class="col">
      <a href="#">
        <img src="<?php echo SITE_URL ?>img/menu_icons/reportes.png" alt="Reporte de visitas">
        <p>Reporte de visitas</p>
      </a>
    </div>
    <div class="col">
      <a href="#">
        <img src="<?php echo SITE_URL ?>img/menu_icons/reportes.png" alt="Reporte de reservaciones">
        <p>Reporte de reservaciones</p>
      </a>
    </div>
    <div class="col">
      <a href="<?php echo SITE_URL . RUTA_ADMINISTRADOR ?>configuracion">
        <img src="<?php echo SITE_URL ?>img/menu_icons/configuracion.png" alt="Modificar datos de la cuenta">
        <p>Modificar datos de la cuenta</p>
      </a>
    </div>
  </div>
</div>