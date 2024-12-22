<?php
class CtrlPaginaPrincipal
{
  const VISTA = __DIR__ . "/../../_view/admin/principal.php";
  const CSS = __DIR__ . "/../../css/admin/principal.css";
  const JS = __DIR__ . "/../../js/admin/principal.js";

  public $opciones = [
    ["nombre" => "Home", "href" => SITE_URL . "administrador", "id" => "home"],
    ["nombre" => "Cerrar sesión", "href" => SITE_URL . "_controller/cerrarSesion.php", "id" => "cerrar-sesion"]
  ];
  public $title = "Administrador";

  public function renderContent()
  {
    include self::VISTA;
  }

  public function renderCSS()
  {
    include self::CSS;
  }

  public function renderJS()
  {
    include self::JS;
  }
}
