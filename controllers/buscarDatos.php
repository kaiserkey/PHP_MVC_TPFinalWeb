<?
class BuscarDatos extends SessionController{
    private $datos;
    private $datosDoctor;
    private $datosProcedimiento;
    private $clinica;

    public function __construct(){
        parent::__construct();
        error_log('BuscarDatos::construct -> Inicio de BuscarDatos');
        $this->setClinica($this->getClinicaIDNombre());
    }

    public function render(){
        $this->view->render('administrador/buscarDatos', ['datos'=>$this->getDatos(), 'datosDoctor'=>$this->getDatosDoctor(), 
        'datosProcedimiento'=>$this->getDatosProcedimiento(), 'clinicasIDNombre'=>$this->getClinica()]);
        error_log('BuscarDatos::render -> Carga el index de BuscarDatos');
    }

    public function buscarAgendasPor(){
        if($this->existPOST(['buscarpor'])){
            #buscar agendas
            if($this->getPost('buscarpor') == 'agenda'){
                if($this->existPOST(['buscar'])){
                    if($this->getPost('buscar')=='dia'){
                        if($this->getPost('dia')==null || $this->getPost('dia')==''){
                            $this->redirect('buscarDatos', ['error'=>ErrorMessage::ERROR_BUSCAR_FORM]);
                        }else{
                            $dia = $this->getPost('dia');

                            $agenda = new AgendaModel();
                            $this->setDatos($agenda->getAgendaBy('dia', $dia));
                            if($this->getDatos()!=null){
                                $this->render();
                            }else{
                                $this->redirect('buscarDatos', ['error'=>ErrorMessage::ERROR_BUSCAR]);
                            }
                        }
                    }
                    if($this->getPost('buscar')=='matricula'){
                        if($this->getPost('matricula') == '' || $this->getPost('matricula') == null || intval($this->getPost('matricula'))<=0 || strlen($this->getPost('matricula')) < 3){
                            $this->redirect('buscarDatos', ['error'=>ErrorMessage::ERROR_BUSCAR_FORM]);
                        }else{
                            $matricula = $this->getPost('matricula');
                        
                            $agenda = new AgendaModel();
                            $this->setDatos($agenda->getAgendaBy('matricula_doctor', $matricula));
                            if($this->getDatos()!=null){
                                $this->render();
                            }else{
                                $this->redirect('buscarDatos', ['error'=>ErrorMessage::ERROR_BUSCAR]);
                            }
                        }
                    }
                    if($this->getPost('buscar')=='duracion'){
                        if($this->getPost('duracion_turnos')==null || $this->getPost('duracion_turnos')==''){
                            $this->redirect('buscarDatos', ['error'=>ErrorMessage::ERROR_BUSCAR_FORM]);
                        }else{
                            $duracion = intval($this->getPost('duracion_turnos'));

                            $agenda = new AgendaModel();
                            $this->setDatos($agenda->getAgendaBy('duracion_turnos', $duracion));
                            if($this->getDatos()!=null){
                                $this->render();
                            }else{
                                $this->redirect('buscarDatos', ['error'=>ErrorMessage::ERROR_BUSCAR]);
                            }
                        }
                        
                    }
                    if($this->getPost('buscar')=='-'){
                        $agenda = new AgendaModel();
                        $this->setDatos($agenda->getAll());
                        if($this->getDatos()!=null){
                            $this->render();
                        }else{
                            $this->redirect('buscarDatos', ['error'=>ErrorMessage::ERROR_BUSCAR]);
                        }
                    }
                }
            }
            #buscar doctor
            if($this->getPost('buscarpor')=='doctor'){
                if($this->getPost('matricula') == '' || $this->getPost('matricula') == null){
                    $matricula = $this->getPost('matricula');

                    $doctor = new DoctorModel();
                    $this->setDatosDoctor($doctor->getAll());
                    if($this->getDatosDoctor()!=null){
                        $this->render();
                    }else{
                        $this->redirect('buscarDatos', ['error'=>ErrorMessage::ERROR_BUSCAR]);
                    }
                }else{
                    if(intval($this->getPost('matricula'))<=0 || strlen($this->getPost('matricula')) < 3){
                        $this->redirect('buscarDatos', ['error'=>ErrorMessage::ERROR_BUSCAR_FORM]);
                    }else{
                        $matricula = $this->getPost('matricula');

                        $doctor = new DoctorModel();
                        $this->setDatosDoctor($doctor->getAllBy($matricula));
                        if($this->getDatosDoctor()!=null){
                            $this->render();
                        }else{
                            $this->redirect('buscarDatos', ['error'=>ErrorMessage::ERROR_BUSCAR]);
                        }
                    }
                }
                
            }
            #buscar procedimiento
            if($this->getPost('buscarpor')=='procedimiento'){
                if($this->getPost('procmatricula') == '' || $this->getPost('procmatricula') == null){
                    $matricula = $this->getPost('procmatricula');
    
                    $procedimiento = new ProcedimientoModel();
                    
                    $this->setDatosProcedimiento($procedimiento->getAll());
                    if($this->getDatosProcedimiento()!=null){
                        $this->render();
                    }else{
                        $this->redirect('buscarDatos', ['error'=>ErrorMessage::ERROR_BUSCAR]);
                    }
                }else{
                    if(intval($this->getPost('procmatricula'))<=0 || strlen($this->getPost('procmatricula')) < 3){
                        $this->redirect('buscarDatos', ['error'=>ErrorMessage::ERROR_BUSCAR_FORM]);
                    }else{
                        $matricula = $this->getPost('procmatricula');
    
                        $procedimiento = new ProcedimientoModel();
                        $this->setDatosProcedimiento($procedimiento->getAllBy($matricula));
                        if($this->getDatosProcedimiento()!=null){
                            $this->render();
                        }else{
                            $this->redirect('buscarDatos', ['error'=>ErrorMessage::ERROR_BUSCAR]);
                        }
                    }
                }
            }
        }else{
            $this->redirect('buscarAgendas', ['error'=>ErrorMessage::ERROR_NEW_INPUT_FUNCTION]);
        }
    }

