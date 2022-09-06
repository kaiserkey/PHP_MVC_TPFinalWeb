<?php
    //recibimos los datos para poder mostrarselos al usuario en la sesion actual
    $paciente = $this->d['paciente'];
?>

<! DOCTYPE html>
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
        <section id="container-buscar-principal">
            <section id="container-buscar-turnos">
                <table id="container-buscar-table">
                    <form action="<?php echo constant('URL') . 'buscarPacientes/buscar'; ?>" method="post">
                        <tr>
                            <th colspan="2"><label for="buscar">Buscar Paciente</label></th>
                        </tr>
                        <tr>
                            <td><input type="number" name="buscar" id="buscar">
                                <input type="submit" value="Buscar">
                            </td>
                        </tr>
                    </form>
                </table>
            </section>
            <section id="container-buscar-resultados-admin">
                <table id="container-buscar-resultados-table-admin">
                    <?
                            if(!empty($paciente)){
                                echo "<tr>";
                                echo "<td>DNI</td>";
                                echo "<td>Nombre</td>";
                                echo "<td>Direccion</td>";
                                echo "<td>Fecha De Nacimiento</td>";
                                echo "<td>Celular</td>";
                                echo "<td>Email</td>";
                                echo "<td>Obra Social</td>";
                                echo "</tr>";
                                for($i=0; $i<count($paciente);$i++){
                                    echo "<tr>";
                                    echo "<td>".$paciente[$i]->getDni()."</td>";
                                    echo "<td>".$paciente[$i]->getNombre() . ' '. $paciente[$i]->getApellido() ."</td>";
                                    echo "<td>".$paciente[$i]->getDireccion()."</td>";
                                    echo "<td>".$paciente[$i]->getFechaNac()."</td>";
                                    echo "<td>".$paciente[$i]->getCelular()."</td>";
                                    echo "<td>".$paciente[$i]->getEmail()."</td>";
                                    echo "<td>".$paciente[$i]->getObraSocial()."</td>";
                                    echo "</tr>";
                                }
                            }
                        ?>
                </table>
            </section>
        </section>
        <?require_once('views/footer.php');?>
    </body>

    </html>