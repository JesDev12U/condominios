<?php
if (!isset($_SESSION["loggeado"]) || $_SESSION["loggeado"] === false)
  header("Location: " . SITE_URL);
?>
<h1>Pagina principal del condomino</h1>