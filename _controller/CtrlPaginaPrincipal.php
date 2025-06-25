<?php
require_once __DIR__ . "/../_model/Model.php";
class CtrlPaginaPrincipal
{
    private $vista = __DIR__ . "/../_view/principal.php";
    private $css = __DIR__ . "/../css/principal.css";
    private $js = __DIR__ . "/../js/principal.js";
    public $model;
    public $proximosEventos;
    public $anterioresEventos;
    public $opciones = [
        ["nombre" => ICON_HOME, "href" => "#carouselExampleCaptions", "id" => "home"],
        ["nombre" => ICON_DETALLES_ESTABLECIMIENTO, "href" => "#detalles-establecimiento", "id" => "link-detalles-establecimiento"],
        ["nombre" => ICON_EVENTOS, "href" => "#eventos", "id" => "link-eventos"],
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
        $this->obtenerProximosEventos();
        $this->obtenerEventosAnteriores();
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

    public function obtenerProximosEventos()
    {
        $model = new Model();
        $this->proximosEventos = $model->seleccionaRegistros(
            "eventos",
            [
                "fecha",
                "turno",
                "detalles_evento",
                "tipo_evento",
                "foto_path"
            ],
            "fecha >= CURDATE() AND cancelado = false"
        );
    }

    public function obtenerEventosAnteriores()
    {
        $model = new Model();
        $this->anterioresEventos = $model->seleccionaRegistros(
            "eventos",
            [
                "fecha",
                "turno",
                "detalles_evento",
                "tipo_evento",
                "foto_path"
            ],
            "fecha < CURDATE() AND cancelado = false"
        );
    }
}
