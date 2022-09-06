<?
require_once('models/usermodel.php');
class Signup extends SessionController{
    public function __construct(){
        error_log('Signup::construct -> Inicio del Signup');
        parent::__construct();
    }

    public function render(){
        $this->view->render('login/signup', []);
        error_log('Signup::render -> Inicio de la vista Signup');
    }

    public function newUser(){
        if($this->existPOST(['dni', 'password', 'direccion', 'celular', 'sexo', 'email', 'nombre', 'apellido', 'fecha_nacimiento'])){
            $dni = $this->getPOST('dni');
            $password = $this->getPOST('password');
            $nombre = $this->getPOST('nombre');
            $apellido = $this->getPOST('apellido');
            $direccion = $this->getPOST('direccion');
            $celular = $this->getPOST('celular');
            $sexo = $this->getPOST('sexo');
            $email = $this->getPOST('email');
            $fecha_nacimiento = $this->getPOST('fecha_nacimiento');

            if($dni == '' || empty($dni) || 
            $password == '' || empty($password) ||
            $nombre == '' || empty($nombre) ||
            $apellido == '' || empty($apellido) ||
            $sexo == '' || empty($sexo) ||
            $direccion == '' || empty($direccion) ||
            $celular == '' || empty($celular) ||
            $email == '' || empty($email) ||
            $fecha_nacimiento =='' || empty($fecha_nacimiento))
            {
                $this->redirect('signup', ['error'=>ErrorMessage::ERROR_SIGNUP_NEWUSER_EMPTY]);
            }

            $user = new UserModel();
            $user->setDni($dni);
            $user->setPassword($password);
            $user->setRol('Paciente');
            $user->setNombre($nombre);
            $user->setApellido($apellido);
            $user->setCelular($celular);
            $user->setDireccion($direccion);
            $user->setEmail($email);
            $user->setSexo($sexo);
            $user->setFechaNac($fecha_nacimiento);

            if($user->exist($dni)){
                $this->redirect('signup', ['error'=>ErrorMessage::ERROR_SIGNUP_NEWUSER_EXISTS]);
            }else if($user->sabe()){
                $this->redirect('', ['success'=>SuccessMessage::SUCCESS_SIGNUP_NEWUSER]);
            }else{
                $this->redirect('signup', ['error'=>ErrorMessage::ERROR_SIGNUP_NEWUSER]);
            }
        }else{
            $this->redirect('signup', ['error'=>ErrorMessage::ERROR_SIGNUP_NEWUSER]);
        }
    }
}
?>