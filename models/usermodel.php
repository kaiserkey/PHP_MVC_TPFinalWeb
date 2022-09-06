<?
class UserModel extends Model implements IModel{

    private $id;
    private $dni;
    private $nombre;
    private $apellido;
    private $password;
    private $direccion;
    private $celular;
    private $rol;
    private $cancelaciones;
    private $email;
    private $grupoSanguineo;
    private $sexo;
    private $fecha_nac;
    private $obra_social;

    public function __construct(){
        parent::__construct();
        $this-> id = 0;
        $this-> dni = 0;
        $this-> nombre = '';
        $this-> apellido = '';
        $this-> password = '';
        $this-> direccion = '';
        $this-> celular = '';
        $this-> rol = '';
        $this-> cancelaciones = 0;
        $this-> email = '';
        $this-> grupoSanguineo = '';
        $this-> sexo = '';
        $this->fecha_nac = '';
        $this->obra_social = '';
    }

    private function getHashedPassword($password){
        $hash = password_hash($password, PASSWORD_DEFAULT, ['cost'=>10]);
        error_log('PASSWORD HASH: el password generado es: ' . $hash);
        return $hash;
    }

    public function sabe(){
        try{
            $query = $this->prepare('INSERT INTO usuario(dni, nombre, apellido, password, direccion_usuario, celular, rol, email, sexo, fecha_nacimiento) VALUES(:dni, :nom, :ap, :pass, :dir, :cel, :rol, :email, :sexo, :fecha)');
            $query->execute([
                ':dni'=>$this->dni,
                ':nom'=>$this->nombre, 
                ':ap'=>$this->apellido, 
                ':pass'=>$this->getHashedPassword($this->password), 
                ':dir'=>$this->direccion, 
                ':cel'=>$this->celular, 
                ':rol'=>$this->rol, 
                ':email'=>$this->email, 
                ':sexo'=>$this->sexo,
                ':fecha'=>$this->fecha_nac
            ]);
            return true;
        }catch(PDOException $e){
            error_log('USERMODEL:: SABE -> PDOException ' . $e);
            return false;
        }
    }

    public function getUsuariosRiesgosos(){
        $items = [];
        try{
            $query = $this->query("SELECT dni FROM usuario WHERE cancelaciones>=3");
            
            while($point = $query->fetch(PDO::FETCH_ASSOC)){
                array_push($items, $point['dni']);
            }

            return $items;
        }catch(PDOException $e){
            error_log('USERMODEL:: GET ALL FUNCTION -> PDOException ' . $e);
            return false;
        }
    }

    public function getUsuarioByDNI($dni){
        try{
            $query = $this->prepare("SELECT nombre, apellido FROM usuario WHERE dni=:dni");
            $query -> execute([
                ':dni'=> $dni
            ]);
            $user = $query->fetch(PDO::FETCH_ASSOC);

            $this->setNombre($user['nombre']);
            $this->setApellido($user['apellido']);
            
        }catch(PDOException $e){
            error_log('USERMODEL:: GET ALL FUNCTION -> PDOException ' . $e);
            return false;
        }
    }

    public function getAllUsers(){
        $items = [];
        try{
            $query = $this->query("SELECT * FROM usuario");
            
            while($point = $query->fetch(PDO::FETCH_ASSOC)){
                
                $item = new UserModel();
                $item->setId($point['id_usuario']);
                $item->setDni($point['dni']);
                $item->setNombre($point['nombre']);
                $item->setApellido($point['apellido']);
                $item->setPassword($point['password']);
                $item->setDireccion($point['direccion_usuario']);
                $item->setCelular($point['celular']);
                $item->setRol($point['rol']);
                $item->setCancelaciones($point['cancelaciones']);
                $item->setEmail($point['email']);
                $item->setGrupoSanguineo($point['grupo_sanguineo']);
                $item->setSexo($point['sexo']);
                $item->setFechaNac($point['fecha_nacimiento']);
                $item->setObraSocial($point['obra_social']);

                array_push($items, $item);
            }
            return $items;
        }catch(PDOException $e){
            error_log('USERMODEL:: GET ALL FUNCTION -> PDOException ' . $e);
            return false;
        }
    }

    public function getAll(){
        $items = [];
        try{
            $query = $this->query("SELECT * FROM usuario WHERE rol='paciente'");
            
            while($point = $query->fetch(PDO::FETCH_ASSOC)){
                
                $item = new UserModel();
                $item->setId($point['id_usuario']);
                $item->setDni($point['dni']);
                $item->setNombre($point['nombre']);
                $item->setApellido($point['apellido']);
                $item->setPassword($point['password']);
                $item->setDireccion($point['direccion_usuario']);
                $item->setCelular($point['celular']);
                $item->setRol($point['rol']);
                $item->setCancelaciones($point['cancelaciones']);
                $item->setEmail($point['email']);
                $item->setGrupoSanguineo($point['grupo_sanguineo']);
                $item->setSexo($point['sexo']);
                $item->setFechaNac($point['fecha_nacimiento']);
                $item->setObraSocial($point['obra_social']);

                array_push($items, $item);
            }
            return $items;
        }catch(PDOException $e){
            error_log('USERMODEL:: GET ALL FUNCTION -> PDOException ' . $e);
            return false;
        }
    }

    
    
