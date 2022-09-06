<?

class AgendaModel extends Model implements IModel{
    private $idAgenda;
    private $dia;
    private $horaInicio;
    private $horaFin;
    private $fechaFinReserva;
    private $duracionTurnos;
    private $matriculaDoctor;

    public function __construct(){
        parent::__construct();
        $this->idAgenda = 0;
        $this->dia = '';
        $this->horaInicio = '';
        $this->horaFin = '';
        $this->fechaFinReserva = '';
        $this->duracionTurnos = 0;
        $this->matriculaDoctor=0;
    }

    public function getAllByMatricula($matricula){
        $items = [];
        try{
            $query = $this->prepare("SELECT * FROM agenda WHERE matricula_doctor=:md");
            $query->execute([
                ':md'=>$matricula
            ]);
            while($point = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new AgendaModel();
                $item->setIdAgenda($point['id_agenda']);
                $item->setDia($point['dia']);
                $item->setHoraInicio($point['hora_inicio']);
                $item->setHoraFin($point['hora_fin']);
                $item->setDuracionTurnos($point['duracion_turnos']);
                $item->setFechaFinReserva($point['fecha_fin_reserva']);
                $item->setMatriculaDoctor($point['matricula_doctor']);
                array_push($items, $item);
            }
            return $items;
        }catch(PDOException $e){
            error_log('AGENDAMODEL:: GET ALL FUNCTION -> PDOException ' . $e);
            return false;
        }
    }


    public function sabe(){
        try{
            $query = $this->prepare('INSERT INTO agenda (dia, hora_inicio, hora_fin,
                fecha_fin_reserva, duracion_turnos, matricula_doctor) 
                VALUES (:dia,:hi,:hf,:ffr,:dt,:md)');
                $query->execute([
                    ':dia'=>$this->dia,
                    ':hi'=>$this->horaInicio, 
                    ':hf'=>$this->horaFin,
                    ':ffr'=>$this->fechaFinReserva,
                    ':dt'=>$this->duracionTurnos, 
                    ':md'=>$this->matriculaDoctor
                ]);
            return true;
        }catch(PDOException $e){
            error_log('AGENDAMODEL:: SABE AGENDA -> PDOException ' . $e);
            return false;
        }
    }

    public function getAll(){
        $items = [];
        try{
            $query = $this->query("SELECT * FROM agenda");
            while($point = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new AgendaModel();
                $item->setIdAgenda($point['id_agenda']);
                $item->setDia($point['dia']);
                $item->setHoraInicio($point['hora_inicio']);
                $item->setHoraFin($point['hora_fin']);
                $item->setDuracionTurnos($point['duracion_turnos']);
                $item->setFechaFinReserva($point['fecha_fin_reserva']);
                $item->setMatriculaDoctor($point['matricula_doctor']);
                array_push($items, $item);
            }
            return $items;
        }catch(PDOException $e){
            error_log('AGENDAMODEL:: GET ALL FUNCTION -> PDOException ' . $e);
            return false;
        }
    }

    public function getAgendaBy($tabla, $busqueda){
        $resultados = [];
        try{
            $query = $this->prepare("SELECT * FROM agenda WHERE $tabla = :bs");

            $query -> execute([
                ':bs'=> $busqueda
            ]);

            while($agenda = $query->fetch(PDO::FETCH_ASSOC)){
                $agendas = new AgendaModel();
                $agendas->setIdAgenda($agenda['id_agenda']);
                $agendas->setDia($agenda['dia']);
                $agendas->setHoraInicio($agenda['hora_inicio']);
                $agendas->setHoraFin($agenda['hora_fin']);
                $agendas->setFechaFinReserva($agenda['fecha_fin_reserva']);
                $agendas->setDuracionTurnos($agenda['duracion_turnos']);
                $agendas->setMatriculaDoctor($agenda['matricula_doctor']);
                array_push($resultados,$agendas);
            }

            return $resultados;
        }catch(PDOException $e){
            error_log('AGENDAMODEL:: getAll -> PDOException ' . $e);
            return false;
        }
    }