    public function actualizarAgenda(){
        if($this->existPOST(['matricula', 'dia', 'hora_inicio', 'hora_fin', 'fecha_fin_reserva', 'duracion_turnos'])){
            if($this->getPost('matricula') == '' || $this->getPost('matricula') == null || intval($this->getPost('matricula'))<=0 || strlen($this->getPost('matricula')) < 3
            || $this->getPost('dia') == null || $this->getPost('dia') == ''
            || $this->getPost('hora_inicio') == null || $this->getPost('hora_inicio') == ''
            || $this->getPost('hora_fin') == null || $this->getPost('hora_fin') == ''
            || $this->getPost('fecha_fin_reserva') == null || $this->getPost('fecha_fin_reserva') == ''
            || $this->getPost('duracion_turnos') == null || $this->getPost('duracion_turnos') == ''
            ){
                $this->redirect('buscarDatos', ['error'=>ErrorMessage::ERROR_UPDATE_AGENDA]);
            }else{
                $idAgenda=$this->getPost('idAgenda');
                $matricula = intval($this->getPost('matricula'));
                $dia = strtolower($this->getPost('dia'));
                $horaInicio = date_format(new DateTime($this->getPost('hora_inicio')), 'H:i:s');
                $horaFin = date_format(new DateTime($this->getPost('hora_fin')), 'H:i:s');
                $fechaFin = date_format(new DateTime($this->getPost('fecha_fin_reserva')), 'Y-m-d H:i:s');
                $duracionTurno = intval($this->getPost('duracion_turnos'));
                $agenda = new AgendaModel();
                $agenda->setIdAgenda($idAgenda);
                $agenda->setMatriculaDoctor($matricula);
                $agenda->setDia($dia);
                $agenda->setHoraInicio($horaInicio);
                $agenda->setHoraFin($horaFin);
                $agenda->setDuracionTurnos($duracionTurno);
                $agenda->setFechaFinReserva($fechaFin);
                if($agenda->update()){
                    $this->redirect('buscarDatos', ['success'=>SuccessMessage::SUCCESS_UPDATE_AGENDA]);
                }else{
                    $this->redirect('buscarDatos', ['error'=>ErrorMessage::ERROR_UPDATE_AGENDA_SABE]);
                }
            }
        }
    }

