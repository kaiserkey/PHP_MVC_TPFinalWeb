<?
class ObraSocialModel extends Model implements IModel{
    private $idObraSocial;
    private $nombre;

    public function __construct(){
        parent::__construct();
        $this->idObraSocial=0;
        $this->nombre='';
    }

    public function sabe(){
        try{
            $query = $this->prepare('INSERT INTO obra_social(nombre) 
                                            VALUES:nom)');
            $query->execute([
                ':nom'=>$this->nombre
            ]);
            return true;
        }catch(PDOException $e){
            error_log('OBRASOCIALMODEL:: SABE OBRASOCIAL -> PDOException ' . $e);
            return false;
        }
    }

    public function getAll(){
        $items = [];
        try{
            $query = $this->query("SELECT * FROM obra_social");
            while($point = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new ObraSocialModel();
                $item->setIdObraSocial($point['id_obra_social']);
                $item->setNombre($point['nombre']);

                array_push($items, $item);
            }

            return $items;
        }catch(PDOException $e){
            error_log('OBRASOCIALMODEL:: GET ALL FUNCTION -> PDOException ' . $e);
            return false;
        }
    }

    public function get($idObraSocial){
        try{
            $query = $this->prepare('SELECT * FROM obra_social WHERE id_obra_social = :id');

            $query -> execute([
                ':id'=> $idObraSocial
            ]);

            $historiaClinica = $query->fetch(PDO::FETCH_ASSOC);
            $this->setIdObraSocial($historiaClinica['id_obra_social']);
            $this->setNombre($historiaClinica['nombre']);

            return $this;
        }catch(PDOException $e){
            error_log('OBRASOCIALMODEL:: getAll -> PDOException ' . $e);
            return false;
        }
    }

    public function delete($id){
        try{
            $query = $this->query('DELETE FROM obra_social WHERE id_obra_social = :id');
            $query -> execute([
                ':id'=> $id
            ]);           

            return true;
        }catch(PDOException $e){
            error_log('OBRASOCIALMODEL:: delete -> PDOException ' . $e);
            return false;
        }
    }

    public function update(){
        try{ 
            $query = $this->prepare('UPDATE obra_social 
                                    SET  nombre=:nom
                                    WHERE id_obra_social=:id');
            $query->execute([
                ':id'=>$this->idObraSocial,
                ':nom'=>$this->nombre
            ]);
            return true;
        }catch(PDOException $e){
            error_log('OBRASOCIALMODEL:: UPDATE -> PDOException ' . $e);
            return false;
        }
    }

    public function from($array){
        $this->setIdObraSocial($array['id_obra_social']);
        $this->setNombre($array['nombre']);
    }


    public function getNombre(){return $this->nombre;}
    public function setNombre($nombre){$this->nombre = $nombre;return $this;}
    public function getIdObraSocial(){return $this->idObraSocial;}
    public function setIdObraSocial($idObraSocial){$this->idObraSocial = $idObraSocial;return $this;}

}

?>