<?

    class Login extends SessionController{
        public function __construct()
        {
            #para que herede de controller la clase loadmodel
            parent::__construct();
            error_log('Login::construct -> Inicio del login');
        }
        #
        public function render(){
            $this->view->render('login\index');
            error_log('Login::render -> Carga el index del login');
        }

        #validamos el login
        public function authenticate(){
            if($this->existPOST(['dni', 'password'])){
                $dni = $this->getPost('dni');
                $password = $this->getPost('password');

                if($dni == '' || empty($dni) || $password == '' || empty($password)){
                    error_log('Login::authenticate() empty');
                    $this->redirect('', ['error' => ErrorMessage::ERROR_LOGIN_AUTHENTICATE_EMPTY]);
                    return;
                }

                // si el login es exitoso regresa solo el ID del usuario
                $user = $this->model->login($dni, $password);
                

                if($user != NULL){
                    // inicializa el proceso de las sesiones
                    error_log('Login::authenticate() passed: ' . $user->getDni());    
                    $this->initialize($user);
                }else{
                    //error al entrar, que intente de nuevo
                    error_log('Login::authenticate() username and/or password wrong');
                    $this->redirect('', ['error' => ErrorMessage::ERROR_LOGIN_AUTHENTICATE_DATA]);
                    return;
                }
            }else{
                // error, cargar vista con errores
                error_log('Login::authenticate() error with params');
                $this->redirect('', ['error' => ErrorMessage::ERROR_LOGIN_AUTHENTICATE]);
            }

        }
    }
?>