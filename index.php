<?
    #reporte de errores de la aplicacion
    error_reporting(E_ALL);
    ini_set('ignore_repeated_errors', TRUE);
    ini_set('display_errors', FALSE);
    ini_set('log_errrors', TRUE);
    ini_set("error_log", "C:\wamp64\www\MVC-TPFinalWebII\php-error.log");
    error_log("Inicio de la Aplicacion!!");

    
    require_once('helpers/errormessages.php');
    require_once('helpers/successmessages.php');
    require_once('libs/database.php');
    require_once('libs/controller.php');
    require_once('libs/model.php');
    require_once('libs/view.php');
    require_once('helpers/sessionController.php');
    require_once('libs/app.php');
    require_once('config/config.php');

    $app = new App();

?>