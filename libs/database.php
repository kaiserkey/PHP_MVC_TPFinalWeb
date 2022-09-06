<?

class Database{
    protected $host;
    protected $db;
    protected $user;
    protected $pass;
    protected $charset;

    public function __construct()
    {
        $this->host=constant('HOST');
        $this->db=constant('DB');
        $this->user=constant('USER');
        $this->pass=constant('PASS');
        $this->charset=constant('CHARSET');
    }
    #funcion para conectarnos a la base de datos la cual nos regresa un objeto con la conexion
    public function connection(){
        try{
            $this->conexion_db = new PDO("mysql:host=".$this->host."; dbname=".$this->db, $this->user, $this->pass);
            $this->conexion_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conexion_db->exec("SET CHARACTER SET ".$this->charset);
            
            return $this->conexion_db;

        }catch(PDOException $e){ 
            return "ERROR: No se puede conectar a la base de datos...". $e->getMessage();
        }
    }
}

?>