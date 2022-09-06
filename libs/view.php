<?
    #
    class View{
        public function __construct()
        {
            
        }
        #solicitamos el nombre de la carpeta con la vista y un array con los datos a mostrar
        public function render($nombre, $datos = []){
            $this->d = $datos;

            $this->handleMessages();

            require_once 'views/' . $nombre . '.php';
        }

        #validamos si existen mensajes
        private function handleMessages(){
            if(isset($_GET['success']) && isset($_GET['error'])){

            }else if(isset($_GET['success'])){
                $this->handleSuccsess();
            }else if(isset($_GET['error'])){
                $this->handleError();
            }
        }

        private function handleError(){
            $hash = $_GET['error'];
            $error = new ErrorMessage();

            if($error->existsKey(($hash))){
                $this->d['error'] = $error->get($hash);
            }else{
                $this->d['error'] = NULL;
            }
        }

        private function handleSuccsess(){
            $hash = $_GET['success'];
            $success = new SuccessMessage();

            if($success->existsKey(($hash))){
                $this->d['success'] = $success->get($hash);
            }else{
                $this->d['success'] = NULL;
            }
        }

        public function showMessages(){
            $this->showErrors();
            $this->showSuccess();
        }

        public function showErrors(){
            if(array_key_exists('error', $this->d)){
                echo "<div
                style='color: black;
                border-radius: 20px;
                -webkit-border-radius: 20px;
                -moz-border-radius: 20px;
                -ms-border-radius: 20px;
                -o-border-radius: 20px;
                width: 90%;
                padding: 5px;
                margin: 10px auto;
                text-align: center;
                font-family: Times New Roman, Times, serif;
                font-size: 18px;
                font-weight: bold;
                background-color: rgba(255, 0, 0, 0.7);
                height: 30px;'
                class='error'>".$this->d['error']."</div>";
            }
        }
    
        public function showSuccess(){
            if(array_key_exists('success', $this->d)){
                echo "<div
                    style='color: black;
                    border-radius: 20px;
                    -webkit-border-radius: 20px;
                    -moz-border-radius: 20px;
                    -ms-border-radius: 20px;
                    -o-border-radius: 20px;
                    width: 90%;
                    padding: 5px;
                    margin: 10px auto;
                    text-align: center;
                    font-family: Times New Roman, Times, serif;
                    font-size: 18px;
                    font-weight: bold;
                    background-color: rgb(75, 159, 128);
                    height: 30px;'
                    class='success'>".$this->d['success']."</div>";
            }
        }
    }
?>