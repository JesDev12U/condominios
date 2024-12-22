<?php
if (!isset($_SESSION["loggeado"]) || $_SESSION["loggeado"] === false || $_SESSION["usuario"] !== "empleado")
  header("Location: " . SITE_URL);
?>
<div class="container-name">
  <h1>¡Bienvenido <i><?php echo $_SESSION["datos"]["nombre"] ?></i>!</h1>
  <p>¿Qué desea realizar hoy?</p>
</div>
<div class="container">
  <div class="row">
    <div class="col">
      <a href="#">
        <img src="<?php echo SITE_URL ?>img/menu_icons/escaneo_acceso.png" alt="Escaneo de acceso">
        <p>Escaneo de acceso</p>
      </a>
    </div>
    <div class="col">
      <a href="#">
        <img src="<?php echo SITE_URL ?>img/menu_icons/reservar_eventos.png" alt="Registro de visitas">
        <p>Registro de visitas</p>
      </a>
    </div>
  </div>
</div>