    public function get($idAgenda){
        try{
            $query = $this->prepare('SELECT * FROM agenda WHERE id_agenda = :id');

            $query -> execute([
                ':id'=> $idAgenda
            ]);

            $agenda = $query->fetch(PDO::FETCH_ASSOC);
            $this->setIdAgenda($agenda['id_agenda']);
            $this->setDia($agenda['dia']);
            $this->setHoraInicio($agenda['hora_inicio']);
            $this->setHoraFin($agenda['hora_fin']);
            $this->setFechaFinReserva($agenda['fecha_fin_reserva']);
            $this->setDuracionTurnos($agenda['duracion_turnos']);
            $this->setMatriculaDoctor($agenda['matricula_doctor']);           

            return $this;
        }catch(PDOException $e){
            error_log('AGENDAMODEL:: getAll -> PDOException ' . $e);
            return false;
        }
    }

    public function delete($id){
        try{
            $query = $this->query('DELETE FROM agenda WHERE id_agenda = :id');
            $query -> execute([
                ':id'=> $id
            ]);           

            return true;
        }catch(PDOException $e){
            error_log('AGENDAMODEL:: delete -> PDOException ' . $e);
            return false;
        }
    }

    public function update(){
        try{ 
            $query = $this->prepare('UPDATE agenda 
                                    SET dia=:dia, hora_inicio=:hi, duracion_turnos=:dt, 
                                        hora_fin=:hf, fecha_fin_reserva=:ffr,  matricula_doctor=:md
                                    WHERE id_agenda=:id');
            $query->execute([
                ':id'=>$this->idAgenda,
                ':dia'=>$this->dia,
                ':dt'=>$this->duracionTurnos,
                ':hi'=>$this->horaInicio, 
                ':hf'=>$this->horaFin, 
                ':ffr'=>$this->fechaFinReserva,
                ':md'=>$this->matriculaDoctor
            ]);
            return true;
        }catch(PDOException $e){
            error_log('AGENDA MODEL:: UPDATE -> PDOException ' . $e);
            return false;
        }
    }
    public function from($array){
        $this->setIdAgenda($array['id_agenda']);
        $this->setDia($array['dia']);
        $this->setHoraInicio($array['hora_inicio']);
        $this->setHoraFin($array['hora_fin']);
        $this->setDuracionTurnos($array['duracion_turnos']);
        $this->setFechaFinReserva($array['fecha_fin_reserva']); 
        $this->setMatriculaDoctor($array['matricula_doctor']); 
    }


    public function getHoraFin(){return $this->horaFin;}
    public function setHoraFin($horaFin){$this->horaFin = $horaFin;return $this;}
    public function getFechaFinReserva(){
        $fecha = new DateTime($this->fechaFinReserva);
        return $fecha->format('Y-m-d H:i:s');}
    public function setFechaFinReserva($fechaFinReserva){
        $fecha = new DateTime($fechaFinReserva);
        $this->fechaFinReserva = $fecha->format('Y-m-d H:i:s'); return $this;}
    public function getHoraInicio(){return $this->horaInicio;}
    public function setHoraInicio($horaInicio){$this->horaInicio = $horaInicio;return $this;}
    public function getDia(){return $this->dia;}
    public function setDia($dia){$this->dia = $dia;return $this;}
    public function getIdAgenda(){return $this->idAgenda;}
    public function setIdAgenda($idAgenda){$this->idAgenda = $idAgenda;return $this;}
    public function getDuracionTurnos(){return $this->duracionTurnos;}
    public function setDuracionTurnos($duracionTurnos){$this->duracionTurnos = $duracionTurnos;return $this;} 
    public function getMatriculaDoctor(){return $this->matriculaDoctor;}
    public function setMatriculaDoctor($matriculaDoctor){$this->matriculaDoctor = $matriculaDoctor;return $this;}
}
?>