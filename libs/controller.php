<?
#estructura basica de la aplicacion

class Controller{
    public function __construct()
    {
        #cargamos la vista que vamos a presentar
        $this->view = new View();
    }

    #carga el archivo modelo del controlador asociado
    public function loadModel($model){
        #construimos la url del archivo a cargar
        $url = 'models/' . $model . 'model.php';
        #validamos que existe el archivo y lo mandamos a llamar
        if(file_exists($url)){
            require_once($url);
            #aqui mandamos a crear los objetos de la distintas clases que tiene nuestro modelo
            $modelName = $model.'Model';
            $this->model = new $modelName();
        }
    }

    /**
     * cuando recibimos parametros para la base de datos
     * utilizamos esta funcion para poder simplificar el uso de isset
     * */
    public function existPOST($params){
        foreach($params as $param){
            if(!isset($_POST[$param])){
                error_log('Error: CONTROLLER -> existPOST -> No existe el parametro POST');
                return false;
            }
        }
        return true;
    }

    public function existGET($params){
        foreach($params as $param){
            if(!isset($_GET[$param])){
                error_log('Error: CONTROLLER -> existPOST -> No existe el parametro GET');
                return false;
            }
        }
        return true;
    }

    #para simplificar el uso de _GET y _POST
    public function getGet($name){
        return $_GET[$name];
    }

    public function getPost($name){
        return $_POST[$name];
    }

    #redirige la pagina cuando tenemos un error o un problema al realizar alguna solicitud
    function redirect($route, $mensajes = []){
        $data = [];
        $params = '';
        
        #insertamos los mensajes al arreglo
        foreach ($mensajes as $key => $value) {
            array_push($data, $key . '=' . $value);
        }
        $params = join('&', $data);
        
        //?nombre=Daniel&apellido=Gonzalez
        if($params != ''){
            $params = '?' . $params;
        }
        #le inyectamos el mensaje a la vista para que pueda toamr esa url y mostrarlo
        header('Location: ' . constant('URL') . $route . $params);
    }

}
?>