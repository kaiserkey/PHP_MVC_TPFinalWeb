<?
require_once('helpers/session.php');
require_once('models/usermodel.php');
require_once('models/agendamodel.php');
require_once('models/doctormodel.php');
require_once('models/historiaclinicamodel.php');
require_once('models/obrasocialmodel.php');
require_once('models/procedimientomodel.php');
require_once('models/turnomodel.php');
require_once('models/clinicamodel.php');

class SessionController extends Controller{
    private $userSession;
    private $username;
    private $userid;
    private $session;
    private $sites;
    private $user;
    private $agenda;
    private $doctor;
    private $obraSocial;
    private $historiaClinica;
    private $turno;
    private $clinica;
    private $procedimiento;


    public function __construct(){
        parent::__construct();

        $this->init();
    }

    /**
     * Inicializa el parser para leer el .json
     */
    private function init(){
        //se crea nueva sesión
        $this->session = new Session();
        //se carga el archivo json con la configuración de acceso
        $json = $this->getJSONFileConfig();
        // se asignan los sitios
        $this->sites = $json['sites'];
        // se asignan los sitios por default, los que cualquier rol tiene acceso
        $this->defaultSites = $json['default-sites'];
        // inicia el flujo de validación para determinar
        // el tipo de rol y permismos
        $this->validateSession();
        
    }
    
    /**
     * Abre el archivo JSON y regresa el resultado decodificado
     */
    private function getJSONFileConfig(){
        $string = file_get_contents("config/access.json");
        $json = json_decode($string, true);

        return $json;
    }

    /**
     * Implementa el flujo de autorización
     * para entrar a las páginas
     */
    public function validateSession(){
        error_log('SessionController::validateSession() entrando a la funcion' . $this->session->getSessionName());
        //Si existe la sesión
        if(count($_SESSION)>0){
            $this->session->setSessionName(array_keys($_SESSION)[0]);
        }
        if($this->existsSession()){
            error_log('SessionController::validateSession() mostrar si existe sesion '. $this->existsSession());
            error_log('SessionController::validateSession() mostrar el rol '. $this->getUserSessionData()->getRol());
            $role = $this->getUserSessionData()->getRol();
            
            error_log("sessionController::validateSession(): username:" . $this->user->getDni() . " - role: " . $this->user->getRol());
            if($this->isPublic()){
                $this->redirectDefaultSiteByRole($role);
                error_log( "SessionController::validateSession() => sitio público, redirige al main de cada rol" );
            }else{
                if($this->isAuthorized($role)){
                    error_log( "SessionController::validateSession() => autorizado, lo deja pasar" );
                    //si el usuario está en una página de acuerdo
                    // a sus permisos termina el flujo
                }else{
                    error_log( "SessionController::validateSession() => no autorizado, redirige al main de cada rol" );
                    // si el usuario no tiene permiso para estar en
                    // esa página lo redirije a la página de inicio
                    $this->redirectDefaultSiteByRole($role);
                }
            }
        }else{
            //No existe ninguna sesión
            //se valida si el acceso es público o no
            if($this->isPublic()){
                error_log('SessionController::validateSession() public page');
                //la pagina es publica
                //no pasa nada
            }else{
                //la página no es pública
                //redirect al login
                error_log('SessionController::validateSession() redirect al login');
                header('location: '. constant('URL') . '');
            }
        }
    }
    /**
     * Valida si existe sesión, 
     * si es verdadero regresa el usuario actual
     */
    public function existsSession(){
        //$this->session->setSessionName('paciente');
        if(!$this->session->exists()) return false;
        if($this->session->getCurrentUser() == NULL) return false;

        $userid = $this->session->getCurrentUser();

        if($userid) return true;

        return false;
    }

    public function getTurnosDB(){
        $turnos = [];
        $turno=new TurnoModel;
        $turnos = $turno->getAll();

        return $turnos;
    }

