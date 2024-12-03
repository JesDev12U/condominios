
<?php
require_once "_model/Model.php";
class CtrlPaginaPrincipal{
    private $vista = "_view/principal.html";

    public function renderContent(){
        include $this ->vista;
    }
}