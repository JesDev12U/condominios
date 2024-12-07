<?php
require_once "_model/Model.php";
class CtrlPaginaPrincipal
{
    private $vista = "_view/principal.php";
    private $css = "css/principal.css";
    private $js = "js/principal.js";
    public $model;
    public $opciones;
    public $title = "Principal";
    public $imagenes = [];
    public $pathImagenes = "img/condominio/";

    public function __construct()
    {
        $this->model = new Model();
        $this->opciones = [
            ["nombre" => "Home", "href" => "#home", "id" => "home"],
            ["nombre" => "Eventos", "href" => "#eventos", "id" => "eventos"],
            ["nombre" => '<i class="fa-solid fa-user"></i> Iniciar sesión', "href" => $this->model->baseURL . "login", "id" => "login"]

        ];
    }

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
