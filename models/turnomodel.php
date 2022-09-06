<?
require_once("models/doctormodel.php");
class TurnoModel extends Model implements IModel{
    private $idTurno;
    private $dniPaciente;
    private $hora;
    private $fechaTurno;
    private $fechaRegistro;
    private $estado;
    private $matriculaDoctor;
    private $tipoTurno;

    public function __construct()
    {
        parent::__construct();
        $this->idTurno = 0;
        $this->dniPaciente = 0;
        $this->hora = '';
        $this->fechaTurno = '';
        $this->fechaRegistro = '';
        $this->estado = '';
        $this->matriculaDoctor = 0;
        $this->tipoTurno = '';
    }

    

    public function getAllFechas(){
        $items = [];
        try{
            $query = $this->query("SELECT hora, fecha_turno FROM turno");
            while($point = $query->fetch(PDO::FETCH_ASSOC)){                
                $item = new DateTime($point['fecha_turno'] . ' ' . $point['hora']);
                array_push($items, $item->format('m/d/Y H:i:s'));
            }
            return $items;
        }catch(PDOException $e){
            error_log('TURNOMODEL:: GET ALL FUNCTION -> PDOException ' . $e);
            return false;
        }
    }

    public function getIfExistDoctorNombre($matricula){
        $doctorNombre = new DoctorModel();
        $doctorNombre->getNombreDoctorByMatricula($matricula);
        return $doctorNombre->getNombre()==null || $doctorNombre->getNombre()=='' ? '-':$doctorNombre->getNombre();
    }

    public function getIfExistTurno($dni){
        $turnos = [];
        try{
            $query = $this->prepare('SELECT * FROM turno WHERE dni_paciente = :dni');
            $query->execute([
                ':dni'=>$dni
            ]);

            while($point = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new TurnoModel();
                $item->setIdTurno($point['id_turno']);
                $item->setDniPaciente($point['dni_paciente']);
                $item->setFechaTurno($point['fecha_turno']);
                $item->setFechaRegistro($point['fecha_registro']);
                $item->setHora($point['hora']);
                $item->setEstado($point['estado']);
                $item->setMatriculaDoctor($point['matricula_doctor']);
                $item->setTipoTurno($point['tipo_turno']);
                array_push($turnos, $item);
            }
            return $turnos;
        }catch(PDOException $e){
            error_log('TURNOMODEL:: getIfExistTurno -> PDOException ' . $e);
            return false;
        }
    }

