<?
    class AreasLog extends SessionController{
        function __construct(){
            parent::__construct();
            error_log('Errores::construct -> Areas Asistenciales');
        }

        public function render(){
            $this->view->render('publics/areasLog', []);
        }
    }
?>