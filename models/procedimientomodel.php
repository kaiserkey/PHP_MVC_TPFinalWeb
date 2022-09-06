<?
    class ProcedimientoModel extends Model implements IModel{
        private $idProcedimiento;
        private $nombre;
        private $indicaciones;
        private $matriculaDoctor;

        public function __construct(){
            parent::__construct();
            $this->idProcedimiento=0;
            $this->nombre='';
            $this->indicaciones='';
            $this->matriculaDoctor=0;
        }

        public function getAllProcedimientosByNombre(){
            $items = [];
            try{
                $query = $this->query("SELECT DISTINCT nombre FROM procedimiento");
                
                while($point = $query->fetch(PDO::FETCH_ASSOC)){
                    $item = new ProcedimientoModel();
                    $item->setNombre($point['nombre']);

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
                $query = $this->prepare('INSERT INTO procedimiento(nombre, indicaciones, matricula_doctor) 
                                                VALUES(:nom, :ind, :md)');
                $query->execute([
                    ':nom'=>$this->nombre, 
                    ':ind'=>$this->indicaciones,
                    ':md'=>$this->matriculaDoctor
                ]);
                return true;
            }catch(PDOException $e){
                error_log('PROCEDIMIENTOMODEL:: SABE PROCEDIMIENTO -> PDOException ' . $e);
                return false;
            }
        }

        public function getAll(){
            $items = [];
            try{
                $query = $this->query("SELECT * FROM procedimiento");
                
                while($point = $query->fetch(PDO::FETCH_ASSOC)){
                    $item = new ProcedimientoModel();
                    $item->setIdProcedimiento($point['id_procedimiento']);
                    $item->setNombre($point['nombre']);
                    $item->setIndicaciones($point['indicaciones']);
                    $item->setMatriculaDoctor($point['matricula_doctor']);

                    array_push($items, $item);
                }
                return $items;
            }catch(PDOException $e){
                error_log('DOCTORMODEL:: GET ALL FUNCTION -> PDOException ' . $e);
                return false;
            }
        }

        public function getAllBy($matriculaDoc){
            $items = [];
            try{
                $query = $this->prepare("SELECT * FROM procedimiento WHERE matricula_doctor = :md");
                $query -> execute([
                    ':md'=> $matriculaDoc
                ]);
                while($point = $query->fetch(PDO::FETCH_ASSOC)){
                    $item = new ProcedimientoModel();
                    $item->setIdProcedimiento($point['id_procedimiento']);
                    $item->setNombre($point['nombre']);
                    $item->setIndicaciones($point['indicaciones']);
                    $item->setMatriculaDoctor($point['matricula_doctor']);

                    array_push($items, $item);
                }
                return $items;
            }catch(PDOException $e){
                error_log('DOCTORMODEL:: GET ALL FUNCTION -> PDOException ' . $e);
                return false;
            }
        }

        public function get($matriculaDoc){
            try{
                $query = $this->prepare('SELECT * FROM procedimiento WHERE matricula_doctor = :md');
    
                $query -> execute([
                    ':md'=> $matriculaDoc
                ]);
    
                $doctor = $query->fetch(PDO::FETCH_ASSOC);
                $this->setIdProcedimiento($doctor['id_procedimiento']);
                $this->setNombre($doctor['nombre']);
                $this->setIndicaciones($doctor['indicaciones']);
                $this->setMatriculaDoctor($doctor['matricula_doctor']);
    
                return $this;
            }catch(PDOException $e){
                error_log('PROCEDIMIENTOMODEL:: getAll -> PDOException ' . $e);
                return false;
            }
        }

        public function delete($id){
            try{
                $query = $this->query('DELETE FROM procedimiento WHERE id_procedimiento = :id');
                $query -> execute([
                    ':id'=> $id
                ]);           
    
                return true;
            }catch(PDOException $e){
                error_log('PROCEDIMIENTOMODEL:: delete -> PDOException ' . $e);
                return false;
            }
        }

        public function update(){
            try{ 
                $query = $this->prepare('UPDATE procedimiento 
                                        SET nombre=:nom,
                                            indicaciones=:ind, 
                                            matricula_doctor=:md
                                        WHERE id_procedimiento=:id');
                $query->execute([ 
                    ':id'=>$this->idProcedimiento,
                    ':nom'=>$this->nombre,
                    ':ind'=>$this->indicaciones,
                    ':md'=>$this->matriculaDoctor
                ]);
                return true;
            }catch(PDOException $e){
                error_log('PROCEDIMIENTOMODEL:: UPDATE -> PDOException ' . $e);
                return false;
            }
        }

        public function from($array){
            $this->setIdProcedimiento($array['id_procedimiento']);
            $this->setNombre($array['nombre']);
            $this->setIndicaciones($array['indicaciones']);
            $this->setMatriculaDoctor($array['matricula_doctor']);
        }

        public function getNombre(){return $this->nombre;} 
        public function setNombre($nombre){$this->nombre = $nombre;return $this;}
        public function getIndicaciones(){return $this->indicaciones;}
        public function setIndicaciones($indicaciones){$this->indicaciones = $indicaciones;return $this;}
        public function getIdProcedimiento(){return $this->idProcedimiento;}
        public function setIdProcedimiento($idProcedimiento){$this->idProcedimiento = $idProcedimiento;return $this;}
        public function getMatriculaDoctor(){return $this->matriculaDoctor;}
        public function setMatriculaDoctor($matriculaDoctor){$this->matriculaDoctor = $matriculaDoctor;return $this;}
    }
?>