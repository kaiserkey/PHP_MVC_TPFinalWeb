<?
    class Areas extends Controller{
        function __construct(){
            parent::__construct();
            error_log('Errores::construct -> Areas Asistenciales');
        }

        public function render(){
            $this->view->render('publics/areas', []);
        }
    }
?>