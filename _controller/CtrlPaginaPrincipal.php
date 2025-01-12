<?php
class CtrlPaginaPrincipal
{
    private $vista = __DIR__ . "/../_view/principal.php";
    private $css = __DIR__ . "/../css/principal.css";
    private $js = __DIR__ . "/../js/principal.js";
    public $model;
    public $opciones = [
        ["nombre" => ICON_HOME, "href" => "#home", "id" => "home"],
        ["nombre" => ICON_EVENTOS, "href" => "#eventos", "id" => "eventos"],
        ["nombre" => ICON_INICIAR_SESION, "href" => SITE_URL . "login", "id" => "login"]

    ];
    public $title = "Principal";
    public $imagenes = [];
    public $pathImagenes = "img/condominio/";

    public function cargarImagenesSlider()
    {
        foreach (new DirectoryIterator($this->pathImagenes) as $archivo) {
            if ($archivo->isDot()) continue; // Ignorar "." y ".."
            $this->imagenes[] = $archivo->getFilename();
        }
    }

    public function renderContent()
    {
        $this->cargarImagenesSlider();
        include $this->vista;
    }

    public function renderCSS()
    {
        include $this->css;
    }

    public function renderJS()
    {
        include $this->js;
    }
}
