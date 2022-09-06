<?
    /**
     * Estructura base del ruteo de las url que el usuario ingresa en el navegador
     * Aqui hacemos que todas las solicitudes que se mandan por la url
     * Se comprueben y se mandan al controlador especificado
     * En caso de que no se especifica ningun controlador de manda a llamar el login
     * Si existe el controlador comprueba que exista el archivo, luego llama el modelo y el metodo
     * Si existe el metodo vemos si hay parametros especificados en la url
     * Si existen los parametros se inyectan en el metodo
     **/
    require_once('controllers/errores.php');
    class App{

        public function __construct()
        {
            #la url la recibimos por medio del la configuracion del archivo .HTACCESS
            #validamos que exista una url si existe le asignamos a nuestra variable
            $url = isset($_GET['url']) ? $_GET['url'] : null;
            #borramos cualquier diagonal que se encuentre al final de la url
            $url = rtrim($url, '/');
            #dividimos la url en un arreglo que lo separa por cada diagonal "/"
            $url = explode('/' , $url);# /clase/metodo

            /**
             * URL[0,1,2]
             * controlador->[0]
             * metodo->[1]
             * parameter->[2]
            */
            
            #Redirigimos la pagina al login si no existe ninguna url
            if(empty($url[0])){
                error_log('APP::construct-> no hay controlador especificado');
                #mandamos a llamar al controlador
                $archivoController = 'controllers/login.php';
                #requerimos el archivo del controlador
                require_once($archivoController);
                #creamos un nuevo objeto del controlador
                $controller = new Login();
                #cargamos el modelo del controlador
                $controller->loadModel('login');
                #renderizamos la vista
                $controller->render();

                return FALSE;
            }

            #Si trae un controlador especificado vamos a hacer referencia a ese archivo
            $archivoController = 'controllers/' . $url[0] . '.php';
            #revisamos si existe ese archivo para mandar a llamarlo
            
            if(file_exists($archivoController)){
                require_once($archivoController);
                #creamos un nuevo objeto de ese controlador pasado por la url
                $controller = new $url[0];
                #cargamos el modelo del controlador
                $controller->loadModel($url[0]);
                #utilizamos el indice 1 de la url para cargar los metodos de la clase
                if(isset($url[1])){
                    #si existe el metodo validamos que exista dentro de la clase
                    if(method_exists($controller, $url[1])){
                        /**
                         * comprobamos que existe un metodo que viene en la url
                         * comprobamos si existe un tercer parametro dentro de la url
                         * en caso de que existan mas parametros en la url los inyectamos en nuestra funcion
                        */
                        if(isset($url[2])){
                            #sacamos el numero de parametros restandole 2
                            #esto es porque el primer parametro es el nombre del controlador y el segundo es el metodo
                            $nparam = count($url)-2;
                            #variable que contendra los parametros en forma de array
                            $params=[];
                            #por cada parametro los voy agregando por medio de un bucle
                            for($i = 0; $i<$nparam; $i++){
                                array_push($params, ($url[$i]+2));//le sumamos 2 quitando el nombre del controlador y el metodo
                            }

                            $controller->{$url[1]($params)};
                        }else{
                            #si no tiene parametros se manda a llamar el metodo tal cual sin incluir los parametros
                            $controller->{$url[1]}();
                            #aqui entre {metodo} dinamico que queremos cargar
                        }
                    }else{
                        #Error, no existe el metodo
                        $controller = new Errores();
                    }
                }else{
                    #Si no encuentra el metodo, carga un metodo por default
                    $controller->render();
                }
            }else{
                #en caso de que no exista el archivo mandamos a llamar a un error
                $controller = new Errores();
            }

        }

    }
?>