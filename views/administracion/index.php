<?php
    //recibimos los datos para poder mostrarselos al usuario en la sesion actual
    $turnos = $this->d['turnosDB'];
    $usuariosRiesgosos = $this->d['usuariosRiesgosos'];
    $fechaHoraActual = new DateTime('now');
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Administracion</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="<? echo constant('URL');?>assets/css/generalStyle.css" rel="stylesheet">
        <link rel="shortcut icon" href="<? echo constant('URL');?>assets/img/favicon-32x32.png" type="image/x-icon">
    </head>
    <body id="container">
        <?require_once('views/header.php');?>
        <?  $this->showMessages(); ?>
            
            <div id="usuario-turnos-pendientes">
                <table id="table-turnos-pendientes-admin">
                    <tr>
                        <th colspan="9"><h1>Turnos Pendientes</h1></th>
                    </tr>
                    <tr>
                        <th>DNI Paciente</th>
                        <th>Hora</th>
                        <th>Fecha Del Turno</th>
                        <th>Nombre Del Doctor</th>
                        <th>Tipo De Turno</th>
                        <th>Estado Del Turno</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        
                    </tr>
                    
                        <?  
                            
                            for($i = 0; $i<count($turnos); $i++){
                                for($x = 0; $x<count($usuariosRiesgosos); $x++){
                                    if($usuariosRiesgosos[$x]==$turnos[$i]->getDniPaciente()){
                                        echo "<tr id='usuario-riesgoso'>";
                                    }else{
                                        echo "<tr>";
                                    }
                                }
                                
                                echo "<td>";
                                echo $turnos[$i]->getDniPaciente();
                                echo "</td>";
                                echo "<td>";
                                echo $turnos[$i]->getHora();
                                echo "</td>";
                                echo "<td>";
                                echo $turnos[$i]->getFechaTurno();
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
                                $fechaYHoraTurno = new DateTime($turnos[$i]->getFechaTurnoBD() . ' ' . $turnos[$i]->getHoraBD());
                                if($fechaYHoraTurno < $fechaHoraActual){
                                    echo "<form action='".constant('URL') ."administrarTurnos/actualizarTurno' method='post'>";
                                    echo "<td>";
                                    echo "<select name='estado' id='estado'>
                                    <option value='Atendido'>Atendido</option>
                                    <option value='Ausente'>Ausente</option>
                                    <option value='Cancelar'>Cancelar</option>
                                    </select>";
                                    echo "</td>";
                                    echo "<td>";
                                    echo "<input type='hidden' name='indice' value='". $i ."'>";
                                    echo "<input type='submit' value='Actualizar'>";
                                    echo "</td>";
                                    echo "</form>";
                                }else{
                                    echo "<form action='".constant('URL') ."administrarTurnos/actualizarTurno' method='post'>";
                                    echo "<td>";
                                    echo "<select name='estado' id='estado'>
                                    <option value='Cancelar'>Cancelar</option>
                                    </select>";
                                    echo "</td>";
                                    echo "<td>";
                                    echo "<input type='hidden' name='indice' value='". $i ."'>";
                                    echo "<input type='submit' value='Actualizar'>";
                                    echo "</td>";
                                    echo "</form>";
                                }
                                
                                echo "<td>";
                                echo "<a href='" . constant('URL') . "administrarTurnos/imprimirTurno?matricula=" . $turnos[$i]->getMatriculaDoctor() . "&hora= ".$turnos[$i]->getHora()."
                                    &fechaTurno=".$turnos[$i]->getFechaTurnoBD()."&dniPaciente=".$turnos[$i]->getDniPaciente().
                                    "&tipoTurno=".$turnos[$i]->getTipoTurno()."' target='_blank'> <input type='button' value='Imprimir'> </a>";
                                echo "</td>";
                                echo "</tr>";
                            }               
                            
                        ?>
                    
                </table> 
            </div>
        <?require_once('views/footer.php');?>
    </body>
</html>