    public function sabe(){
        try{
            $query = $this->prepare('INSERT INTO turno(dni_paciente, hora, fecha_turno, fecha_registro, estado, matricula_doctor, tipo_turno) 
                                            VALUES(:dni, :hr, :ft, :fr, :est, :md, :tt)');
            $query->execute([
                ':dni'=>$this->dniPaciente,
                ':hr'=>$this->hora, 
                ':ft'=>$this->fechaTurno, 
                ':fr'=>$this->fechaRegistro,
                ':est'=>'Pendiente',
                ':md'=>$this->matriculaDoctor,
                ':tt'=>$this->tipoTurno
            ]);
            return true;
        }catch(PDOException $e){
            error_log('TURNOMODEL:: SABE TURNO -> PDOException ' . $e);
            return false;
        }
    }

    public function getAllPendiente(){
        $items = [];
        try{
            $query = $this->query("SELECT * FROM turno WHERE estado = 'Pendiente'");
            
            while($point = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new TurnoModel();
                $item->setIdTurno($point['id_turno']);
                $item->setDniPaciente($point['dni_paciente']);
                $item->setFechaTurno($point['fecha_turno']);
                $item->setFechaRegistro($point['fecha_registro']);
                $item->setHora($point['hora']);
                $item->setEstado($point['estado']);
                $item->setMatriculaDoctor($point['matricula_doctor']);
                $item->setTipoTurno($point['tipo_turno']);

                array_push($items, $item);
            }
            return $items;
        }catch(PDOException $e){
            error_log('TURNOMODEL:: GET ALL FUNCTION -> PDOException ' . $e);
            return false;
        }
    }

    public function getAll(){
        $items = [];
        try{
            $query = $this->query("SELECT * FROM turno");
            
            while($point = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new TurnoModel();
                $item->setIdTurno($point['id_turno']);
                $item->setDniPaciente($point['dni_paciente']);
                $item->setFechaTurno($point['fecha_turno']);
                $item->setFechaRegistro($point['fecha_registro']);
                $item->setHora($point['hora']);
                $item->setEstado($point['estado']);
                $item->setMatriculaDoctor($point['matricula_doctor']);
                $item->setTipoTurno($point['tipo_turno']);

                array_push($items, $item);
            }
            return $items;
        }catch(PDOException $e){
            error_log('TURNOMODEL:: GET ALL FUNCTION -> PDOException ' . $e);
            return false;
        }
    }

    public function get($idTurno){
        try{
            error_log('TURNOMODEL:: el id que se va a validar es:  ' . $idTurno);
            $query = $this->prepare('SELECT * FROM turno WHERE id_turno = :id');

            $query -> execute([
                ':id'=> $idTurno
            ]);

            $turno = $query->fetch(PDO::FETCH_ASSOC);
            $this->setIdTurno($turno['id_turno']);
            $this->setDniPaciente($turno['dni_paciente']);
            $this->setFechaTurno($turno['fecha_turno']);
            $this->setFechaRegistro($turno['fecha_registro']);
            $this->setHora($turno['hora']);
            $this->setEstado($turno['estado']);
            $this->setMatriculaDoctor($turno['matricula_doctor']);
            $this->setTipoTurno($turno['tipo_turno']);

            return $this;
        }catch(PDOException $e){
            error_log('TURNOMODEL:: getAll -> PDOException ' . $e);
            return false;
        }
    }

    public function delete($id){
        try{
            $query = $this->query('DELETE FROM turno WHERE id_turno = :id');
            $query -> execute([
                ':id'=> $id
            ]);           

            return true;
        }catch(PDOException $e){
            error_log('TURNOMODEL:: delete -> PDOException ' . $e);
            return false;
        }
    }

    public function update(){
        try{ 
            $query = $this->prepare('UPDATE turno 
                                    SET dni_paciente=:dni, hora=:hr, fecha_turno=:ft, 
                                        fecha_registro=:fr, estado=:est, tipo_turno=:tt, matricula_doctor=:md 
                                    WHERE id_turno=:id');
            $query->execute([
                ':id'=>$this->getIdTurno(),
                ':dni'=>$this->getDniPaciente(),
                ':hr'=>$this->getHoraBD(), 
                ':ft'=>$this->getFechaTurnoBD(), 
                ':fr'=>$this->getFechaRegistroBD(),
                ':est'=>$this->getEstado(),
                ':tt'=>$this->getTipoTurno(),
                ':md'=>$this->getMatriculaDoctor()
            ]);
            return true;
        }catch(PDOException $e){
            error_log('TURNOMODEL:: UPDATE -> PDOException ' . $e);
            return false;
        }
    }

    public function from($array){
        $this->setIdTurno($array['id_turno']);
        $this->setDniPaciente($array['dni_paciente']);
        $this->setFechaTurno($array['fecha_turno']);
        $this->setFechaRegistro($array['fecha_registro']);
        $this->setHora($array['hora']);
        $this->setEstado($array['estado']);
        $this->setMatriculaDoctor($array['matricula_doctor']);
        $this->setTipoTurno($array['tipo_turno']);  
    }

    
    public function getEstado(){return $this->estado;}
    public function setEstado($estado){$this->estado = $estado;return $this;}
    public function getFechaRegistro(){
        $fecha = new DateTime($this->fechaRegistro);
        return $fecha->format("d/m/Y");}
    public function getFechaRegistroBD(){return $this->fechaRegistro;}
    public function setFechaRegistro($fechaRegistro){$this->fechaRegistro = $fechaRegistro;return $this;}
    public function getFechaTurno(){
        $fecha = new DateTime($this->fechaTurno);
        return $fecha->format("d/m/Y");}
    public function getFechaTurnoBD(){return $this->fechaTurno;}
    public function setFechaTurno($fechaTurno){$this->fechaTurno = $fechaTurno;return $this;}
    public function getHoraBD(){return $this->hora;}
    public function getHora(){
        $fecha = new DateTime($this->hora);
        return $fecha->format("H:i:s:A");}
    public function setHora($hora){$this->hora = $hora;return $this;}
    public function getDniPaciente(){return $this->dniPaciente;}
    public function setDniPaciente($dniPaciente){$this->dniPaciente = $dniPaciente;return $this;} 
    public function getIdTurno(){return $this->idTurno;}
    public function setIdTurno($idTurno){$this->idTurno = $idTurno;return $this;}
    public function getTipoTurno(){return $this->tipoTurno;}
    public function setTipoTurno($tipoTurno){$this->tipoTurno = $tipoTurno;return $this;}
    public function getMatriculaDoctor(){return $this->matriculaDoctor;}
    public function setMatriculaDoctor($matriculaDoctor){$this->matriculaDoctor = $matriculaDoctor;return $this;}

}
?>