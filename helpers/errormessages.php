<?

class ErrorMessage{
    #ERROR_CONTROLLER_METHOD_OPERATION
    //ERROR|SUCCESS
    //Controller
    //method
    //operation
    const ERROR_CANCEL_TURNO        = "1f8f0ae8963b16403c3ec9ebb851f156";
    const ERROR_SENT_EMAIL                 = "8f48a0845b4f8704cb7e8b00d4981233";
    const ERROR_BUSCAR_PACIENTE             = "8f48a0845b4f8704cb7e8b00d4981233";
    const ERROR_EXIST_PACIENTE       = "a5bcd7089d8323423546456f45e17e989fbc86003ed";
    const ERROR_NEW_AGENDA               = "e99ab11bbeec9f63fb16f46133de85ec";
    const ERROR_NEW_AGENDA_SABE         = "807f75bf7acec5aa86993423b6841407";
    const ERROR_NEW_DOCTOR           = "0f0735f8603324a7sdafsdfbca482debdf088fa";
    const ERROR_NEW_DOCTOR_SABE                = "98217b0c263b136bf14925994ca7a0aa";
    const ERROR_NEW_INPUT_FUNCTION             = "365009a3644ef5d3cf7a229a09b4d690";
    const ERROR_NEW_PROCEDIMIENTO       = "0f0735f8603324a7bca482debdf088fa";
    const ERROR_NEW_PROCEDIMIENTO_SABE = "27731b37e286a3c6429a1b8e44ef3ff6";
    const ERROR_BUSCAR                 = "dfb4dc6544b0dae81ea132de667b2a5d";
    const ERROR_BUSCAR_FORM          = "53f3554f0533aa9f20fbf46bd5328430";
    const ERROR_UPDATE_AGENDA               = "11c37cfab311fbe28652f4947a9523c4";
    const ERROR_UPDATE_AGENDA_SABE         = "2194ac064912be67fc164539dc435a42";
    const ERROR_UPDATE_DOCTOR          = "bcbe63ed8464684af6945ad8a89f76f8";
    const ERROR_UPDATE_DOCTOR_SABE                   = "1fdce6bbf47d6b26a9cd809ea1910222";
    const ERROR_UPDATE_PROCEDIMIENTO             = "a5bcd7089d83f45e17e989fbc86003ed";
    const ERROR_UPDATE_PROCEDIMIENTO_SABE            = "a74accfd26e06d012266810952678cf3";
    const ERROR_CONSULT_TURNOS                   = "a74accfd26e06d012266823410958cf3";
    const ERROR_CONSULT_CAMPOS_TURNOS                   = "a74accfd26e06d012266823410958cf3";
    const ERROR_SABE_TURNO                   = "a74accfd26rewrewrd012266823410958cf3";
    const ERROR_TURNOS_VOID                   = "a74accfd26r345ewrewrd0SDFSDF12266823410958cf3";
    const ERROR_SIGNUP_NEWUSER_EMPTY                   = "a74accfd2dfgewrd0SDFSDF12266823410958cf3";
    const ERROR_SIGNUP_NEWUSER_EXISTS                   = "lkdfmgldfgjlkdfgjiorejgoi32423409ilkmlkgfd";
    const ERROR_SIGNUP_NEWUSER                   = "a74achgujkyu465rd0SDFSDF12266823410958cf3";
    const ERROR_LOGIN_AUTHENTICATE_EMPTY         = "2194ac0649werw2345erwer12be67fc164539dc435a42";
    const ERROR_LOGIN_AUTHENTICATE_DATA          = "bcbe63ed846dfgd46843534af6945ad8a89f76f8";
    const ERROR_LOGIN_AUTHENTICATE               = "11c37cfab311fbe28652sfsdf234f4947a9523c4";
    const ERROR_UPDATE_USER_PASS_VERIFY               = "11c37cfab311fbe28652sfsd2343f234f4947a9523c4";
    const ERROR_UPDATE_USER_PASS               = "11c37cfab311fbe2862343f234f4947a9523c4";
    const ERROR_UPDATE_PASS               = "11c37dsgdfgfdgf2862343f234f4947a9523c4";
    const ERROR_UPDATE_CEL               = "11c37dsgdfgfdgf2862343ASDHGJGJ947a9523c4";
    const ERROR_UPDATE_EMAIL               = "11chgjtyrt5462862343f234f4947a9523c4";
    const ERROR_UPDATE_SEXO               = "11c37dsgdfasdsad43f234f4947a9523c4";
    const ERROR_UPDATE_FECHA               = "11c37dsgdfhgfhfghgfh45354f4947a9523c4";
    const ERROR_UPDATE_OS               = "11c37dsgdaw345sdahgfh62343f234f4947a9523c4";
    const ERROR_UPDATE_GS               = "11c37dsgdfergfdgf28dfkjhgkikuf4947a9523c4";
    const ERROR_UPDATE_DIR               = "11c37dsgdfg456fghjtyr56434f4947a9523c4";
    const ERROR_UPDATE_ROL               = "11c37dsgdfg45DSFFGHIKYUKY566434f4947a9523c4";
    const ERROR_UPDATE_ROL_VERIFY               = "11c37dsgdasdjghj7UKY566434f4947a9523c4";


    protected $errorList = [];