    public function getTurnosPendientes(){
        $turnos = [];
        $turno=new TurnoModel;
        $turnos = $turno->getIfExistTurno($this->session->getCurrentUser());
        return $turnos;
    }

    public function getTurnosAdministracion(){
        $turnos = [];
        $turno=new TurnoModel;
        $turnos = $turno->getAllPendiente();
        return $turnos;
    }

    public function getUsuarioCancelaciones(){
        $usuario = new UserModel();
        $cancelaciones = $usuario->getUsuariosRiesgosos();
        return $cancelaciones;
    }

    public function getUsuarioNombre($dni){
        $usuarios = new UserModel();
        $usuarios->getUsuarioByDNI($dni);
        return $usuarios;
    }

    public function getPaciente($dni){
        $usuario = new UserModel();
        return $usuario->getPacienteBy($dni);
    }

    public function getUsuarios($dni){
        $usuario = new UserModel();
        return $usuario->getUsers($dni);
    }

    public function getPacienteBy($dni){
        $usuario = new UserModel();
        return $usuario->get($dni);
    }

    public function getAgendaDB(){
        $agendas = [];
        $agenda = new AgendaModel();
        $agendas = $agenda->getAll();
        
        return $agendas;
    }

    public function getAgendaByMatricula($matricula){
        $agendas = [];
        $agenda = new AgendaModel();
        $agendas = $agenda->getAllByMatricula($matricula);
        
        return $agendas;
    }

    public function getClinicaByID($id){
        $clinicas = new Clinica();
        $clinica = $clinicas->get($id);
        return $clinica;
    }

    public function getClinicaIDNombre(){
        $clinicas = new Clinica();
        $clinica = $clinicas->getClinicasIDs();
        return $clinica;
    }

    public function getProcedimientoByID($matricula){
        $procedimientos = new ProcedimientoModel();
        $procedimiento = $procedimientos->get($matricula);
        return $procedimiento;
    }

    public function getDoctorDB(){
        $doctores = [];
        $doctor = new DoctorModel();
        $doctores = $doctor->getAll();

        return $doctores;
    }

    public function getDoctorByMatricula($matricula){
        $doctores = new DoctorModel();
        $doctor = $doctores->get($matricula);
        
        return $doctor;
    }

    public function getProcedimientoDB(){
        $procedimientos = [];
        $procedimiento = new ProcedimientoModel();
        $procedimientos = $procedimiento->getAll();
        
        return $procedimientos;
    }

    public function getHistoriaClinicaById(){
        $historial = [];
        $historiaClinica = new HistoriaClinicaModel();
        $historial = $historiaClinica->getAllById($this->session->getCurrentUser());
        return $historial;
    }

    public function getEspecializacionDoctor(){
        $doctores = [];
        $doctor = new DoctorModel();
        $doctores = $doctor->getAllNombreDoctorByEspecializacion();
        
        return $doctores;
    }

    public function getFechasReservadas(){
        $turnos = [];
        $turno = new TurnoModel();
        $turnos = $turno->getAllFechas();
        return $turnos;
    }

    public function getProcedimientos(){
        $procedimientos = [];
        $procedimiento = new ProcedimientoModel();
        $procedimientos = $procedimiento->getAllProcedimientosByNombre();
        
        return $procedimientos;
    }

    public function getObraSocialDB(){
        $obraSocial = [];
        $this->obraSocial = new ObraSocialModel();
        $obraSocial = $this->obraSocial->getAll();
        
        return $obraSocial;
    }

    public function getUserSessionData(){
        error_log("sessionController::getUserSessionData(): guardamos la sesion del usuario que logeo: " . $this->session->getCurrentUser());
        $dni = $this->session->getCurrentUser();
        $this->user = new UserModel();
        $this->user->get($dni);
        
        return $this->user;
    }