    public function actualizarDoctor(){
        if($this->existPOST(['clinica', 'nombre', 'localidad', 'matricula', 'especializacion'])){
            if($this->getPost('matricula') == '' || $this->getPost('matricula') == null || intval($this->getPost('matricula'))<=0 || strlen($this->getPost('matricula')) < 3
            || $this->getPost('clinica') == null || $this->getPost('clinica') == ''
            || $this->getPost('nombre') == null || $this->getPost('nombre') == ''
            || $this->getPost('localidad') == null || $this->getPost('localidad') == ''
            || $this->getPost('especializacion') == null || $this->getPost('especializacion') == ''
            ){
                $this->redirect('buscarDatos', ['error'=>ErrorMessage::ERROR_UPDATE_DOCTOR]);
            }else{
                $idDoctor=$this->getPost('idDoctor');
                $clinica = $this->getPost('clinica');
                $nombre = $this->getPost('nombre');
                $localidad = $this->getPost('localidad');
                $matricula = $this->getPost('matricula');
                $especializacion = $this->getPost('especializacion');

                $doctor = new DoctorModel();
                $doctor->setIdDoctor($idDoctor);
                $doctor->setIdClinica($clinica);
                $doctor->setNombre($nombre);
                $doctor->setLocalidad($localidad);
                $doctor->setMatricula($matricula);
                $doctor->setEspecializacion($especializacion);

                if($doctor->update()){
                    $this->redirect('buscarDatos', ['success'=>SuccessMessage::SUCCESS_UPDATE_DOCTOR]);
                }else{
                    $this->redirect('buscarDatos', ['error'=>ErrorMessage::ERROR_UPDATE_DOCTOR_SABE]);
                }
            }
        }else{
            $this->redirect('buscarDatos', ['error'=>ErrorMessage::ERROR_NEW_INPUT_FUNCTION]);
        }
    }

    public function actualizarProcedimiento(){
        if($this->existPOST(['nombre', 'indicaciones', 'matricula'])){
            if($this->getPost('matricula') == '' || $this->getPost('matricula') == null || intval($this->getPost('matricula'))<=0 || strlen($this->getPost('matricula')) < 3
            || $this->getPost('indicaciones') == null || $this->getPost('indicaciones') == ''
            || $this->getPost('nombre') == null || $this->getPost('nombre') == ''
            ){
                $this->redirect('buscarDatos', ['error'=>ErrorMessage::ERROR_UPDATE_PROCEDIMIENTO]);
            }else{
                $idProcedimiento=$this->getPost('idProcediento');
                $matricula = $this->getPost('matricula');
                $nombre = $this->getPost('nombre');
                $indicaciones=$this->getPost('indicaciones');

                $procedimiento = new ProcedimientoModel();
                $procedimiento->setIdProcedimiento($idProcedimiento);
                $procedimiento->setNombre($nombre);
                $procedimiento->setMatriculaDoctor($matricula);
                $procedimiento->setIndicaciones($indicaciones);
                if($procedimiento->update()){
                    $this->redirect('buscarDatos', ['success'=>SuccessMessage::SUCCESS_UPDATE_PROCEDIMIENTO]);
                }else{
                    $this->redirect('buscarDatos', ['error'=>ErrorMessage::ERROR_NEW_PROCEDIMIENTO_SABE]);
                }
            }
        }else{
            $this->redirect('buscarDatos', ['error'=>ErrorMessage::ERROR_NEW_INPUT_FUNCTION]);
        }
    }

    public function getDatos(){return $this->datos;}
    public function setDatos($datos){$this->datos = $datos;return $this;} 
    public function getDatosDoctor(){return $this->datosDoctor;}
    public function setDatosDoctor($datosDoctor){$this->datosDoctor = $datosDoctor;return $this;}
    public function getDatosProcedimiento(){return $this->datosProcedimiento;}
    public function setDatosProcedimiento($datosProcedimiento){$this->datosProcedimiento = $datosProcedimiento;return $this;}
    public function getClinica(){return $this->clinica;} 
    public function setClinica($clinica){$this->clinica = $clinica;return $this;}
}
?>