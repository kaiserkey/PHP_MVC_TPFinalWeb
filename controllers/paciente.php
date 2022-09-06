<?

    class Paciente extends SessionController{
        private $user;
        private $obraSocial;

        public function __construct()
        {
            #para que herede de controller la clase loadmodel
            parent::__construct();
            error_log('Paciente::construct -> Inicio del Paciente');
            $this->setUser($this->getUserSessionData());
            $this->setObraSocial($this->getObraSocialDB());

        }

        #
        public function render(){
            $this->view->render('dashboard/paciente', ['userPaciente'=> $this->getUser(), 'obraSocialDB'=>$this->getObraSocial()]);
            error_log('Paciente::render -> Carga el index del Paciente');
        }

        public function actualizarDatos(){
            if($this->existPOST(['newP1', 'newP2', 'newP3'])){
                $usuario = $this->getUser();
                $passActual = $this->getPost('newP1');
                $newPass2= $this->getPost('newP2');
                $newPass3= $this->getPost('newP3');
                if(password_verify($passActual, $usuario->getPassword())){
                    if($newPass2===$newPass3){
                        $usuario->setPassword($newPass2);
                        if($usuario->updatePass()){
                            $this->redirect('paciente', ['success'=>SuccessMessage::SUCCESS_UPDATE_PASS]);
                        }else{
                            $this->redirect('paciente', ['error'=>ErrorMessage::ERROR_UPDATE_PASS]);
                        }
                    }else{
                        $this->redirect('paciente', ['error'=>ErrorMessage::ERROR_UPDATE_USER_PASS]);
                    }
                }else{
                    $this->redirect('paciente', ['error'=>ErrorMessage::ERROR_UPDATE_USER_PASS_VERIFY]);
                }
            }

            if($this->existPOST(['direccion'])){
                if($this->getPost('direccion') == null || $this->getPost('direccion') == ''){
                    $this->redirect('paciente', ['error'=>ErrorMessage::ERROR_NEW_INPUT_FUNCTION]);
                }else{
                    $usuario = $this->getUser();
                    $usuario->setDireccion($this->getPost('direccion'));
                    if($usuario->update()){
                        $this->redirect('paciente', ['success'=>SuccessMessage::SUCCESS_UPDATE_DIR]);
                    }else{
                        $this->redirect('paciente', ['error'=>ErrorMessage::ERROR_UPDATE_DIR]);
                    }
                }
            }

            if($this->existPOST(['celular'])){
                if($this->getPost('celular') == null || $this->getPost('celular') == ''){
                    $this->redirect('paciente', ['error'=>ErrorMessage::ERROR_NEW_INPUT_FUNCTION]);
                }else{
                    $usuario = $this->getUser();
                    $usuario->setCelular($this->getPost('celular'));
                    if($usuario->update()){
                        $this->redirect('paciente', ['success'=>SuccessMessage::SUCCESS_UPDATE_CEL]);
                    }else{
                        $this->redirect('paciente', ['error'=>ErrorMessage::ERROR_UPDATE_CEL]);
                    }
                }
                
            }

            if($this->existPOST(['email'])){
                if($this->getPost('email') == null || $this->getPost('email') == ''){
                    $this->redirect('paciente', ['error'=>ErrorMessage::ERROR_NEW_INPUT_FUNCTION]);
                }else{
                    $usuario = $this->getUser();
                    $usuario->setEmail($this->getPost('email'));
                    if($usuario->update()){
                        $this->redirect('paciente', ['success'=>SuccessMessage::SUCCESS_UPDATE_EMAIL]);
                    }else{
                        $this->redirect('paciente', ['error'=>ErrorMessage::ERROR_UPDATE_EMAIL]);
                    }
                }
            }

            if($this->existPOST(['gruposanguineo'])){
                if($this->getPost('gruposanguineo') == null || $this->getPost('gruposanguineo') == ''){
                    $this->redirect('paciente', ['error'=>ErrorMessage::ERROR_NEW_INPUT_FUNCTION]);
                }else{
                    
                }
                $usuario = $this->getUser();
                $usuario->setGrupoSanguineo($this->getPost('gruposanguineo'));
                if($usuario->update()){
                    $this->redirect('paciente', ['success'=>SuccessMessage::SUCCESS_UPDATE_GS]);
                }else{
                    $this->redirect('paciente', ['error'=>ErrorMessage::ERROR_UPDATE_GS]);
                }
            }

            if($this->existPOST(['sexo'])){
                if($this->getPost('sexo') == null || $this->getPost('sexo') == ''){
                    $this->redirect('paciente', ['error'=>ErrorMessage::ERROR_NEW_INPUT_FUNCTION]);
                }else{
                    
                }
                $usuario = $this->getUser();
                $usuario->setSexo($this->getPost('sexo'));
                if($usuario->update()){
                    $this->redirect('paciente', ['success'=>SuccessMessage::SUCCESS_UPDATE_SEXO]);
                }else{
                    $this->redirect('paciente', ['error'=>ErrorMessage::ERROR_UPDATE_SEXO]);
                }
            }

            if($this->existPOST(['fecha'])){
                if($this->getPost('fecha') == null || $this->getPost('fecha') == ''){
                    $this->redirect('paciente', ['error'=>ErrorMessage::ERROR_NEW_INPUT_FUNCTION]);
                }else{
                    
                }
                $usuario = $this->getUser();
                $usuario->setFechaNac($this->getPost('fecha'));
                if($usuario->update()){
                    $this->redirect('paciente', ['success'=>SuccessMessage::SUCCESS_UPDATE_FECHA]);
                }else{
                    $this->redirect('paciente', ['error'=>ErrorMessage::ERROR_UPDATE_FECHA]);
                }
            }

            if($this->existPOST(['obrasocial'])){
                if($this->getPost('obrasocial') == null || $this->getPost('obrasocial') == ''){
                    $this->redirect('paciente', ['error'=>ErrorMessage::ERROR_NEW_INPUT_FUNCTION]);
                }else{
                    
                }
                $usuario = $this->getUser();
                $usuario->setObraSocial($this->getPost('obrasocial'));
                if($usuario->update()){
                    $this->redirect('paciente', ['success'=>SuccessMessage::SUCCESS_UPDATE_OS]);
                }else{
                    $this->redirect('paciente', ['error'=>ErrorMessage::ERROR_UPDATE_OS]);
                }
            }
        }

        
        public function getUser(){return $this->user;}
        public function setUser($user){$this->user = $user;return $this;}
        public function getObraSocial(){return $this->obraSocial;}
        public function setObraSocial($obraSocial){$this->obraSocial = $obraSocial;return $this;}
    }

?>