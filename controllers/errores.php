<?php
class Errores extends Controller{

    function __construct(){
        parent::__construct();
        error_log('Errores::construct -> Inicio de Errores');
        $this->view->render('errores/index');
    }

}

?>