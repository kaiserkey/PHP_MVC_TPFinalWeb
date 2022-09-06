<?
    class Obrassociales extends Controller{
        function __construct(){
            parent::__construct();
            error_log('Errores::construct -> Obras Sociales');
        }

        public function render(){
            $this->view->render('publics/obrassociales', []);
        }
    }
?>