    public function get($dni){
        try{
            $query = $this->prepare("SELECT * FROM usuario WHERE dni = :dni");

            $query -> execute([
                ':dni'=> $dni
            ]);

            $user = $query->fetch(PDO::FETCH_ASSOC);

            $this->setId($user['id_usuario']);
            $this->setDni($user['dni']);
            $this->setNombre($user['nombre']);
            $this->setApellido($user['apellido']);
            $this->setPassword($user['password']);
            $this->setDireccion($user['direccion_usuario']);
            $this->setCelular($user['celular']);
            $this->setRol($user['rol']);
            $this->setCancelaciones($user['cancelaciones']);
            $this->setEmail($user['email']);
            $this->setGrupoSanguineo($user['grupo_sanguineo']);
            $this->setSexo($user['sexo']);
            $this->setFechaNac($user['fecha_nacimiento']);
            $this->setObraSocial($user['obra_social']);           

            return $this;
        }catch(PDOException $e){
            error_log('USERMODEL:: getAll -> PDOException ' . $e);
            return false;
        }
    }

    public function getUsers($dni){
        $items = [];
        try{
            $query = $this->prepare("SELECT * FROM usuario WHERE dni = :dni");

            $query -> execute([
                ':dni'=> $dni
            ]);

            while($point = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new UserModel();
                $item->setId($point['id_usuario']);
                $item->setDni($point['dni']);
                $item->setNombre($point['nombre']);
                $item->setApellido($point['apellido']);
                $item->setPassword($point['password']);
                $item->setDireccion($point['direccion_usuario']);
                $item->setCelular($point['celular']);
                $item->setRol($point['rol']);
                $item->setCancelaciones($point['cancelaciones']);
                $item->setEmail($point['email']);
                $item->setGrupoSanguineo($point['grupo_sanguineo']);
                $item->setSexo($point['sexo']);
                $item->setFechaNac($point['fecha_nacimiento']);
                $item->setObraSocial($point['obra_social']);

                array_push($items, $item);
            }          

            return $items;
        }catch(PDOException $e){
            error_log('USERMODEL:: getAll -> PDOException ' . $e);
            return false;
        }
    }

    public function getPacienteBy($dni){
        $items = [];
        try{
            $query = $this->prepare("SELECT * FROM usuario WHERE dni = :dni AND rol='paciente'");

            $query -> execute([
                ':dni'=> $dni
            ]);

            while($point = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new UserModel();
                $item->setId($point['id_usuario']);
                $item->setDni($point['dni']);
                $item->setNombre($point['nombre']);
                $item->setApellido($point['apellido']);
                $item->setPassword($point['password']);
                $item->setDireccion($point['direccion_usuario']);
                $item->setCelular($point['celular']);
                $item->setRol($point['rol']);
                $item->setCancelaciones($point['cancelaciones']);
                $item->setEmail($point['email']);
                $item->setGrupoSanguineo($point['grupo_sanguineo']);
                $item->setSexo($point['sexo']);
                $item->setFechaNac($point['fecha_nacimiento']);
                $item->setObraSocial($point['obra_social']);

                array_push($items, $item);
            }          

            return $items;
        }catch(PDOException $e){
            error_log('USERMODEL:: getAll -> PDOException ' . $e);
            return false;
        }
    }

    public function delete($id){
        try{
            $query = $this->query('DELETE FROM usuario WHERE dni = :dni');
            $query -> execute([
                ':dni'=> $id
            ]);           

            return true;
        }catch(PDOException $e){
            error_log('USERMODEL:: delete -> PDOException ' . $e);
            return false;
        }
    }
    
