<?

    class Dashboard extends SessionController{
        private $user;
        private $turnos;
        private $historial;
        private $doctor;

        public function __construct()
        {
            error_log('Dashboard::construct -> Inicio del Dashboard');
            #para que herede de controller la clase loadmodel
            parent::__construct();
            $this->setUser($this->getUserSessionData());
            $this->setTurnos($this->getTurnosPendientes());
            $this->setHistorial($this->getHistoriaClinicaById());
            $this->setDoctor($this->getDoctorDB());
        }

        public function render(){
            $this->view->render('dashboard/index', ['userPaciente'=> $this->getUser(), 'turnosDB'=>$this->getTurnos(),
                                                    'historialDB'=>$this->getHistorial(), 'doctorBD'=>$this->getDoctor()]);
            error_log('Dashboard::render -> Carga el index del Dashboard');
        }

        public function salir(){
            $salir = new Session();
            $salir->closeSession();
            $this->redirect('');
        }

        public function getUser(){return $this->user;}
        public function setUser($user){$this->user = $user;return $this;}
        public function getTurnos(){return $this->turnos;}
        public function setTurnos($turnos){$this->turnos = $turnos;return $this;}
        public function getHistorial(){return $this->historial;}
        public function setHistorial($historial){$this->historial = $historial;return $this;}
        public function getDoctor(){return $this->doctor;}
        public function setDoctor($doctor){$this->doctor = $doctor;return $this;}
    }

?>