    public function __construct()
    {
        $this->errorList = [
            ErrorMessage::ERROR_CANCEL_TURNO => 'Solo puedes cancelar un turno hasta un dia antes de la fecha del mismo.',
            ErrorMessage::ERROR_SENT_EMAIL           => 'No Se Ha Podido Enviar El Email Con Los Datos De Su Turno.',
            ErrorMessage::ERROR_BUSCAR_PACIENTE       => 'Error: Se debe ingresar el DNI existente.',
            ErrorMessage::ERROR_EXIST_PACIENTE => 'Error: Este paciente no se encuentra registrado en la base de datos.',
            ErrorMessage::ERROR_NEW_AGENDA         => 'Los datos ingresados no son correctos, intenta nuevamente.',
            ErrorMessage::ERROR_NEW_AGENDA_SABE   => 'Error: No se pudo guardar la anueva agenda, verifique los datos.',
            ErrorMessage::ERROR_NEW_DOCTOR     => 'Los datos ingresados no son correctos, intenta nuevamente.',
            ErrorMessage::ERROR_NEW_DOCTOR_SABE           => 'Error: No se pudo guardar Doctor, verifique los datos.',
            ErrorMessage::ERROR_NEW_INPUT_FUNCTION       => 'No se ha recibido ningun dato, intenta nuevamente.',
            ErrorMessage::ERROR_NEW_PROCEDIMIENTO => 'Los datos ingresados no son correctos, intenta nuevamente.',
            ErrorMessage::ERROR_NEW_PROCEDIMIENTO_SABE => 'Error: No se pudo guardar el Procedimiento, verifique los datos.',
            ErrorMessage::ERROR_BUSCAR          => 'No se encontraron coincidencias',
            ErrorMessage::ERROR_BUSCAR_FORM   => 'Los datos ingresados son incorrectos',
            ErrorMessage::ERROR_UPDATE_AGENDA        => 'Los datos ingresados no son correctos, intenta nuevamente.',
            ErrorMessage::ERROR_UPDATE_AGENDA_SABE  => 'Error: no se ha podido actualizar la base de datos de agenda.',
            ErrorMessage::ERROR_UPDATE_DOCTOR   => 'Los datos ingresados no son correctos, intenta nuevamente.',
            ErrorMessage::ERROR_UPDATE_DOCTOR_SABE            => 'Error: no se ha podido actualizar la base de datos de doctor.',
            ErrorMessage::ERROR_UPDATE_PROCEDIMIENTO      => 'Los datos ingresados no son correctos, intenta nuevamente.',
            ErrorMessage::ERROR_UPDATE_PROCEDIMIENTO_SABE     => 'Error: no se ha podido actualizar la base de datos de procedimiento.',
            ErrorMessage::ERROR_CONSULT_TURNOS     => 'Error en la consulta de los turnos.',
            ErrorMessage::ERROR_CONSULT_CAMPOS_TURNOS     => 'No se encontraron turnos en la base de datos para este Doctor.',
            ErrorMessage::ERROR_SABE_TURNO     => 'Error No se ha podido guardar el turno.',
            ErrorMessage::ERROR_TURNOS_VOID     => 'No hay turnos disponibles para este Doctor.',
            ErrorMessage::ERROR_SIGNUP_NEWUSER_EMPTY     => 'Error: Los datos ingresados no son correctos.',
            ErrorMessage::ERROR_SIGNUP_NEWUSER_EXISTS     => 'Error: El usuario ingresado ya se encuentra registrado.',
            ErrorMessage::ERROR_SIGNUP_NEWUSER     => 'Error: No se ha podido registrar el nuevo usuario en la base de datos.',
            ErrorMessage::ERROR_LOGIN_AUTHENTICATE_EMPTY  => 'Los parámetros para autenticar no pueden estar vacíos.',
            ErrorMessage::ERROR_LOGIN_AUTHENTICATE_DATA   => 'Nombre de usuario y/o password incorrectos.',
            ErrorMessage::ERROR_LOGIN_AUTHENTICATE        => 'Hubo un problema al autenticarse.',
            ErrorMessage::ERROR_UPDATE_USER_PASS_VERIFY        => 'La contraseña ingresada no coincide con la actual.',
            ErrorMessage::ERROR_UPDATE_USER_PASS        => 'Las contraseñas nueva y repetir contraseña no coinciden.',
            ErrorMessage::ERROR_UPDATE_PASS        => 'No se ha podido actualizar su contraseña.',
            ErrorMessage::ERROR_UPDATE_DIR        => 'No se ha podido actualizar su direccion.',
            ErrorMessage::ERROR_UPDATE_GS        => 'No se ha podido actualizar su grupo sanguineo.',
            ErrorMessage::ERROR_UPDATE_OS        => 'No se ha podido actualizar su obra social.',
            ErrorMessage::ERROR_UPDATE_CEL        => 'No se ha podido actualizar su celular.',
            ErrorMessage::ERROR_UPDATE_FECHA        => 'No se ha podido actualizar su fecha de nacimiento.',
            ErrorMessage::ERROR_UPDATE_EMAIL        => 'No se ha podido actualizar su email.',
            ErrorMessage::ERROR_UPDATE_SEXO        => 'No se ha podido actualizar su sexo.',
            ErrorMessage::ERROR_UPDATE_ROL        => 'No se ha podido actualizar el rol.',
            ErrorMessage::ERROR_UPDATE_ROL_VERIFY        => 'Los datos de rol no pueden estar vacios.'
        ];
    }

    #devuelve el mensaje correspondiente a la clave de hash enviada
    public function get($hash){
        return $this->errorList[$hash];
    }

    #comprueba si existe la clave de hash
    public function existsKey($key){
        if(array_key_exists($key, $this->errorList)){
            return true;
        }else{
            return false;
        }
    }
}

?>