    public function updatePass(){
        try{ 
            $query = $this->prepare("UPDATE usuario 
                                    SET nombre=:nom, apellido=:ap, password=:pass,
                                        direccion_usuario=:dir, celular=:cel,
                                        cancelaciones=:cancel, email=:email,
                                        grupo_sanguineo=:gs, sexo=:sexo,
                                        rol=:rol, fecha_nacimiento=:fecha,
                                        obra_social=:os WHERE dni=:dni");
            $query->execute([
                ':dni'=>$this->getDni(),
                ':nom'=>$this->getNombre(), 
                ':ap'=>$this->getApellido(), 
                ':pass'=>$this->getHashedPassword($this->getPassword()), 
                ':dir'=>$this->getDireccion(), 
                ':cel'=>$this->getCelular(), 
                ':rol'=>$this->getRol(),
                ':cancel'=>$this->getCancelaciones(), 
                ':email'=>$this->getEmail(),
                ':gs'=>$this->getGrupoSanguineo(), 
                ':sexo'=>$this->getSexo(),
                ':os'=>$this->getObraSocial(),
                ':fecha'=>$this->getFechaNacBD()
            ]);
            return true;
        }catch(PDOException $e){
            error_log('USERMODEL:: UPDATE -> PDOException ' . $e);
            return false;
        }
    }

    public function update(){
        try{ 
            $query = $this->prepare("UPDATE usuario 
                                    SET nombre=:nom, apellido=:ap, password=:pass,
                                        direccion_usuario=:dir, celular=:cel,
                                        cancelaciones=:cancel, email=:email,
                                        grupo_sanguineo=:gs, sexo=:sexo,
                                        rol=:rol, fecha_nacimiento=:fecha,
                                        obra_social=:os WHERE dni=:dni");
            $query->execute([
                ':dni'=>$this->getDni(),
                ':nom'=>$this->getNombre(), 
                ':ap'=>$this->getApellido(), 
                ':pass'=>$this->getPassword(), 
                ':dir'=>$this->getDireccion(), 
                ':cel'=>$this->getCelular(), 
                ':rol'=>$this->getRol(),
                ':cancel'=>$this->getCancelaciones(), 
                ':email'=>$this->getEmail(),
                ':gs'=>$this->getGrupoSanguineo(), 
                ':sexo'=>$this->getSexo(),
                ':os'=>$this->getObraSocial(),
                ':fecha'=>$this->getFechaNacBD()
            ]);
            return true;
        }catch(PDOException $e){
            error_log('USERMODEL:: UPDATE -> PDOException ' . $e);
            return false;
        }
    }

    public function from($array){
        $this->setId($array['id_usuario']);
        $this->setDni($array['dni']);
        $this->setNombre($array['nombre']);
        $this->setApellido($array['apellido']);
        $this->setPassword($array['password']);
        $this->setDireccion($array['direccion_usuario']);
        $this->setCelular($array['celular']);
        $this->setRol($array['rol']);
        $this->setCancelaciones($array['cancelaciones']);
        $this->setEmail($array['email']);
        $this->setGrupoSanguineo($array['grupo_sanguineo']);
        $this->setSexo($array['sexo']);
        $this->setObraSocial($array['obra_social']);
        $this->setFechaNac($array['fecha_nacimiento']);
    }

    public function exist($userdni){
        try{
            $query = $this->prepare('SELECT dni FROM usuario WHERE dni=:dni');
            $query->execute([':dni'=>$userdni]);
            if($query->rowCount()>0){
                return true;
            }else{
                return false;
            }

        }catch(PDOException $e){
            error_log('USERMODEL:: EXISTS -> PDOException ' . $e);
            return false;
        }
    }

    public function comparePasswords($password, $dni){
        try{
            $user = $this->get($dni);
            return password_verify($password, $user->getPassword());
        }catch(PDOException $e){
            error_log('USERMODEL:: comparePasswords -> PDOException ' . $e);
            return false;
        }
    }
    
    public function getGrupoSanguineo(){return $this->grupoSanguineo;}
    public function setGrupoSanguineo($grupoSanguineo){$this->grupoSanguineo = $grupoSanguineo;return $this;}
    public function getSexo(){return $this->sexo;}
    public function setSexo($sexo){$this->sexo = $sexo;return $this;}
    public function getEmail(){return $this->email;}
    public function setEmail($email){$this->email = $email;return $this;}
    public function getCancelaciones(){return $this->cancelaciones;}
    public function setCancelaciones($cancelaciones){$this->cancelaciones = $cancelaciones;return $this;}
    public function getRol(){return $this->rol;}
    public function setRol($rol){$this->rol = $rol;return $this;}
    public function getCelular(){return $this->celular;}
    public function setCelular($celular){$this->celular = $celular;return $this;}
    public function getDireccion(){return $this->direccion;}
    public function setDireccion($direccion){$this->direccion = $direccion;return $this;}    
    public function getApellido(){return $this->apellido;}
    public function setApellido($apellido){$this->apellido = $apellido;return $this;}
    public function getNombre(){return $this->nombre;}
    public function setNombre($nombre){$this->nombre = $nombre;return $this;}
    public function getDni(){return $this->dni;}
    public function setDni($dni){$this->dni = $dni;return $this;}
    public function getId(){return $this->id;}
    public function setId($id){$this->id = $id;return $this;}
    public function setFechaNac($fecha_nac){$this->fecha_nac = $fecha_nac;return $this;}
    public function getFechaNac(){
        $fecha = new DateTime($this->fecha_nac);
        return $fecha->format("d/m/Y");
    }
    public function getFechaNacBD(){return $this->fecha_nac;}
    public function setObraSocial($obra_social){$this->obra_social = $obra_social;return $this;}
    public function getObraSocial(){return $this->obra_social;}
    public function getPassword(){return $this->password;}
    public function setPassword($password){$this->password = $password;return $this;}

    
}
