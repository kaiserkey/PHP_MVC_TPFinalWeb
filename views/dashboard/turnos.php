<?php
    //recibimos los datos para poder mostrarselos al usuario en la sesion sesion actual
    $userPaciente = $this->d['userPaciente'];
    $turnos = $this->d['turnosDB'];
    $agenda = $this->d['agendaDB'];
    $doctor = $this->d['doctorBD'];
    $procedimientoBD = $this->d['procedimientoBD'];
    $especializaciones = $this->d['especializaciones'];
    $procedimientos = $this->d['procedimientoNombres'];
    $listadoDeTurnos = $this->d['listadoDeTurnos'];
    $datosTurno = $this->d['datosTurno'];

    $doctorMatriculaNombre = [];
    $doctorEspecializacionMatricula = [];
    foreach($doctor as $datos){
        $doctorMatriculaNombre[$datos->getMatricula()] = $datos->getNombre();
        $doctorEspecializacionMatricula[] = [$datos->getEspecializacion()=>$datos->getMatricula()];
    }

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
<body>
<body id="container">
        <?require_once('views/header.php');?>
        <?  $this->showMessages(); ?>
        <section id="container-buscar-principal">
            <section id="container-buscar-turnos">
                <form action="<?php echo constant('URL') . 'turnos/consultarTurnos'; ?>" method="POST">
                    <table id="container-buscar-table">
                        <tr>
                            <th colspan="4">
                                Buscar Turnos Disponibles
                            </th>
                        </tr>
                        <tr>
                            <th>Tipo de Turno</td>
                            <th>Especializacion</td>
                            <th>Nombre del Doctor</td>
                            <th></td>
                        </tr>
                        <tr>
                            <td>
                                <select name="tipoDeOperacion" id="tipoDeOperacion" onchange="mostrarProcedimientos()">
                                    <option value="-"> - </option>
                                    <option value="procedimiento">Procedimiento</option>
                                    <option value="consulta">Consulta Medica</option>
                                </select>
                            </td>
                            
                            <td id="segunTipoDeOperacion"></td>
                            
                            <td id="nombresDoctores"></td>                            
                            
                            <td id="mostrarTurnos"></td>
                        </tr>
                    </table>                
                </form>
            </section>
            
                <section id="container-buscar-resultados">
                <table id="container-buscar-resultados-table">
                        <form action="<?php echo constant('URL') . 'turnos/reservarTurno'; ?>" method="post">
                                <!-- recorrer rango de fechas -->
                            <?
                            
                                if(!empty($listadoDeTurnos)){
                                    echo "<tr>";
                                    echo "<td>Tipo de Turno</td>";
                                    echo "<td>Especializacion</td>";
                                    echo "<td>Nombre del Doctor</td>";
                                    echo "<td>Fechas de los Turnos</td>";
                                    echo "<td>Horas</td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                    for($i = 0; $i<count($listadoDeTurnos); $i++){
                                        $datetime = DateTime::createFromFormat('d/m/Y H:i:s', date_format(new DateTime($listadoDeTurnos[$i]), 'd/m/Y H:i:s'), new DateTimeZone('America/Argentina/San_Luis'));
                                        
                                        echo "<tr>";
                                        if($datosTurno[0] == 'consulta')
                                        {  
                                            echo "<td>" .   'Consulta Medica' . "</td>"; 
                                        }
                                        else
                                        { 
                                            echo "<td>" .   'Procedimiento' . "</td>"; 
                                            
                                        }
                                        echo "<td>" .  $datosTurno[1] . "</td>";

                                        echo "<td>" .  $doctorMatriculaNombre[$datosTurno[2]] . "</td>";
                                        
                                        echo "<td>" .  $datetime->format('d/m/Y') . "</td>";
                                        
                                        echo "<td>" .  $datetime->format('H:i:s') . "</td>";
                                        
                                        echo "<td>
                                            
                                            <a href=". constant('URL') . "turnos/reservarTurno?tipoturno=" . $datosTurno[0] . 
                                            "&turnoespecializacion=". str_replace(' ', '', $datosTurno[1])  ."&matriculadoctor=". $datosTurno[2] .
                                            "&fecha=". $datetime->format('Y-m-d') ."&hora=". $datetime->format('H:i:s') .">
                                            
                                            <input type='button' value='Reservar' name='".$i."' id='reservarTurno" . $i . "'>

                                            </a>

                                        </td>";
                                        echo "</tr>";
                                    }
                                    
                                }
                                
                            ?>
                        </form>
                        </table>
                    
            </section>
            
        </section>             
        
        <?require_once('views/footer.php');?>
</body>
<script>
    var mostrarTurnos = document.getElementById('mostrarTurnos');
    var segunTipoDeOperacion = document.getElementById('segunTipoDeOperacion')
    var puebas = document.getElementById('puebas');
    var doctorEspecializacionMatricula = JSON.parse(('<? echo json_encode($doctorEspecializacionMatricula); ?>'));
    var doctorMatriculaNombre = JSON.parse(('<? echo json_encode($doctorMatriculaNombre); ?>'));

    //[ { "Traumatología": "825772690" }, { "Nutricionista": "898030585" }, 
    //"825772690": "Dr. Cupaiouolo Carlos", "898030585": "Dr. Gauna Anibal"
    
    
    function mostrarProcedimientos(){
        var selected = document.getElementById('tipoDeOperacion').value;
        
        if(selected == 'procedimiento'){
            nombresDoctores.innerHTML = "";
            segunTipoDeOperacion.innerHTML = "<select name='especializaciones' id='selectedTipo' onchange='mostrarNombres()' > <option value='-'> - </option> <?for($i=0; $i<count($procedimientos); $i++){echo "<option value='". $procedimientos[$i]->getNombre() ."'>" . $procedimientos[$i]->getNombre() . "</option>";}?></select>";
        }
        if(selected == 'consulta'){
            nombresDoctores.innerHTML = "";
            segunTipoDeOperacion.innerHTML = "<select name='especializaciones' id='selectedTipo' onchange='mostrarNombres()' > <option value='-'> - </option> <?for($i=0; $i<count($especializaciones); $i++){echo "<option value='". $especializaciones[$i]->getEspecializacion() ."'>" . $especializaciones[$i]->getEspecializacion() . "</option>";}?> </select>";
        }
        if(selected == '-'){
            segunTipoDeOperacion.innerHTML = "";
            nombresDoctores.innerHTML = "";
            mostrarTurnos.innerHTML = "";
        }
        
    }

    function mostrarNombres(){
        var selectedTipo = document.getElementById('selectedTipo').value;
        nombresDoctores.innerHTML = "<select name='nombreDoctor' id='nombreDoctor'> </select>";

        agregarNombres = document.getElementById('nombreDoctor');

        if(selectedTipo == '-'){
            nombresDoctores.innerHTML = "";
            mostrarTurnos.innerHTML = "";
        }

        for(x of doctorEspecializacionMatricula){
            var matricula;
            if(x[selectedTipo]!=undefined){
                matricula = x[selectedTipo];           
                agregarNombres.innerHTML += "<option value='"+ matricula +"'> "+ doctorMatriculaNombre[matricula] +" </option>";
            }
        }
        if(selectedTipo != '-'){
            mostrarTurnos.innerHTML = "<input type='submit' value='Mostrar Turnos'>";
        }
    }
    
</script>
</html>