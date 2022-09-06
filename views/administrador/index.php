<?php
    //recibimos los datos para poder mostrarselos al usuario en la sesion actual
    $clinicas = $this->d['clinicasIDNombre'];
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Administrador</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="<? echo constant('URL');?>assets/css/generalStyle.css" rel="stylesheet">
        <link rel="shortcut icon" href="<? echo constant('URL');?>assets/img/favicon-32x32.png" type="image/x-icon">
    </head>
    <body id="container">
        <?require_once('views/header.php');?>
        <?  $this->showMessages(); ?>
        <section id="container-admin-nueva-agenda">
            <form action="<?php echo constant('URL') . 'gestionarAgendas/agregarAgenda'; ?>" method="post">
                <table id="table-admin-nueva-agenda">
                    <tr>
                        <th colspan="3">Agregar Nueva Agenda</th>
                    </tr>
                        <tr>
                            <td><label for="matricula">Matricula Doctor</label></td>
                            <td id="desactivarMatricula"><input type="number" name="matricula" id="matricula" min="0"></td>
                            <td id="checkbox"><input type="checkbox" name="true" id="true" onclick="disableMatricula()"><span> Matricula Opcional</sp></td>
                        </tr>
                        <tr>
                            <td><label for="dia">Dia del Turno</label></td>
                            <td colspan="2">
                                <select name="dia" id="dia">
                                    <option value="lunes">Lunes</option>
                                    <option value="martes">Martes</option>
                                    <option value="miercoles">Miercoles</option>
                                    <option value="jueves">Jueves</option>
                                    <option value="viernes">Viernes</option>
                                    <option value="sabado">Sabado</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="hora_inicio">Hora de Inicio de los Turno</label></td>
                            <td colspan="2"><input type="time" id="hora_inicio" name="hora_inicio" required></td>
                        </tr>
                        <tr>
                            <td><label for="hora_fin">Hora de Fin de los Turno</label></td>
                            <td colspan="2"><input type="time" id="hora_fin" name="hora_fin" required></td>
                        </tr>
                        <tr>
                            <td><label for="fecha_fin_reserva">Fecha de Finalizacion de Los Turnos</label></td>
                            <td colspan="2"><input type="datetime-local" name="fecha_fin_reserva" id="fecha_fin_reserva" required></td>
                        </tr>
                        <tr>
                            <td><label for="duracion_turnos">Duracion de los Turnos</label></td>
                            <td colspan="2"><select name="duracion_turnos" id="duracion_turnos" required>
                                <option value="20">20 min</option>
                                <option value="30">30 min</option>
                                <option value="40">40 min</option>
                                <option value="59">60 min</option>
                            </select></td>
                        </tr>
                        <tr id="submit">
                            <td colspan="3"><input type="submit" value="Agregar"></td>
                        </tr>
                </table>
            </form>
        </section>
        <section id="container-admin-nueva-agenda">
            <form action="<?php echo constant('URL') . 'gestionarAgendas/agregarDoctor'; ?>" method="post">
                <table id="table-admin-nueva-agenda">
                    <tr>
                        <th colspan="2">Agregar Nuevo Doctor</th>
                    </tr>
                    <tr>
                        <td><label for="clinica">Clinica</label></td>
                        <td>
                            <select name="clinica" id="clinica" required>
                            <?
                                foreach($clinicas as $clave => $valor){
                                    echo "<option value='".$clave."'>". $valor ."</option>";
                                }
                            ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="nombre">Nombre Completo</label></td>
                        <td><input type="text" name="nombre" id="nombre" required></td>
                    </tr>
                    <tr>
                        <td><label for="localidad">Localidad</label></td>
                        <td><input type="text" name="localidad" id="localidad" required></td>
                    </tr>
                    <tr>
                        <td><label for="matricula">Matricula</label></td>
                        <td><input type="number" name="matricula" id="matricula" min="0" required></td>
                    </tr>
                    <tr>
                        <td><label for="especializacion">Especializacion</label></td>
                        <td><input type="text" name="especializacion" id="especializacion" required></td>
                    </tr>
                    <tr id="submit">
                            <td colspan="2"><input type="submit" value="Guardar"></td>
                    </tr>
                </table>
            </form>
        </section>
        <section id="container-admin-nueva-agenda">
            <form action="<?php echo constant('URL') . 'gestionarAgendas/agregarProcedimiento'; ?>" method="post">
                <table id="table-admin-nueva-agenda">
                    <tr>
                        <th colspan="2">Agregar Nuevo Procedimiento</th>
                    </tr>
                    <tr>
                        <td><label for="nombre">Nombre</label></td>
                        <td><input type="text" name="nombre" id="nombre" required></td>
                    </tr>
                    <tr>
                        <td><label for="indicaciones">Indicaciones</label></td>
                        <td><textarea name="indicaciones" id="indicaciones" cols="30" rows="5" maxlength="199" placeholder="Seguir las siguientes indicaciones para el procedimiento: " required></textarea></td>
                    </tr>
                    <tr>
                        <td><label for="matricula">Matricula</label></td>
                        <td><input type="number" name="matricula" id="matricula" min="0" required></td>
                    </tr>
                    <tr id="submit">
                            <td colspan="2"><input type="submit" value="Guardar"></td>
                    </tr>
                </table>
            </form>
        </section>
        <script>
            function disableMatricula(){
                if(check = document.getElementById('true').checked){
                    matricula = document.getElementById('desactivarMatricula')
                    matricula.innerHTML = "<input type='number' name='matricula' id='matricula' disabled>"
                }else{
                    matricula = document.getElementById('desactivarMatricula')
                    matricula.innerHTML = "<input type='number' name='matricula' id='matricula' min='0'>"
                }
                
            }
        </script>
        <?require_once('views/footer.php');?>
    </body>
</html>