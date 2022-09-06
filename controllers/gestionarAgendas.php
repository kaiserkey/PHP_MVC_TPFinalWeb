<?
class GestionarAgendas extends SessionController{
    private $clinica;
    
    public function __construct()
    {
        parent::__construct();
        $this->setClinica($this->getClinicaIDNombre());
    }

    public function render(){
        $this->view->render('administrador/index', ['clinicasIDNombre'=>$this->getClinica()]);
        error_log('GestionarAgendas::render -> Carga el index de GestionarAgendas');
    }

    public function agregarAgenda(){
        if(isset($_POST['matricula'])){
            if($this->getPost('matricula') == '' || $this->getPost('matricula') == null || intval($this->getPost('matricula'))<=0 || strlen($this->getPost('matricula')) < 3
            || $this->getPost('dia') == null || $this->getPost('dia') == ''
            || $this->getPost('hora_inicio') == null || $this->getPost('hora_inicio') == ''
            || $this->getPost('hora_fin') == null || $this->getPost('hora_fin') == ''
            || $this->getPost('fecha_fin_reserva') == null || $this->getPost('fecha_fin_reserva') == ''
            || $this->getPost('duracion_turnos') == null || $this->getPost('duracion_turnos') == ''
            ){
                $this->redirect('gestionarAgendas', ['error'=>ErrorMessage::ERROR_NEW_AGENDA]);
            }else{
                $matricula = intval($this->getPost('matricula'));
                $dia = strtolower($this->getPost('dia'));
                $horaInicio = date_format(new DateTime($this->getPost('hora_inicio')), 'H:i:s');
                $horaFin = date_format(new DateTime($this->getPost('hora_fin')), 'H:i:s');
                $fechaFin = date_format(new DateTime($this->getPost('fecha_fin_reserva')), 'Y-m-d H:i:s');
                $duracionTurno = intval($this->getPost('duracion_turnos'));
                $agenda = new AgendaModel();
                $agenda->setMatriculaDoctor($matricula);
                $agenda->setDia($dia);
                $agenda->setHoraInicio($horaInicio);
                $agenda->setHoraFin($horaFin);
                $agenda->setDuracionTurnos($duracionTurno);
                $agenda->setFechaFinReserva($fechaFin);
                if($agenda->sabe()){
                    $this->redirect('gestionarAgendas', ['success'=>SuccessMessage::SUCCESS_NEW_AGENDA]);
                }else{
                    $this->redirect('gestionarAgendas', ['error'=>ErrorMessage::ERROR_NEW_AGENDA_SABE]);
                }
            }
        }else{
            if($this->getPost('dia') == null || $this->getPost('dia') == ''
            || $this->getPost('hora_inicio') == null || $this->getPost('hora_inicio') == ''
            || $this->getPost('hora_fin') == null || $this->getPost('hora_fin') == ''
            || $this->getPost('fecha_fin_reserva') == null || $this->getPost('fecha_fin_reserva') == ''
            || $this->getPost('duracion_turnos') == null || $this->getPost('duracion_turnos') == ''
            ){
                $this->redirect('gestionarAgendas', ['error'=>ErrorMessage::ERROR_NEW_AGENDA]);
            }else{
                $dia = strtolower($this->getPost('dia'));
                $horaInicio = date_format(new DateTime($this->getPost('hora_inicio')), 'H:i:s');
                $horaFin = date_format(new DateTime($this->getPost('hora_fin')), 'H:i:s');
                $fechaFin = date_format(new DateTime($this->getPost('fecha_fin_reserva')), 'Y-m-d H:i:s');
                $duracionTurno = intval($this->getPost('duracion_turnos'));

                $agenda = new AgendaModel();
                $agenda->setDia($dia);
                $agenda->setHoraInicio($horaInicio);
                $agenda->setHoraFin($horaFin);
                $agenda->setDuracionTurnos($duracionTurno);
                $agenda->setFechaFinReserva($fechaFin);
                if($agenda->sabe()){
                    $this->redirect('gestionarAgendas', ['success'=>SuccessMessage::SUCCESS_NEW_AGENDA]);
                }else{
                    $this->redirect('gestionarAgendas', ['error'=>ErrorMessage::ERROR_NEW_AGENDA_SABE]);
                }
            }
        }
    }

