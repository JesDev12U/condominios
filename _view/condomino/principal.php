<?php
if (!isset($_SESSION["loggeado"]) || $_SESSION["loggeado"] === false || $_SESSION["usuario"] !== "condomino")
  header("Location: " . SITE_URL);
?>
<div class="container-name">
  <h1>¡Bienvenido <i><?php echo $_SESSION["datos"]["nombre"] ?></i>!</h1>
  <p>¿Qué desea realizar hoy?</p>
</div>
<div class="container" id="menu">
  <div class="row">
    <div class="col">
      <a href="#">
        <img src="<?php echo SITE_URL ?>img/menu_icons/reservar_eventos.png" alt="Reservar eventos">
        <p>Reservar eventos</p>
      </a>
    </div>
    <div class="col">
      <a href="#">
        <img src="<?php echo SITE_URL ?>img/menu_icons/invitados.png" alt="Invitados">
        <p>Invitados</p>
      </a>
    </div>
  </div>
</div>