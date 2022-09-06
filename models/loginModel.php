<?
require_once('models/usermodel.php');
class LoginModel extends Model{
    public function __construct()
    {
        parent::__construct();
    }

    public function login($dni, $password){
        // insertar datos en la BD
        error_log("login: inicio del loginmodel");
        try{
            $query = $this->prepare('SELECT * FROM usuario WHERE dni = :dni');
            $query->execute([':dni' => $dni]);
            
            if($query->rowCount() == 1){
                $item = $query->fetch(PDO::FETCH_ASSOC); 
                $user = new UserModel();
                $user->from($item);

                error_log('login: usuario ingresado ' . $dni);
                error_log('login: password ingresado ' . $password);
                error_log('login: db user dni '.$user->getDni());
                error_log('login: db password ' . $user->getPassword());
                

                //$hash = password_hash($password, PASSWORD_DEFAULT, ['cost'=>10]);
                // $hash = '$2y$10$MVXtnY3JfUwY84b5ay1py.B.yXpz.SAFPc7u6moEK1O0IhyZrA1Z2';
                // $valor = password_verify(123, $hash);
                // error_log('login: password_verify ' . $valor);
                
                //verifica si el password corresponde con el hash de la BBDD
                if(password_verify($password, $user->getPassword())){
                    error_log('login: password coincide');
                    return $user;//regresamos el usuario solicitado
                }else{
                    return NULL;
                }
            }
        }catch(PDOException $e){
            return NULL;
        }
    }
}
?>