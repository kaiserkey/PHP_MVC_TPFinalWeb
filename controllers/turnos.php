<?

//Libreria para generar pdf FPDF 
require_once('helpers/FPDF/fpdf.php');
//Libreria para enviar Emails PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
require_once('helpers/PHPMailer/src/PHPMailer.php');
require_once ('helpers/PHPMailer/src/Exception.php');
require_once ('helpers/PHPMailer/src/SMTP.php');

    class Turnos extends SessionController{
        private $user;
        private $agenda;
        private $turnos;
        private $doctor;
        private $doctorEspecializaciones;
        private $procedimiento;
        private $procedimientoNombres;
        private $arrayFechas;
        private $datosTurno = [];
        private $clinica;

        public function __construct()
        {
            error_log('Turnos::construct -> Inicio de Turnos');
            #para que herede de controller la clase loadmodel
            parent::__construct();
            $this->setUser($this->getUserSessionData());
            $this->setTurnos($this->getTurnosDB());
            $this->setAgenda($this->getAgendaDB());
            $this->setDoctor($this->getDoctorDB());
            $this->setDoctorEspecializaciones($this->getEspecializacionDoctor());
            $this->setProcedimiento($this->getProcedimientoDB());
            $this->setProcedimientoNombres($this->getProcedimientos());
        }

        
        public function render(){
            $this->view->render('dashboard/turnos', ['userPaciente'=> $this->getUser(), 'turnosDB'=>$this->getTurnos(), 
                                                    'agendaDB'=>$this->getAgenda(), 'doctorBD'=>$this->getDoctor(),
                                                    'procedimientoBD'=>$this->getProcedimiento(), 'especializaciones'=>$this->getDoctorEspecializaciones(),
                                                    'procedimientoNombres'=>$this->getProcedimientoNombres(), 'listadoDeTurnos'=>$this->getArrayFechas(),
                                                    'datosTurno'=>$this->getDatosTurno()
                                                    ]);
            error_log('Turnos::render -> Carga la vista de Turnos');
        }

        public function enviaEmail($horaTurno, $fechaTurno, $matriculaDoctor, $tipoTurno){
            if(strpos($horaTurno, 'AM')==false){
                $fecha = new DateTime($fechaTurno . ' ' . rtrim(str_replace('00:PM', '00', $horaTurno)));
            }else{
                $fecha = new DateTime($fechaTurno . ' ' . rtrim(str_replace('00:AM', '00', $horaTurno)));
            }
            
            //obtener datos del doctor
            $doctor = $this->getDoctorByMatricula($matriculaDoctor);
            //obtener datos de la clinica
            $clinica = $this->getClinicaByID($doctor->getIdClinica());

            //pass: pruebas123
            //email: clinicavillamercedes@gmail.com
            //Create an instance; passing `true` enables exceptions
            $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                $mail->isSMTP();  
                $mail->From   = $clinica->getEmail();
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;     //Enable implicit TLS encryption
                $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = $clinica->getEmail();                     //SMTP username
                $mail->Password   = "pruebas123";                               //SMTP password

                

                //Recipients
                $mail->setFrom($clinica->getEmail(), $clinica->getNombre());
                $mail->addAddress($this->user->getEmail(), $this->user->getNombre(). ' ' . $this->user->getApellido());     //Add a recipient
                // $mail->addAddress('ellen@example.com');               //Name is optional
                // $mail->addReplyTo('info@example.com', 'Information');
                // $mail->addCC('cc@example.com');
                // $mail->addBCC('bcc@example.com');

                //Content
                $mail->isHTML(true);//Set email format to HTML
                $mail->CharSet = 'UTF-8';
                $mail->Subject = 'Recordatorio De Turno';
                $mail->Body .="<h1 style='font-family: Arial;'>Los Datos De Su Turno</h1>";
                $mail->Body    .= '<b>PACIENTE: </b>'. $this->user->getNombre().$this->user->getApellido() . '<br>' .
                                '<b>PROFESIONAL: </b>' . $doctor->getNombre().'<br>' .
                                '<b>ESPECIALIDAD: </b>' . $doctor->getEspecializacion().'<br>' .
                                '<b>FECHA: </b>' . $fecha->format('d/m/Y').'<br>' .
                                '<b>HORA: </b>' . $fecha->format('H:i A').'<br>';
                if($tipoTurno == 'procedimiento'){
                    $procedimiento = $this->getProcedimientoByID($matriculaDoctor);
                    $mail->Body    .= '<b>INDICACIONES: </b>' . $procedimiento->getIndicaciones();
                }
                $mail->Body  .='<br><br>';
                $mail->Body .= '<b>' . $clinica->getNombre() . '</b> <br>' .
                                '<b> Direccion - ' . $clinica->getDireccionSede() . '</b> <br>' .
                                '<b> Telefono - ' . $clinica->getTelefono() . '</b>';
                
                // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                if($mail->send()){
                    $this->redirect('dashboard', ['success'=>SuccessMessage::SUCCESS_SENT_EMAIL]);
                }else{
                    $this->redirect('dashboard', ['error'=>ErrorMessage::ERROR_SENT_EMAIL]);
                }
                
            } catch (Exception $e) {
                error_log("No Se Ha Podido Enviar El Email. Mailer Error: {$mail->ErrorInfo}");
            }
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
                $fpdf->Write(10, 'PACIENTE: ' . $this->user->getNombre() . ' ' . $this->user->getApellido());
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
            }else{
                $this->redirect('dashboard', ['error'=>ErrorMessage::ERROR_NEW_INPUT_FUNCTION]);
            }
        }

        public function cancelarTurno(){
            if(isset($_GET['idTurno'])){
                $turno = new TurnoModel();
                $turno->get($this->getGet('idTurno'));
                $fechaTurno = date_format(new DateTime($turno->getFechaTurnoBD()), 'd/m/Y');
                $estado = $turno->getEstado();
                $fechaActual = date_format(new DateTime('now'), 'd/m/Y');
                if($fechaTurno >= $fechaActual || $estado == 'Cancelado' || $estado == 'Ausente' || $estado == 'Completo'){
                    $this->redirect('dashboard', ['error'=>ErrorMessage::ERROR_CANCEL_TURNO]);
                }else{
                    $turno->setEstado('Cancelado');
                    $turno->update();
                    $cancelaciones = $this->user->getCancelaciones();
                    $this->user->setCancelaciones($cancelaciones+1);
                    $this->user->update();
                    $this->redirect('dashboard', ['success'=>SuccessMessage::SUCCESS_CANCEL_TURNO]);
                }
            }else{
                $this->redirect('dashboard', ['error'=>ErrorMessage::ERROR_NEW_INPUT_FUNCTION]);
            }
        }

        public function reservarTurno(){
            if($this->existGET(['tipoturno', 'turnoespecializacion', 'matriculadoctor', 'fecha', 'hora'])){
                $formatoFechaBD = 'Y-m-d';
                $fechaRegistro = new DateTime('now');
                $fechaTurno = $this->getGet('fecha');
                $dniPaciente = $this->user->getDni();
                $horaTurno = $this->getGet('hora');
                $tipoDeTurno = $this->getGet('tipoturno');
                $matriculaDcotor = $this->getGet('matriculadoctor');
                $turno = new TurnoModel();
                $turno->setDniPaciente($dniPaciente);
                $turno->setHora($horaTurno);
                $turno->setFechaTurno($fechaTurno);
                $turno->setFechaRegistro($fechaRegistro->format($formatoFechaBD));
                $turno->setMatriculaDoctor($matriculaDcotor);
                $turno->setTipoTurno($tipoDeTurno);

                if($turno->sabe()){
                    $this->enviaEmail($turno->getHora(), $turno->getFechaTurnoBD(), $turno->getMatriculaDoctor(), $turno->getTipoTurno());
                }else{
                    $this->redirect('turnos', ['error'=>ErrorMessage::ERROR_SABE_TURNO]);
                }
            }else{
                $this->redirect('dashboard', ['error'=>ErrorMessage::ERROR_NEW_INPUT_FUNCTION]);
            }
        }

        public function consultarTurnos(){
            //consultar los turnos disponibles
            if($this->existPOST(['nombreDoctor', 'especializaciones', 'tipoDeOperacion'])){

                $this->setDatosTurno([$this->getPOST('tipoDeOperacion'), $this->getPOST('especializaciones'), $this->getPOST('nombreDoctor')]);
                
                $matricula =$this->getPOST('nombreDoctor');

                if($matricula == '' || empty($matricula)){
                    $this->redirect('turnos', ['error'=>ErrorMessage::ERROR_CONSULT_CAMPOS_TURNOS]);
                }
                $hoy = new DateTime('now');
                $formato = 'd/m/Y H:i:s';
                $agendas = $this->getAgendaByMatricula($matricula);
                if(empty($agendas)){
                    $this->redirect('turnos', ['error'=>ErrorMessage::ERROR_CONSULT_CAMPOS_TURNOS]);
                }else{
                    $arregloIntervalosFecha = [];
                    for($i = 0 ; $i<count($agendas) ; $i++){
                        $arregloIntervalosFecha[$i] = $this->getFechaIntervalos($hoy->format("Y-m-d" . $agendas[$i]->getHoraInicio()), 
                                                                        $agendas[$i]->getFechaFinReserva(), 
                                                                        $formato, 
                                                                        $agendas[$i]->getDuracionTurnos(), 
                                                                        $agendas[$i]->getDia(),
                                                                        $agendas[$i]->getHoraInicio(),
                                                                        $agendas[$i]->getHoraFin()
                                                                        );
                    }
                    
                    $fechasReservadas = $this->getFechasReservadas();
                    
                    $fechasTurnos = $this->arregloDeFechasHoras($arregloIntervalosFecha);
                    //quitamos los turnos que ya estan reservados	
                    $quitarReservas = array_values(array_diff($fechasTurnos, $fechasReservadas));
                    
                    $this->setArrayFechas($quitarReservas);
                    if(!empty($quitarReservas)){
                        $this->render();
                    }else{
                        $this->redirect('turnos', ['error'=>ErrorMessage::ERROR_TURNOS_VOID]);
                    }
                }
            }else{
                $this->redirect('turnos', ['error'=>ErrorMessage::ERROR_NEW_INPUT_FUNCTION]);
            }
        }
        
        public function retornarES_EN($dia){
            switch($dia){
                case 'lunes':
                    return ('Monday');
                    break;
                case 'martes':
                    return('Tuesday');
                    break;
                case 'miercoles':
                    return('Wednesday');
                    break;
                case 'jueves':
                    return('Thursday');
                    break;
                case 'viernes':
                    return('Friday');
                    break;
                case 'sabado':
                    return('Saturday');
                    break;
                case 'domingo':
                    return('Sunday');
                    break;
            }
        }
        public function retornarEN_ES($dia){
            switch($dia){
                case 'Monday':
                    return 'lunes';
                    break;
                case 'Tuesday':
                    return 'martes';
                    break;
                case 'Wednesday':
                    return 'miercoles';
                    break;
                case 'Thursday':
                    return 'jueves';
                    break;
                case 'Friday':
                    return 'viernes';
                    break;
                case 'Saturday':
                    return 'sabado';
                    break;
                case 'Sunday':
                    return 'domingo';
                    break;
            }
        }
        public function getFechaIntervalos($fechaInicio, $fechaFinal, $formato, $intervalo=0, $dia = '', $horaInicio, $horaFin) {
            $fechaInicio = DateTime::createFromFormat($formato, date_format(new DateTime($fechaInicio), $formato), new DateTimeZone('America/Argentina/San_Luis'));
            $fechaFin = DateTime::createFromFormat($formato, date_format(new DateTime($fechaFinal), $formato), new DateTimeZone('America/Argentina/San_Luis'));
            
            $intervalo = DateInterval::createFromDateString("$intervalo minutes");
            
            $periodo = new DatePeriod(
                $fechaInicio,
                $intervalo,
                $fechaFin
            ); 
            
            
            //'H:i:A'
            $range = array();
            foreach ($periodo as $date) {
                if($date->format('l') === $this->retornarES_EN($dia)){
                    if($date->format('H:i:s') >= date($horaInicio)){
                        if($date->format('H:i:s') < date($horaFin)){
                            array_push($range, $date);
                        }
                    }
                }
            }
            
            // return var_dump($range);
    
            //$fechaDeFin = new DateTime($fechaFinal);
            // if($fechaDeFin->format('l') === $dia){
            //     $range[] = $fechaDeFin->format($formato);
            // }
            
            return $range; //regresamos un objeto de tipo datetime
        }    

        public function arregloDeFechasHoras($arregloDeIntervalosDeFecha = array()){
            $fechas = [];
    
            foreach($arregloDeIntervalosDeFecha as $datos=>$fecha){
                foreach($fecha as $datetime){
                    $fechas[]=$datetime->format('m/d/Y H:i:s');
                }
            }
    
            return $fechas;
        }

        public function getUser(){return $this->user;}
        public function setUser($user){$this->user = $user;return $this;}
        public function getAgenda(){return $this->agenda;}
        public function setAgenda($agenda){$this->agenda = $agenda;return $this;}
        public function getTurnos(){return $this->turnos;}
        public function setTurnos($turnos){$this->turnos = $turnos;return $this;} 
        public function getDoctor(){return $this->doctor;}
        public function setDoctor($doctor){$this->doctor = $doctor;return $this;}
        public function getProcedimiento(){return $this->procedimiento;}
        public function setProcedimiento($procedimiento){$this->procedimiento = $procedimiento;return $this;} 
        public function getDoctorEspecializaciones(){return $this->doctorEspecializaciones;}
        public function setDoctorEspecializaciones($doctorEspecializaciones){$this->doctorEspecializaciones = $doctorEspecializaciones;return $this;}
        public function getProcedimientoNombres(){return $this->procedimientoNombres;}
        public function setProcedimientoNombres($procedimientoNombres){$this->procedimientoNombres = $procedimientoNombres;return $this;}
        public function getArrayFechas(){return $this->arrayFechas;}
        public function setArrayFechas($arrayFechas){$this->arrayFechas = $arrayFechas;return $this;}
        public function getDatosTurno(){return $this->datosTurno;}
        public function setDatosTurno($datosTurno){$this->datosTurno = $datosTurno;return $this;}
        public function getClinica(){return $this->clinica;}
        public function setClinica($clinica){$this->clinica = $clinica;return $this;}
    }
?>