<?

class SuccessMessage{
    #ERROR_CONTROLLER_METHOD_ACTION
    //ERROR|SUCCESS
    //Controller
    //method
    //operation
    
    const SUCCESS_CANCEL_TURNO     = "f52228665c4f14c8695b194f670b0ef1";
    const SUCCESS_SENT_EMAIL       = "fcd919285d5759328b143801573ec47d";
    const SUCCESS_ADMINISTRAR_TURNO   = "fbbd0f23184e820e1df466abe6102955";
    const SUCCESS_NEW_AGENDA     = "2ee085ac8828407f4908e4d134195e5c";
    const SUCCESS_NEW_DOCTOR       = "6fb34a5e4118fbeq2we823636ca24a1d21669";
    const SUCCESS_NEW_PROCEDIMIENTO       = "6fb34a5e4118fb823636ca24a1d21669";
    const SUCCESS_BUSCAR       = "edabc9e4581fee3f0056fff4685ee9a8";
    const SUCCESS_SIGNUP_NEWUSER       = "8281e04ed52ccfc13820d0f6acb0985a";
    const SUCCESS_CONSULT_TURNOS       = "8281e04ed52ccfc1tre3820d0f6ac234b0985a";
    const SUCCESS_SABE_TURNO       = "8281e0344ed52ccfc1trfghgfh20d0f6ac234b0985a";
    const SUCCESS_UPDATE_AGENDA     = "2ee085ac8828407f4234234908e4dgfdg134195e5c";
    const SUCCESS_UPDATE_DOCTOR     = "2ee085ac882234234908e4dgfdg134195e5c";
    const SUCCESS_UPDATE_PROCEDIMIENTO     = "2ee085ac8828407f4234234908e4134195e5c";
    const SUCCESS_UPDATE_PASS     = "2ee085a28407f423werwer4234908e4134195e5c";
    const SUCCESS_UPDATE_DIR     = "2ee085a2dfgdfads23wer4234908e4134195e5c";
    const SUCCESS_UPDATE_CEL     = "2ee085a2dfgASDHJKHJK234908e4134195e5c";
    const SUCCESS_UPDATE_GS     = "2ee085a2asdsadjhkjh324JK234908e4134195e5c";
    const SUCCESS_UPDATE_SEXO     = "2ee085aghjhg546234908e4134195e5c";
    const SUCCESS_UPDATE_EMAIL     = "2ee0hjkhjk4248rt234908e4134195e5c";
    const SUCCESS_UPDATE_FECHA     = "2ee085we34rhgjiliol654908e4134195e5c";
    const SUCCESS_UPDATE_OS     = "2ee085ah435jhjkty8434908e4134195e5c";
    const SUCCESS_UPDATE_ROL     = "2ee085ah435jhlñfkg534hfoighjktr534134195e5c";

    protected $successList = [];

    public function __construct()
    {
        $this->successList = [
            SuccessMessage::SUCCESS_CANCEL_TURNO => "Turno Cancelado Correctamente.",
            SuccessMessage::SUCCESS_SENT_EMAIL => "Se Ha Enviado Un Correo Con Los Datos Del Turno, ¡Verifique Su Casilla de Entrada!.",
            SuccessMessage::SUCCESS_ADMINISTRAR_TURNO => "El Estado Del Turno Se Actualizo Correctamente.",
            SuccessMessage::SUCCESS_NEW_AGENDA => "Se agrego la nueva agenda correctamente.",
            SuccessMessage::SUCCESS_NEW_DOCTOR => "Se agrego el nuevo Procedimiento correctamente.",
            SuccessMessage::SUCCESS_NEW_PROCEDIMIENTO => "Se agrego el nuevo Doctor correctamente.",
            SuccessMessage::SUCCESS_BUSCAR => "Se encontraron los datos.",
            SuccessMessage::SUCCESS_SIGNUP_NEWUSER => "Usuario registrado correctamente.",
            SuccessMessage::SUCCESS_CONSULT_TURNOS => "Listado de Turnos Obtenidos.",
            SuccessMessage::SUCCESS_SABE_TURNO => "El turno se ha agendado correctamente.",
            SuccessMessage::SUCCESS_UPDATE_AGENDA => "La agenda se ha actualizado correctamente.",
            SuccessMessage::SUCCESS_UPDATE_DOCTOR => "El doctor se ha actualizado correctamente.",
            SuccessMessage::SUCCESS_UPDATE_PROCEDIMIENTO => "El procedimiento se ha actualizado correctamente.",
            SuccessMessage::SUCCESS_UPDATE_PASS => "Se actualizo correctamente su contraseña.",
            SuccessMessage::SUCCESS_UPDATE_DIR => "Se actualizo correctamente su direccion.",
            SuccessMessage::SUCCESS_UPDATE_CEL => "Se actualizo correctamente su celular.",
            SuccessMessage::SUCCESS_UPDATE_EMAIL => "Se actualizo correctamente su email.",
            SuccessMessage::SUCCESS_UPDATE_GS => "Se actualizo correctamente su grupo sanguineo.",
            SuccessMessage::SUCCESS_UPDATE_SEXO => "Se actualizo correctamente su sexo.",
            SuccessMessage::SUCCESS_UPDATE_FECHA => "Se actualizo correctamente su fecha de nacimiento.",
            SuccessMessage::SUCCESS_UPDATE_OS => "Se actualizo correctamente su obra social.",
            SuccessMessage::SUCCESS_UPDATE_ROL => "Se actualizo correctamente el rol del usuario."
        ];
    }

    #devuelve el mensaje correspondiente a la clave de hash enviada
    public function get($hash){
        return $this->successList[$hash];
    }

    #comprueba si existe la clave de hash
    public function existsKey($key){
        if(array_key_exists($key, $this->successList)){
            return true;
        }else{
            return false;
        }
    }
}

?>