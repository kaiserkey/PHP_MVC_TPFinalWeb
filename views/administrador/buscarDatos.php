<?php
    $datos = $this->d['datos'];
    $datosDoctor = $this->d['datosDoctor'];
    $datosProcedimiento = $this->d['datosProcedimiento'];
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
        <section id="container-buscar-agenda">
            <form action="<?php echo constant('URL') . 'buscarDatos/buscarAgendasPor'; ?>" method="post">
                <table id="table-buscar-agenda">
                    <tr>
                        <th colspan="4">Buscar Datos</th>
                    </tr>
                    <tr>
                        <td>
                            <select name="buscarpor" id="buscarpor" onchange="mostrarOpciones()">
                                <option value="-"> - </option>
                                <option value="agenda">Agenda</option>
                                <option value="doctor">Doctor</option>
                                <option value="procedimiento">Procedimiento</option>
                            </select>
                        </td>
                        <td id="mostrarBusqueda"></td>
                        <td id="segunOpcion"></td>
                        <td id="botonSubmit"></td>
                    </tr>
                </table> 
            </form> 
        </section>
        <section id="buscar-agenda-mostrar">
                        <!-- mostrar los datos obtenidos de la busqueda para agendas -->
                    
                    <?
                        if(!empty($datos)){
                            $busqueda = 1;
                            echo "<table id='table-buscar-agenda-mostrar'>";
                            echo "<tr><th>Informacion Obtenida De La Agenda</th></tr>";
                            echo "</table>";
                            for($i=0; $i<count($datos);$i++){
                                echo "<form action='" . constant('URL') . "buscarDatos/actualizarAgenda' method='post'>";
                                echo "<table id='table-buscar-agenda-mostrar'";
                                $horaInicio = date_format(new DateTime($datos[$i]->getHoraInicio()), 'H:i:s');
                                $horaFin = date_format(new DateTime($datos[$i]->getHoraFin()), 'H:i:s');
                                $fechaFinReservas = date_format(new DateTime($datos[$i]->getFechaFinReserva()), 'm/d/Y H:i:s');
                                echo "<tr>";
                                echo "<td>Dia</td>";
                                echo "<td>Hora de Inicio</td>";
                                echo "<td>Hora de Fin</td>";
                                echo "<td>Fecha de Fin Reserva</td>";
                                echo "<td>Duracion Turnos</td>";
                                echo "<td>Matricula Doctor</td>";
                                echo "<td></td>";
                                echo "<td></td>";
                                echo "<td></td>";
                                echo "</tr>";
                                echo "<tr>";
                                echo "<td> ". ucfirst($datos[$i]->getDia()) ." </td>";
                                echo "<td> ". $horaInicio ." </td>";
                                echo "<td> ". $horaFin ." </td>";
                                echo "<td> ". $fechaFinReservas ." </td>";
                                echo "<td> ". $datos[$i]->getDuracionTurnos() ." </td>";
                                echo "<td> ". $datos[$i]->getMatriculaDoctor() ." </td>";
                                echo "<td id='buttonActualizar'>";
                                echo "<input type='button' value='Modificar'"; 
                                echo "onclick='actualizarDatos(".$i. ',' . $busqueda .")'";
                                echo ">";
                                echo "</td>";
                                echo "<td id='buttonCancelar".$i."'></td>";
                                echo "</tr>";
                                echo "<input type='hidden' name='idAgenda' value=". $datos[$i]->getIdAgenda() .">";
                                echo "<tr id='actualizar".$i."'></tr>";
                                echo "</table>";
                                echo "</form>";
                            }
                            
                            
                        }
                        // mostrar los datos obtenidos de la busqueda para doctores 
                        if(!empty($datosDoctor)){
                            $busqueda = 2;
                            echo "<table id='table-buscar-agenda-mostrar'>";
                            echo "<tr><th>Informacion Obtenida De Doctor</th></tr>";
                            echo "</table>";
                            for($i=0; $i<count($datosDoctor);$i++){
                                echo "<form action='" . constant('URL') . "buscarDatos/actualizarDoctor' method='post'>";
                                echo "<table id='table-buscar-agenda-mostrar'";
                                echo "<tr>";
                                echo "<td>Clinica</td>";
                                echo "<td>Nombre</td>";
                                echo "<td>Localidad</td>";
                                echo "<td>Especializacion</td>";
                                echo "<td>Matricula</td>";
                                echo "<td></td>";
                                echo "<td></td>";
                                echo "</tr>";
                                echo "<tr>";
                                echo "<td>". $clinicas[$datosDoctor[$i]->getIdClinica()] ."</td>";
                                echo "<td>". $datosDoctor[$i]->getNombre() ."</td>";
                                echo "<td>". ucwords($datosDoctor[$i]->getLocalidad())  ."</td>";
                                echo "<td>". $datosDoctor[$i]->getEspecializacion() ."</td>";
                                echo "<td>". $datosDoctor[$i]->getMatricula() ."</td>";
                                echo "<td id='buttonActualizar'>";
                                echo "<input type='button' value='Modificar'"; 
                                echo "onclick='actualizarDatos(".$i. ',' . $busqueda .")'";
                                echo ">";
                                echo "</td>";
                                echo "<td id='buttonCancelar".$i."'></td>";
                                echo "</tr>";
                                echo "<input type='hidden' name='idDoctor' value=". $datosDoctor[$i]->getIdDoctor() .">";
                                echo "<tr id='actualizar".$i."'></tr>";
                                echo "</table>";
                                echo "</form>";
                            }
                            
                            
                        }
                        // mostrar los datos obtenidos de la busqueda para procedimientos 
                        if(!empty($datosProcedimiento)){
                            $busqueda = 3;
                            echo "<table id='table-buscar-agenda-mostrar'>";
                            echo "<tr><th>Informacion Obtenida De Procedimiento</th></tr>";
                            echo "</table>";
                            for($i=0; $i<count($datosProcedimiento);$i++){
                                echo "<form action='" . constant('URL') . "buscarDatos/actualizarProcedimiento' method='post'>";
                                echo "<table id='table-buscar-agenda-mostrar'";
                                echo "<tr>";
                                echo "<td>Nombre</td>";
                                echo "<td>Indicaciones</td>";
                                echo "<td>Matricula Doctor</td>";
                                echo "<td></td>";
                                echo "<td></td>";
                                echo "</tr>";
                                echo "<tr>";
                                echo "<td>". $datosProcedimiento[$i]->getNombre() ."</td>";
                                echo "<td>". $datosProcedimiento[$i]->getIndicaciones() ."</td>";
                                echo "<td>". $datosProcedimiento[$i]->getMatriculaDoctor() ."</td>";
                                echo "<td id='buttonActualizar'>";
                                echo "<input type='button' value='Modificar'"; 
                                echo "onclick='actualizarDatos(".$i. ',' . $busqueda .")'";
                                echo ">";
                                echo "</td>";
                                echo "<td id='buttonCancelar".$i."'></td>";
                                echo "</tr>";
                                echo "<input type='hidden' name='idProcediento' value=". $datosProcedimiento[$i]->getIdProcedimiento() .">";
                                echo "<tr id='actualizar".$i."'></tr>";
                                echo "</table>";
                                echo "</form>";
                            }
                        }
                    ?>
                
        </section>
        <script> 
            function actualizarDatos(n, busqueda){
                tablerow = document.getElementById('actualizar'+n)
                buttonCancelar = document.getElementById('buttonCancelar'+n)
                if(busqueda==1){
                    tablerow.innerHTML = "<td><select name='dia' id='dia'><option value='lunes'>Lunes</option><option value='martes'>Martes</option><option value='miercoles'>Miercoles</option><option value='jueves'>Jueves</option><option value='viernes'>Viernes</option><option value='sabado'>Sabado</option></select></td>"+
                    "<td><input type='time' id='hora_inicio' name='hora_inicio' required></td>"+
                    "<td><input type='time' id='hora_fin' name='hora_fin' required></td>"+
                    "<td><input type='datetime-local' name='fecha_fin_reserva' id='fecha_fin_reserva' required></td>"+
                    "<td><select name='duracion_turnos' id='duracion_turnos' required><option value='20'>20 min</option><option value='30'>30 min</option><option value='40'>40 min</option><option value='59'>60 min</option></select></td>"+
                    "<td><input type='number' name='matricula' id='matricula' min='0'></td>"+
                    "<td><button type='reset'>Limpiar</button></td>"+
                    "<td> <input type='submit' value='Actualizar'></td>"
                    buttonCancelar.innerHTML = "<input type='button' value='Cancelar' onclick='cancelar("+n+")'>"
                }
                if(busqueda==2){
                    tablerow.innerHTML = "<td><select name='clinica' id='clinica'><?
                        foreach($clinicas as $clave => $valor){
                            echo "<option value='".$clave."'>". $valor .'</option>';
                        }
                    ?></select></td>"+
                    "<td><input type='text' name='nombre' id='nombre' required></td>"+
                    "<td><input type='text' name='localidad' id='localidad' required></td>"+
                    "<td><input type='text' name='especializacion' id='especializacion' required></td>"+
                    "<td><input type='number' name='matricula' id='matricula' min='0' required></td>"+
                    "<td><button type='reset'>Limpiar</button></td>"+
                    "<td> <input type='submit' value='Actualizar'></td>"
                    buttonCancelar.innerHTML = "<input type='button' value='Cancelar' onclick='cancelar("+n+")'>"
                }

                if(busqueda==3){
                    tablerow.innerHTML = "<td><input type='text' name='nombre' id='nombre' required></td>"+
                    "<td><textarea name='indicaciones' id='indicaciones' cols='30' rows='5' maxlength='199' placeholder='Seguir las siguientes indicaciones para el procedimiento: ' required></textarea></td>"+
                    "<td><input type='number' name='matricula' id='matricula' min='0' required></td>"+
                    "<td><button type='reset'>Limpiar</button></td>"+
                    "<td> <input type='submit' value='Actualizar'></td>"
                    buttonCancelar.innerHTML = "<input type='button' value='Cancelar' onclick='cancelar("+n+")'>"
                }
            }
            function cancelar(n){
                tablerow = document.getElementById('actualizar'+n)
                buttonCancelar = document.getElementById('buttonCancelar'+n)
                tablerow.innerHTML = ''
                buttonCancelar.innerHTML = ''
            }
            function mostrarOpciones(){
                mostrarBusqueda = document.getElementById('mostrarBusqueda')
                segunOpcion = document.getElementById('segunOpcion')
                botonSubmit = document.getElementById('botonSubmit')
                selected1 = document.getElementById('buscarpor').value

                if(selected1 == '-'){
                    segunOpcion.innerHTML = '';
                    botonSubmit.innerHTML = '';
                    mostrarBusqueda.innerHTML = '';
                }
                if(selected1 == 'agenda'){
                    mostrarBusqueda.innerHTML = "<select name='buscar' id='buscar' onchange='mostrarMasOpciones()'><option value='-'> - </option><option value='dia'>Dia</option><option value='matricula'>Doctor Matricula</option><option value='duracion'>Duracion de los Turnos</option></select>"
                    botonSubmit.innerHTML = "<input type='submit' value='Buscar'>"
                }

                if(selected1 == 'doctor'){
                    mostrarBusqueda.innerHTML = "<input type='number' name='matricula' id='matricula' min='0'>"
                    botonSubmit.innerHTML = "<input type='submit' value='Buscar'>"
                }

                if(selected1 == 'procedimiento'){
                    mostrarBusqueda.innerHTML = "<input type='number' name='procmatricula' id='procmatricula' min='0'>"
                    botonSubmit.innerHTML = "<input type='submit' value='Buscar'>"
                }

            }
            function mostrarMasOpciones(){
                segunOpcion = document.getElementById('segunOpcion')
                botonSubmit = document.getElementById('botonSubmit')
                selected = document.getElementById('buscar').value

                if(selected=='-'){
                    segunOpcion.innerHTML = ''  
                    botonSubmit.innerHTML = "<input type='submit' value='Buscar'>"
                }

                if(selected=='dia'){
                    segunOpcion.innerHTML = "<select name='dia' id='dia' required><option value='lunes'>Lunes</option><option value='martes'>Martes</option><option value='miercoles'>Miercoles</option><option value='jueves'>Jueves</option><option value='viernes'>Viernes</option><option value='sabado'>Sabado</option></select>"
                    botonSubmit.innerHTML = "<input type='submit' value='Buscar'>"
                }

                if(selected=='matricula'){
                    segunOpcion.innerHTML = "<input type='number' name='matricula' id='matricula' min='0' required>"
                    botonSubmit.innerHTML = "<input type='submit' value='Buscar'>"
                }

                if(selected=='duracion'){
                    segunOpcion.innerHTML = "<select name='duracion_turnos' id='duracion_turnos' required><option value='20'>20 min</option><option value='30'>30 min</option><option value='40'>40 min</option><option value='59'>60 min</option></select>"
                    botonSubmit.innerHTML = "<input type='submit' value='Buscar'>"
                }
            }
        </script>
        <?require_once('views/footer.php');?>
    </body>
</html>