    public function initialize($user){
        $this->session->setSessionName($user->getRol());
        error_log("sessionController::initialize(): usuario que logeo: " . $user->getDni() . " Rol: " . $user->getRol());
        $this->session->setCurrentUser($user->getDni());
        $this->authorizeAccess($this->session->getSessionName());
        error_log("sessionController::initialize(): el rol que se seteo es: " . $this->session->getSessionName());
    }

    private function isPublic(){
        $currentURL = $this->getCurrentPage();
        error_log("sessionController::isPublic(): currentURL => " . $currentURL);
        $currentURL = preg_replace( "/\?.*/", "", $currentURL); //omitir get info
        for($i = 0; $i < sizeof($this->sites); $i++){
            if($currentURL === $this->sites[$i]['site'] && $this->sites[$i]['access'] === 'public'){
                return true;
            }
        }
        return false;
    }

    private function redirectDefaultSiteByRole($role){
        $url = '';
        for($i = 0; $i < sizeof($this->sites); $i++){
            if($this->sites[$i]['role'] === $role){
                $url = '/'.'MVC-TPFinalWebII'.'/'.$this->sites[$i]['site'];
            break;
            }
        }
        header('location: '.$url);
        
    }

    private function isAuthorized($role){
        $currentURL = $this->getCurrentPage();
        $currentURL = preg_replace( "/\?.*/", "", $currentURL); //omitir get info
        
        for($i = 0; $i < sizeof($this->sites); $i++){
            if($currentURL === $this->sites[$i]['site'] && $this->sites[$i]['role'] === $role){
                return true;
            }
        }
        return false;
    }

    private function getCurrentPage(){
        
        $actual_link = trim("$_SERVER[REQUEST_URI]");
        
        $url = explode('/', $actual_link);
        error_log("sessionController::getCurrentPage(): actualLink =>" . $actual_link . ", url => " . $url[2]);
        return $url[2];
    }

    public function authorizeAccess($role){
        error_log("sessionController::authorizeAccess(): role: $role");
        switch($role){
            case 'paciente':
                $this->redirect($this->defaultSites['paciente'], []);
            break;
            case 'administrador':
                $this->redirect($this->defaultSites['administrador'], []);
            break;
            case 'administracion':
                $this->redirect($this->defaultSites['administracion'], []);
            break;
            default:
        }
    }

    public function logout(){
        $this->session->closeSession();
    }



    public function getUser(){return $this->user;}
    public function setUser($user){$this->user = $user;return $this;}
    public function getSites(){return $this->sites;}
    public function setSites($sites){$this->sites = $sites;return $this;}
    public function getSession(){return $this->session;}
    public function setSession($session){$this->session = $session;return $this;}
    public function getUserid(){return $this->userid;}
    public function setUserid($userid){$this->userid = $userid;return $this;}
    public function getUsername(){return $this->username;}
    public function setUsername($username){$this->username = $username;return $this;}
    public function getUserSession(){return $this->userSession;}
    public function setUserSession($userSession){$this->userSession = $userSession;return $this;}
    public function getProcedimiento(){return $this->procedimiento;}
    public function setProcedimiento($procedimiento){$this->procedimiento = $procedimiento;return $this;}
    public function getClinica(){return $this->clinica;}
    public function setClinica($clinica){$this->clinica = $clinica;return $this;}
    public function getTurno(){return $this->turno;}
    public function setTurno($turno){$this->turno = $turno;return $this;}
    public function getHistoriaClinica(){return $this->historiaClinica;}
    public function setHistoriaClinica($historiaClinica){$this->historiaClinica = $historiaClinica;return $this;} 
    public function getObraSocial(){return $this->obraSocial;}
    public function setObraSocial($obraSocial){$this->obraSocial = $obraSocial;return $this;}
    public function getDoctor(){return $this->doctor;}
    public function setDoctor($doctor){$this->doctor = $doctor;return $this;}
    public function setAgenda($agenda){$this->agenda = $agenda;return $this;}
    public function getAgenda(){return $this->agenda;}
}
