<?
class DoctorModel extends Model implements IModel{
    private $idDoctor;
    private $idClinica;
    private $nombre;
    private $matricula;
    private $especializacion;
    private $localidad;

    public function __construct()
    {
        parent::__construct();
    }

    public function getNombreDoctorByMatricula($matricula){
        try{
            $query = $this->prepare('SELECT DISTINCT(nombre) FROM doctor WHERE matricula= :id');

            $query -> execute([
                ':id'=> $matricula
            ]);

            $doctor = $query->fetch(PDO::FETCH_ASSOC);
            $this->setNombre($doctor['nombre']);          

            return $this;
        }catch(PDOException $e){
            error_log('DOCTORMODEL:: getAll -> PDOException ' . $e);
            return false;
        }
    }

    public function getAllNombreDoctorByEspecializacion(){
        $items = [];
        try{
            $query = $this->query("SELECT DISTINCT especializacion FROM doctor");
            
            while($point = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new DoctorModel();
                $item->setEspecializacion($point['especializacion']);
                array_push($items, $item);
            }
            return $items;
        }catch(PDOException $e){
            error_log('DOCTORMODEL:: GET ALL FUNCTION -> PDOException ' . $e);
            return false;
        }
    }

    public function sabe(){
        try{
            $query = $this->prepare('INSERT INTO doctor(id_clinica, nombre, matricula, especializacion, localidad) 
                                            VALUES(:idc, :nom, :mat, :esp, :loc)');
            $query->execute([
                ':idc'=>$this->idClinica,
                ':nom'=>$this->nombre, 
                ':mat'=>$this->matricula,
                ':esp'=>$this->especializacion,
                ':loc'=>$this->localidad
            ]);
            return true;
        }catch(PDOException $e){
            error_log('DOCTORMODEL:: SABE DOCTOR -> PDOException ' . $e);
            return false;
        }
    }

    public function getAll(){
        $items = [];
        try{
            $query = $this->query("SELECT * FROM doctor");
            
            while($point = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new DoctorModel();
                $item->setIdDoctor($point['id_doctor']);
                $item->setIdClinica($point['id_clinica']);
                $item->setNombre($point['nombre']);
                $item->setMatricula($point['matricula']);
                $item->setEspecializacion($point['especializacion']);
                $item->setLocalidad($point['localidad']);
                array_push($items, $item);
            }
            return $items;
        }catch(PDOException $e){
            error_log('DOCTORMODEL:: GET ALL FUNCTION -> PDOException ' . $e);
            return false;
        }
    }

    public function getAllBy($matricula){
        $items = [];
        try{
            $query = $this->prepare("SELECT * FROM doctor WHERE matricula = :mt");
            $query -> execute([
                ':mt'=> $matricula
            ]);

            while($point = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new DoctorModel();
                $item->setIdDoctor($point['id_doctor']);
                $item->setIdClinica($point['id_clinica']);
                $item->setNombre($point['nombre']);
                $item->setMatricula($point['matricula']);
                $item->setEspecializacion($point['especializacion']);
                $item->setLocalidad($point['localidad']);
                array_push($items, $item);
            }
            return $items;
        }catch(PDOException $e){
            error_log('DOCTORMODEL:: GET ALL FUNCTION -> PDOException ' . $e);
            return false;
        }
    }


    public function get($matricula){
        try{
            $query = $this->prepare('SELECT * FROM doctor WHERE matricula = :mt');

            $query -> execute([
                ':mt'=> $matricula
            ]);

            $doctor = $query->fetch(PDO::FETCH_ASSOC);
            $this->setIdDoctor($doctor['id_doctor']);
            $this->setIdClinica($doctor['id_clinica']);
            $this->setNombre($doctor['nombre']);
            $this->setMatricula($doctor['matricula']);
            $this->setEspecializacion($doctor['especializacion']);
            $this->setLocalidad($doctor['localidad']);           

            return $this;
        }catch(PDOException $e){
            error_log('DOCTORMODEL:: getAll -> PDOException ' . $e);
            return false;
        }
    }

    public function delete($id){
        try{
            $query = $this->query('DELETE FROM doctor WHERE id_doctor = :id');
            $query -> execute([
                ':id'=> $id
            ]);           

            return true;
        }catch(PDOException $e){
            error_log('DOCTORMODEL:: delete -> PDOException ' . $e);
            return false;
        }
    }

    public function update(){
        try{ 
            $query = $this->prepare('UPDATE doctor 
                                    SET id_clinica=:idc, nombre=:nom, matricula=:mat, especializacion=:esp, localidad=:loc 
                                    WHERE id_doctor=:id');
            $query->execute([
                ':id'=>$this->idDoctor,
                ':idc'=>$this->idClinica,
                ':nom'=>$this->nombre, 
                ':mat'=>$this->matricula,
                ':esp'=>$this->especializacion,
                ':loc'=>$this->localidad
            ]);
            return true;
        }catch(PDOException $e){
            error_log('AGENDA MODEL:: UPDATE -> PDOException ' . $e);
            return false;
        }
    }

    public function from($array){
        $this->setIdDoctor($array['id_doctor']);
        $this->setIdClinica($array['id_clinica']);
        $this->setNombre($array['nombre']);
        $this->setMatricula($array['matricula']);
        $this->setEspecializacion($array['especializacion']); 
        $this->setLocalidad($array['localidad']); 
    }

    public function getEspecializacion(){return $this->especializacion;}
    public function setEspecializacion($especializacion){$this->especializacion = $especializacion;return $this;}
    public function getMatricula(){return $this->matricula;}
    public function setMatricula($matricula){$this->matricula = $matricula;return $this;}
    public function getNombre(){return $this->nombre;}
    public function setNombre($nombre){$this->nombre = $nombre;return $this;}
    public function getIdClinica(){return $this->idClinica;}
    public function setIdClinica($idClinica){$this->idClinica = $idClinica;return $this;}
    public function getIdDoctor(){return $this->idDoctor;}
    public function setIdDoctor($idDoctor){$this->idDoctor = $idDoctor;return $this;}
    public function getLocalidad(){return $this->localidad;}
    public function setLocalidad($localidad){$this->localidad = $localidad;return $this;}
}
?>