    public function agregarDoctor(){
        if($this->existPOST(['clinica', 'nombre', 'localidad', 'matricula', 'especializacion'])){
            if($this->getPost('matricula') == '' || $this->getPost('matricula') == null || intval($this->getPost('matricula'))<=0 || strlen($this->getPost('matricula')) < 3
            || $this->getPost('clinica') == null || $this->getPost('clinica') == ''
            || $this->getPost('nombre') == null || $this->getPost('nombre') == ''
            || $this->getPost('localidad') == null || $this->getPost('localidad') == ''
            || $this->getPost('especializacion') == null || $this->getPost('especializacion') == ''
            ){
                $this->redirect('gestionarAgendas', ['error'=>ErrorMessage::ERROR_NEW_DOCTOR]);
            }else{
                $clinica = $this->getPost('clinica');
                $nombre = $this->getPost('nombre');
                $localidad = $this->getPost('localidad');
                $matricula = $this->getPost('matricula');
                $especializacion = $this->getPost('especializacion');

                $doctor = new DoctorModel();
                $doctor->setIdClinica($clinica);
                $doctor->setNombre($nombre);
                $doctor->setLocalidad($localidad);
                $doctor->setMatricula($matricula);
                $doctor->setEspecializacion($especializacion);

                if($doctor->sabe()){
                    $this->redirect('gestionarAgendas', ['success'=>SuccessMessage::SUCCESS_NEW_DOCTOR]);
                }else{
                    $this->redirect('gestionarAgendas', ['error'=>ErrorMessage::ERROR_NEW_DOCTOR_SABE]);
                }
            }
        }else{
            $this->redirect('gestionarAgendas', ['error'=>ErrorMessage::ERROR_NEW_INPUT_FUNCTION]);
        }
    }

    public function agregarProcedimiento(){
        if($this->existPOST(['nombre', 'indicaciones', 'matricula'])){
            if($this->getPost('matricula') == '' || $this->getPost('matricula') == null || intval($this->getPost('matricula'))<=0 || strlen($this->getPost('matricula')) < 3
            || $this->getPost('indicaciones') == null || $this->getPost('indicaciones') == ''
            || $this->getPost('nombre') == null || $this->getPost('nombre') == ''
            ){
                $this->redirect('gestionarAgendas', ['error'=>ErrorMessage::ERROR_NEW_PROCEDIMIENTO]);
            }else{
                $matricula = $this->getPost('matricula');
                $nombre = $this->getPost('nombre');
                $indicaciones=$this->getPost('indicaciones');

                $procedimiento = new ProcedimientoModel();
                $procedimiento->setNombre($nombre);
                $procedimiento->setMatriculaDoctor($matricula);
                $procedimiento->setIndicaciones($indicaciones);

                if($procedimiento->update()){
                    $this->redirect('gestionarAgendas', ['success'=>SuccessMessage::SUCCESS_NEW_DOCTOR]);
                }else{
                    $this->redirect('gestionarAgendas', ['error'=>ErrorMessage::ERROR_NEW_PROCEDIMIENTO_SABE]);
                }
            }
        }else{
            $this->redirect('gestionarAgendas', ['error'=>ErrorMessage::ERROR_NEW_INPUT_FUNCTION]);
        }
    }

    public function salir(){
        $salir = new Session();
        $salir->closeSession();
        $this->redirect('');
    }

    public function getClinica(){return $this->clinica;}
    public function setClinica($clinica){$this->clinica = $clinica;return $this;}
}
?>