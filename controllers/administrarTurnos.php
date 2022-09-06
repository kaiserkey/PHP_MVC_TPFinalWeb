<?
require_once('helpers/FPDF/fpdf.php');
class AdministrarTurnos extends SessionController{
    private $turnos;
    private $cancelaciones;

    public function __construct(){
        parent::__construct();
        error_log('AdministrarTurnos::construct -> Inicio de AdministrarTurnos');
        #para que herede de controller la clase loadmodel
        $this->setCancelaciones($this->getUsuarioCancelaciones());
        $this->setTurnos($this->getTurnosAdministracion());
    }
    public function render(){
        $this->view->render('administracion/index', ['turnosDB'=>$this->getTurnos(), 'usuariosRiesgosos'=>$this->getCancelaciones()
                                                ]);
        error_log('AdministrarTurnos::render -> Carga el index de AdministrarTurnos');
    }

    

    public function imprimirTurno(){
        /**
             * Sucursal, fecha, hora, especialidad si es un médico, 
             * médico o procedimiento, indicaciones si
             * es un procedimiento y paciente
        */
        
        if($this->existGET(['matricula', 'hora', 'fechaTurno', 'dniPaciente', 'tipoTurno'])){
            // return var_dump(rtrim(str_replace('00:AM', '00', $this->getGet('hora'))));
            if(strpos($this->getGet('hora'), 'AM')==false){
                $fecha = new DateTime($this->getGet('fechaTurno') . rtrim(str_replace('00:PM', '00', $this->getGet('hora'))));
            }else{
                $fecha = new DateTime($this->getGet('fechaTurno') . rtrim(str_replace('00:AM', '00', $this->getGet('hora'))));
            }
            //obtener datos del doctor
            $doctor = $this->getDoctorByMatricula($this->getGet('matricula'));
            //obtener datos de la clinica
            $clinica = $this->getClinicaByID($doctor->getIdClinica());
            //obtener el nombre del usuario
            $usuario = $this->getUsuarioNombre($this->getGet('dniPaciente'));

            $fpdf = new FPDF();
            $fpdf->AliasNbPages();
            $fpdf->AddPage();
            
            #Header
            $fpdf->SetFont('Arial','B',20);
            // Move to the right
            $fpdf->Cell(65);
            // Title
            $fpdf->Cell(60,5,'Recordatorio De Turno',0,0,'C');
            // Line break
            $fpdf->Ln(20);

            #Body
            $fpdf->SetFont('Arial', 'B', 15);
            $fpdf->Write(10, 'PACIENTE: ' . $usuario->getNombre() . ' ' . $usuario->getApellido());
            $fpdf->Ln(10);
            $fpdf->Write(10, 'PROFESIONAL: ' . $doctor->getNombre());
            $fpdf->Ln(10);
            $fpdf->Write(10, 'ESPECIALIDAD: ' . $doctor->getEspecializacion());
            $fpdf->Ln(10);
            $fpdf->Write(10, 'FECHA: ' . $fecha->format('d/m/Y'));
            $fpdf->Ln(10);
            $fpdf->Write(10, 'HORA: ' . $fecha->format('H:i A'));
            if($this->getGet('tipoTurno')=='procedimiento'){
                $procedimiento = $this->getProcedimientoByID($this->getGet('matricula'));
                $fpdf->Ln(10);
                $fpdf->Write(10, 'INDICACIONES: ' . $procedimiento->getIndicaciones());
            }

            #Footer Informacion Clinica
            $fpdf->Ln(20);
            $fpdf->SetLeftMargin(60);
            $fpdf->Write(10, $clinica->getNombre());
            $fpdf->Ln(10);
            $fpdf->Write(10, $clinica->getDireccionSede());
            $fpdf->Ln(10);
            $fpdf->Write(10, 'Email: ' . $clinica->getEmail());
            $fpdf->Ln(10);
            $fpdf->Write(10, 'Telefono: ' . $clinica->getTelefono());
            
            $fpdf->Output();
            
            
        }
    }

    public function actualizarTurno(){
        if(isset($_POST['indice']) and isset($_POST['estado'])){
            
            $this->turnos[$this->getPost('indice')]->setEstado($this->getPost('estado'));
            $this->turnos[$this->getPost('indice')]->update();
            if($this->getPost('estado')=='Atendido'){
                $fecha = new DateTime('now');
                $historial = new HistoriaClinicaModel();
                $doctor = new DoctorModel();
                $doctor->get($this->turnos[$this->getPost('indice')]->getMatriculaDoctor());
                $historial->setEspecializacion($doctor->getEspecializacion());
                $historial->setIdPaciente($this->turnos[$this->getPost('indice')]->getDniPaciente());
                $historial->setFecha($fecha->format('Y-m-d'));
                $historial->setDoctorMatricula($this->turnos[$this->getPost('indice')]->getMatriculaDoctor());
                $historial->sabe();
            }
            if($this->getPost('estado')=='Cancelado' || $this->getPost('estado')=='Ausente'){
                $cancelaciones = $this->user->getCancelaciones();
                $this->user->setCancelaciones($cancelaciones+1);
                $this->user->update();
            }

            $this->redirect('administrarTurnos', ['success'=>SuccessMessage::SUCCESS_ADMINISTRAR_TURNO]);
            
        }
    }

    public function salir(){
        $salir = new Session();
        $salir->closeSession();
        $this->redirect('');
    }

    public function getTurnos(){return $this->turnos;}
    public function setTurnos($turnos){$this->turnos = $turnos;return $this;} 
    public function getCancelaciones(){return $this->cancelaciones;}
    public function setCancelaciones($cancelaciones){$this->cancelaciones = $cancelaciones;return $this;}
    
}
?>