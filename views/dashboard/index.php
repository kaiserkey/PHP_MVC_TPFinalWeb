<?php
    //recibimos los datos para poder mostrarselos al usuario en la sesion actual
    $userPaciente = $this->d['userPaciente'];
    $turnos = $this->d['turnosDB'];
    $historial = $this->d['historialDB'];
    $doctor = $this->d['doctorBD'];
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title><? echo $userPaciente->getNombre() . ' ' . $userPaciente->getApellido(); ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="<? echo constant('URL');?>assets/css/generalStyle.css" rel="stylesheet">
        <link rel="shortcut icon" href="<? echo constant('URL');?>assets/img/favicon-32x32.png" type="image/x-icon">
    </head>
    <body id="container">
        <?require_once('views/header.php');?>
        <?  $this->showMessages(); ?>
            <div id="mensaje-bienvenida">
                <h1>Bienvenido <?php echo $userPaciente->getNombre() . ' ' . $userPaciente->getApellido(); ?></h1>
            </div>
            <div id="usuario-turnos-pendientes">
                <table id="table-turnos-pendientes">
                    <tr>
                        <th colspan="8"><h1>Usted Tene Los Siguientes Turnos Registrados</h1></th>
                    </tr>
                    <tr>
                        <th>Hora</th>
                        <th>Fecha Del Turno</th>
                        <th>Fecha Del Registro</th>
                        <th>Nombre Del Doctor</th>
                        <th>Tipo De Turno</th>
                        <th>Estado Del Turno</th>
                        <th></th>
                        <th></th>
                    </tr>
                    <?                      
                        for($i = 0; $i<count($turnos); $i++){
                            $fechaTurno = new DateTime($turnos[$i]->getFechaTurnoBD());
                            $fechaActual = new DateTime('now');
                            $diferencia = $fechaTurno->diff($fechaActual);
                            if($diferencia->days<=60){
                                echo "<tr>";
                                echo "<td>";
                                echo $turnos[$i]->getHora();
                                echo "</td>";
                                echo "<td>";
                                echo $turnos[$i]->getFechaTurno();
                                echo "</td>";
                                echo "<td>";
                                echo $turnos[$i]->getFechaRegistro();
                                echo "</td>";
                                echo "<td>";
                                echo $turnos[$i]->getIfExistDoctorNombre($turnos[$i]->getMatriculaDoctor());
                                echo "</td>";
                                echo "<td>";
                                echo ucfirst($turnos[$i]->getTipoTurno());
                                echo "</td>";
                                echo "<td>";
                                echo $turnos[$i]->getEstado();
                                echo "</td>";
                                echo "<td>";
                                if($turnos[$i]->getEstado() == 'Pendiente'){
                                    echo "<a href='" . constant('URL') . "turnos/cancelarTurno?idTurno=".$turnos[$i]->getIdTurno()."'> <input type='button' value='Cancelar'> </a>";
                                }else{
                                    echo '-';
                                }
                                echo "</td>";
                                echo "<td>";
                                echo "<a href='" . constant('URL') . "turnos/imprimirTurno?matricula=" . $turnos[$i]->getMatriculaDoctor() . "&hora= ".$turnos[$i]->getHora()."
                                    &fechaTurno=".$turnos[$i]->getFechaTurnoBD()."&dniPaciente=".$turnos[$i]->getDniPaciente().
                                    "&tipoTurno=".$turnos[$i]->getTipoTurno()."' target='_blank'> <input type='button' value='Imprimir'> </a>";
                                echo "</td>";
                                echo "</tr>";
                            }
                            
                        }               
                        
                    ?>
                </table> 
            </div>
            <div id="table-usuario-historial-container">
                <table id="table-usuario-historial">
                    <tr>
                            <th colspan="6"><h1>Tu Historial Medico</h1></th>
                        </tr>
                        <tr>
                            <th>Especializacion</th>
                            <th>Fecha</th>
                            <th>Atendido Por</th>
                        </tr>
                        <?
                            
                            for($i = 0; $i<count($historial); $i++){
                                $fechaHistorial = new DateTime($historial[$i]->getFechaBD());
                                $fechaActual = new DateTime('now');
                                $diferencia = $fechaHistorial->diff($fechaActual);
                                if($diferencia->days<=60){
                                    echo "<tr>";
                                    echo "<td>";
                                    echo $historial[$i]->getEspecializacion();
                                    echo "</td>";
                                    echo "<td>";
                                    echo $historial[$i]->getFecha();
                                    echo "</td>";
                                    echo "<td>";
                                    echo $historial[$i]->getIfExistDoctorNombre($historial[$i]->getDoctorMatricula());
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            }  
                        ?>
                </table>
            </div>
        <?require_once('views/footer.php');?>
    </body>
</html>