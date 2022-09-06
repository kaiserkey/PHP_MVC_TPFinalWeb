<?
class BuscarPacientes extends SessionController{

    public function __construct(){
        error_log('BuscarPacientes::construct -> Inicio de BuscarPacientes');
        parent::__construct();
    }

    public function render($pacientes=''){
        $this->view->render('administracion/buscarPacientes', ['paciente'=>$pacientes]);
        error_log('BuscarPacientes::render -> Carga el index de BuscarPacientes');
    }

    public function buscar(){
        
        if($this->existPOST('buscar') && $this->getPost('buscar') != '' && $this->getPost('buscar') != null){
            $paciente = new UserModel();
            $paciente = ($this->getPaciente($this->getPost('buscar')));
            
            if(!empty($paciente)){
                $this->render($paciente);
            }else{
                $this->redirect('buscarPacientes', ['error'=>ErrorMessage::ERROR_EXIST_PACIENTE]);
            }
        }else{
            $pacientes = new UserModel();
            $pacientesBD=$pacientes->getAll();
            if(!empty($pacientesBD)){
                $this->render($pacientesBD);
            }else{
                $this->redirect('buscarPacientes', ['error'=>ErrorMessage::ERROR_EXIST_PACIENTE]);
            }
        }
    }

}
?>