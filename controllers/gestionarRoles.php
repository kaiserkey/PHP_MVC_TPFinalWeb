<?
class GestionarRoles extends SessionController{
        private $user;

        public function __construct()
        {
            #para que herede de controller la clase loadmodel
            parent::__construct();
            error_log('GestionarRoles::construct -> Inicio del GestionarRoles');

        }

        public function render($pacientes=''){
            $this->view->render('administrador/gestionarRoles', ['paciente'=>$pacientes]);
            error_log('GestionarRoles::render -> Carga el index de GestionarRoles');
        }

        public function buscar(){
        
            if($this->existPOST('buscar') && $this->getPost('buscar') != '' && $this->getPost('buscar') != null){
                $paciente = new UserModel();
                $paciente = ($this->getUsuarios($this->getPost('buscar')));
                
                if(!empty($paciente)){
                    $this->render($paciente);
                }else{
                    $this->redirect('gestionarRoles', ['error'=>ErrorMessage::ERROR_EXIST_PACIENTE]);
                }
            }else{
                $pacientes = new UserModel();
                $pacientesBD=$pacientes->getAllUsers();
                if(!empty($pacientesBD)){
                    $this->render($pacientesBD);
                }else{
                    $this->redirect('gestionarRoles', ['error'=>ErrorMessage::ERROR_EXIST_PACIENTE]);
                }
            }
        }

        public function cambiarRol(){
            
            if($this->existPOST(['rol', 'dni'])){
                if($this->getPost('rol')==null || $this->getPost('rol')=='' || $this->getPost('dni')==null || $this->getPost('dni')==''){
                    $this->redirect('gestionarRoles', ['error'=>ErrorMessage::ERROR_UPDATE_ROL_VERIFY]);
                }else{
                    $usuario = new UserModel();
                    $usuario->get($this->getPost('dni'));
                    $usuario->setRol($this->getPost('rol'));
                    if($usuario->update()){
                        $this->redirect('gestionarRoles', ['success'=>SuccessMessage::SUCCESS_UPDATE_ROL]);
                    }else{
                        $this->redirect('gestionarRoles', ['error'=>ErrorMessage::ERROR_UPDATE_ROL]);
                    }
                }
            }else{
                $this->redirect('gestionarRoles', ['error'=>ErrorMessage::ERROR_NEW_INPUT_FUNCTION]);
            }
        }

        public function getUser(){return $this->user;}
        public function setUser($user){$this->user = $user;return $this;}

    }

?>