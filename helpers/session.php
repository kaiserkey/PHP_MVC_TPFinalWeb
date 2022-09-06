<?
class Session{

    private $sessionName;

    public function __construct(){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function setSessionName($sessionName)
    {
        $this->sessionName = $sessionName;
        error_log('SESSION: Seteando el nombre de la sesion: ' . $this->sessionName);
        return $this;
    }

    public function getSessionName()
    {
        return $this->sessionName;
    }

    public function setCurrentUser($user){
        error_log('SESSION: set dni del usuario en sesion '. $user);
        error_log('SESSION: rol de la sesion actual '. $this->sessionName);
        $_SESSION[$this->sessionName] = $user;
    }

    public function getCurrentUser(){
        error_log('SESSION: get nombre de la sesion '. $_SESSION[$this->sessionName]);
        return $_SESSION[$this->sessionName];
    }

    public function closeSession(){
        session_unset();
        session_destroy();
    }

    public function exists(){
        return isset($_SESSION[$this->sessionName]);
    }

}
?>