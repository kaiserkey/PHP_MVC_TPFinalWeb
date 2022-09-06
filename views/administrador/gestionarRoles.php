<?php
    //recibimos los datos para poder mostrarselos al usuario en la sesion actual
    $paciente = $this->d['paciente'];
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
        <section id="container-buscar-principal">
            <section id="container-buscar-turnos">
                <table id="container-buscar-table">
                    <form action="<?php echo constant('URL') . 'gestionarRoles/buscar'; ?>" method="post">
                        <tr>
                            <th colspan="2"><label for="buscar">Buscar Usuarios</label></th>
                        </tr>
                        <tr>
                            <td><input type="number" name="buscar" id="buscar">
                            <input type="submit" value="Buscar"></td>
                        </tr>
                    </form>
                </table>
            </section>
            <section id="container-buscar-resultados-administrador"> 
                        <?
                            if(!empty($paciente)){
                                for($i=0; $i<count($paciente);$i++){
                                    echo "<form action='" . constant('URL'). "gestionarRoles/cambiarRol' method='post'>";
                                    echo "<table id='container-buscar-resultados-table-administrador'>";
                                    echo "<tr>";
                                    echo "<th>DNI</th>";
                                    echo "<th>Nombre</td>";
                                    echo "<th>Direccion</td>";
                                    echo "<th>Fecha De Nacimiento</td>";
                                    echo "<th>Celular</th>";
                                    echo "<th>Email</td>";
                                    echo "<th>Rol</th>";
                                    echo "</tr>";
                                    echo "<tr>";
                                    echo "<td>".$paciente[$i]->getDni()."</td>";
                                    echo "<input type='hidden' name='dni' value='".$paciente[$i]->getDni()."'>";
                                    echo "<td>".$paciente[$i]->getNombre() . ' '. $paciente[$i]->getApellido() ."</td>";
                                    echo "<td>".$paciente[$i]->getDireccion()."</td>";
                                    echo "<td>".$paciente[$i]->getFechaNac()."</td>";
                                    echo "<td>".$paciente[$i]->getCelular()."</td>";
                                    echo "<td>".$paciente[$i]->getEmail()."</td>";
                                    echo "<td id='rol".$i."'>".$paciente[$i]->getRol()."</td>";
                                    echo "<td id='cambiarRol".$i."'><input type='button' value='Cambiar Rol' onclick='cambiarRol(".$i.")'></td>";
                                    echo "</tr>";
                                    echo "</table>";
                                    echo "</form>";
                                    
                                }
                            }
                        ?>
                
            </section>
        </section>
        <script>
            function cambiarRol(n){
                elemento = document.getElementById('rol'+n)
                boton = document.getElementById('cambiarRol'+n)

                elemento.innerHTML = "<select name='rol' id='rol'>"+
                "<option value='administrador'>Administrador</option>"+
                "<option value='admision'>Admision</option>"+
                "<option value='paciente'>Paciente</option>"+
                "</select>"

                boton.innerHTML="<input type='submit' value='Cambiar'>"
            }
        </script>
        <?require_once('views/footer.php');?>
    </body>
</html>