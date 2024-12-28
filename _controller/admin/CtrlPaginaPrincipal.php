<?php
class CtrlPaginaPrincipal
{
  const VISTA = __DIR__ . "/../../_view/admin/principal.php";
  const CSS = __DIR__ . "/../../css/admin/principal.css";
  const JS = __DIR__ . "/../../js/admin/principal.js";

  public $opciones = [
    ["nombre" => "Gestor de empleados", "href" => SITE_URL . RUTA_ADMINISTRADOR . "gestor-empleados", "id" => "gestor-empleados"],
    ["nombre" => "Gestor de condominos", "href" => SITE_URL . RUTA_ADMINISTRADOR . "gestor-condominos", "id" => "gestor-condominos"],
    ["nombre" => "Cerrar sesión", "href" => SITE_URL . RUTA_CERRAR_SESION, "id" => "cerrar-sesion"]
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
