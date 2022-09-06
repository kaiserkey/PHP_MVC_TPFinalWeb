<?
    class InicioLog extends SessionController{
        function __construct(){
            parent::__construct();
            error_log('Errores::construct -> Inicio');
        }

        public function render(){
            $this->view->render('publics/inicioLog', []);
        }
    }
?>