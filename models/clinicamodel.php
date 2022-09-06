<?
class Clinica extends Model implements IModel{
    private $idClinica;
    private $nombre;
    private $direccionSede;
    private $email;
    private $localidad;
    private $telefono;

    public function __construct(){
        parent::__construct();
        $this->id_clinica=0;
        $this->nombre='';
        $this->direccion_sede='';
        $this->email='';
        $this->localidad='';
    }

    public function sabe(){
        try{
            $query = $this->prepare('INSERT INTO clinica(nombre, direccion_sede) 
                                            VALUES(:nom, :dir)');
            error_log('CLINICAMODEL:: SABE CLINICA -> Se ejecuto la consulta');
            $query->execute([
                ':nom'=>$this->nombre,
                ':dir'=>$this->direccionSede, 
            ]);
            return true;
        }catch(PDOException $e){
            error_log('CLINICAMODEL:: SABE CLINICA -> PDOException ' . $e);
            return false;
        }
    }

    public function getClinicasIDs(){
        $items = [];
        try{
            $query = $this->query("SELECT * FROM clinica");
            while($point = $query->fetch(PDO::FETCH_ASSOC)){
                $items[$point['id_clinica']] = $point['nombre'];
            }
            return $items;
        }catch(PDOException $e){
            error_log('CLINICAMODEL:: GET ALL FUNCTION -> PDOException ' . $e);
            return false;
        }
    }

    public function getAll(){
        $items = [];
        try{
            $query = $this->query("SELECT * FROM clinica");
            while($point = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new Clinica();
                $item->setIdClinica($point['id_clinica']);
                $item->setNombre($point['nombre']);
                $item->setDireccionSede($point['direccion_sede']);

                array_push($items, $item);
            }

            return $items;
        }catch(PDOException $e){
            error_log('CLINICAMODEL:: GET ALL FUNCTION -> PDOException ' . $e);
            return false;
        }
    }

    public function get($idClinica){
        try{
            $query = $this->prepare('SELECT * FROM clinica WHERE id_clinica = :id');

            $query -> execute([
                ':id'=> $idClinica
            ]);

            $clinica = $query->fetch(PDO::FETCH_ASSOC);
            $this->setIdClinica($clinica['id_clinica']);
            $this->setNombre($clinica['nombre']);
            $this->setDireccionSede($clinica['direccion_sede']);
            $this->setEmail($clinica['email']);
            $this->setLocalidad($clinica['localidad']);
            $this->setTelefono($clinica['telefono']);

            return $this;
        }catch(PDOException $e){
            error_log('CLINICAMODEL:: getAll -> PDOException ' . $e);
            return false;
        }
    }
    
    public function delete($id){
        try{
            $query = $this->query('DELETE FROM clinica WHERE id_clinica = :id');
            $query -> execute([
                ':id'=> $id
            ]);           

            return true;
        }catch(PDOException $e){
            error_log('CLINICAMODEL:: delete -> PDOException ' . $e);
            return false;
        }
    }

    public function update(){
        try{ 
            $query = $this->prepare('UPDATE clinica 
                                    SET  nombre=:nom, direccion_sede=:dir
                                    WHERE id_clinica=:id');
            $query->execute([
                ':id'=>$this->idClinica,
                ':nom'=>$this->nombre, 
                ':dir'=>$this->direccionSede
            ]);
            return true;
        }catch(PDOException $e){
            error_log('CLINICAMODEL:: UPDATE -> PDOException ' . $e);
            return false;
        }
    }

    public function from($array){
        $this->setIdClinica($array['id_clinica']);
        $this->setNombre($array['nombre']);
        $this->setDireccionSede($array['direccion_sede']);
    }


    public function getIdClinica(){return $this->id_clinica;}
    public function setIdClinica($id_clinica){$this->id_clinica = $id_clinica;return $this;}
    public function getNombre(){return $this->nombre;}
    public function setNombre($nombre){$this->nombre = $nombre;return $this;}
    public function getDireccionSede(){return $this->direccion_sede;}
    public function setDireccionSede($direccion_sede){$this->direccion_sede = $direccion_sede;return $this;}
    public function getEmail(){return $this->email;}
    public function setEmail($email){$this->email = $email;return $this;}
    public function getLocalidad(){return $this->localidad;}
    public function setLocalidad($localidad){$this->localidad = $localidad;return $this;}
    public function getTelefono(){return $this->telefono;}
    public function setTelefono($telefono){$this->telefono = $telefono;return $this;}
}
?>