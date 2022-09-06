<?
    include_once('libs/imodel.php');
    class Model{
        public function __construct()
        {
            $this->db = new Database();
        }

        #creamos una funcion para generar la conexion e introducir una query
        public function query($query){
            return $this->db->connection()->query($query);
        }

        #creamos una funcion que mande a llamar al metodo prepare para consultas preparadas
        public function prepare($query){
            return $this->db->connection()->prepare($query);
        }
    }
?>