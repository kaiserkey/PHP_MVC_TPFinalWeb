<?
require_once("models/doctormodel.php");
class HistoriaClinicaModel extends Model implements IModel{
    private $idHistoriaClinica;
    private $especializacion;
    private $idPaciente;
    private $fecha;
    private $doctorMatricula;

    public function __construct(){
        parent::__construct();
        $this->idHistoriaClinica=0;
        $this->especializacion='';
        $this->idPaciente=0;
        $this->fecha='';
        $this->doctorMatricula=0;
    }

    public function getIfExistDoctorNombre($matricula){
        $doctorNombre = new DoctorModel();
        $doctorNombre->getNombreDoctorByMatricula($matricula);
        return $doctorNombre->getNombre()==null || $doctorNombre->getNombre()=='' ? '-':$doctorNombre->getNombre();
    }

    public function getAllById($dni){
        error_log('El dni recibido es: ' . $dni);
        $items = [];
        try{
            $query = $this->prepare("SELECT * FROM historia_clinica WHERE id_paciente = :id");
            $query->execute([
                ':id'=>$dni
            ]);
            
            while($point = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new HistoriaClinicaModel();
                $item->setIdHistoriaClinica($point['id_historia_clinica']);
                $item->setEspecializacion($point['especializacion']);
                $item->setIdPaciente($point['id_paciente']);
                $item->setFecha($point['fecha']);
                $item->setDoctorMatricula($point['matricula_doctor']);

                array_push($items, $item);
            }

            return $items;
        }catch(PDOException $e){
            error_log('HISTORIACLINICAMODEL:: GET ALL FUNCTION -> PDOException ' . $e);
            return false;
        }
    }

    public function sabe(){
        try{
            $query = $this->prepare('INSERT INTO historia_clinica(especializacion, id_paciente, fecha, matricula_doctor) 
                                            VALUES(:esp, :idp, :fec, :md)');
            error_log('HISTORIACLINICAMODEL:: SABE HISTORIACLINICA -> Se ejecuto la consulta');
            $query->execute([
                ':esp'=>$this->especializacion,
                ':idp'=>$this->idPaciente,
                ':fec'=>$this->fecha,
                ':md'=>$this->doctorMatricula 
            ]);
            return true;
        }catch(PDOException $e){
            error_log('HISTORIACLINICAMODEL:: SABE HISTORIACLINICA -> PDOException ' . $e);
            return false;
        }
    }

    public function getAll(){
        $items = [];
        try{
            $query = $this->query("SELECT * FROM historia_clinica");
            error_log('GET ALL FUNCTION HISTORIACLINICA: datos obtenidos del query: ' . $query);
            while($point = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new HistoriaClinicaModel();
                $item->setIdHistoriaClinica($point['id_historia_clinica']);
                $item->setEspecializacion($point['especializacion']);
                $item->setIdPaciente($point['id_paciente']);
                $this->setFecha($point['fecha']);
                $this->setDoctorMatricula($point['matricula_doctor']);

                array_push($items, $item);
            }

            return $items;
        }catch(PDOException $e){
            error_log('HISTORIACLINICAMODEL:: GET ALL FUNCTION -> PDOException ' . $e);
            return false;
        }
    }

    public function get($idHistoriaClinica){
        try{
            error_log('HISTORIACLINICAMODEL:: el id que se va a validar es:  ' . $idHistoriaClinica);
            $query = $this->prepare('SELECT * FROM historia_clinica WHERE id_historia_clinica = :id');

            $query -> execute([
                ':id'=> $idHistoriaClinica
            ]);

            $historiaClinica = $query->fetch(PDO::FETCH_ASSOC);
            $this->setIdHistoriaClinica($historiaClinica['id_historia_clinica']);
            $this->setEspecializacion($historiaClinica['especializacion']);
            $this->setIdPaciente($historiaClinica['id_paciente']);
            $this->setFecha($historiaClinica['fecha']);
            $this->setDoctorMatricula($historiaClinica['matricula_doctor']);

            return $this;
        }catch(PDOException $e){
            error_log('HISTORIACLINICAMODEL:: getAll -> PDOException ' . $e);
            return false;
        }
    }

    public function delete($id){
        try{
            $query = $this->query('DELETE FROM historia_clinica WHERE id_historia_clinica = :id');
            $query -> execute([
                ':id'=> $id
            ]);           

            return true;
        }catch(PDOException $e){
            error_log('HISTORIACLINICAMODEL:: delete -> PDOException ' . $e);
            return false;
        }
    }

    public function update(){
        try{ 
            $query = $this->prepare('UPDATE historia_clinica 
                                    SET  especializacion=:esp, id_paciente=:idp, 
                                        fecha=:fec, matricula_doctor=:md
                                    WHERE id_historia_clinica=:id');
            $query->execute([
                ':id'=>$this->idHistoriaClinica,
                ':esp'=>$this->especializacion, 
                ':idp'=>$this->idPaciente,
                ':fec'=>$this->fecha,
                ':md'=>$this->doctorMatricula
            ]);
            return true;
        }catch(PDOException $e){
            error_log('HISTORIACLINICAMODEL:: UPDATE -> PDOException ' . $e);
            return false;
        }
    }

    public function from($array){
        error_log('HISTORIACLINICAMODEL: ENTRANDO FUNCION FROM -> ' . $array['id_historia_clinica']);
        $this->setIdHistoriaClinica($array['id_historia_clinica']);
        $this->setIdPaciente($array['id_paciente']);
        $this->setEspecializacion($array['especializacion']);
        $this->setFecha($array['fecha']);
        $this->setDoctorMatricula($array['matricula_doctor']);
    }


    public function getIdPaciente(){return $this->idPaciente;}
    public function setIdPaciente($idPaciente){$this->idPaciente = $idPaciente;return $this;}
    public function getEspecializacion(){return $this->especializacion;}
    public function setEspecializacion($especializacion){$this->especializacion = $especializacion;return $this;}
    public function getIdHistoriaClinica(){return $this->idHistoriaClinica;}
    public function setIdHistoriaClinica($idHistoriaClinica){$this->idHistoriaClinica = $idHistoriaClinica;return $this;}
    public function getFecha(){
        $fecha = new DateTime($this->fecha);
        return $fecha->format("d/m/Y");}
    public function getFechaBD(){return $this->fecha;}
    public function setFecha($fecha){$this->fecha = $fecha;return $this;}
    public function getDoctorMatricula(){return $this->doctorMatricula;}
    public function setDoctorMatricula($doctorMatricula){$this->doctorMatricula = $doctorMatricula;return $this;}
}

?>