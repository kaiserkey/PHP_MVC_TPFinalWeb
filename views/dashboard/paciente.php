<?php
    //recibimos los datos para poder mostrar el usuario en la sesion sesion actual
    $userPaciente = $this->d['userPaciente'];
    $obraSocial = $this->d['obraSocialDB'];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <title>
        <? echo $userPaciente->getNombre() . ' ' . $userPaciente->getApellido(); ?>
    </title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<? echo constant('URL');?>assets/css/generalStyle.css" rel="stylesheet">
    <link rel="shortcut icon" href="<? echo constant('URL');?>assets/img/favicon-32x32.png" type="image/x-icon">
</head>

<body>

    <body id="container">
        <?require_once('views/header.php');?>
        <?  $this->showMessages(); ?>
        <section id="container-datos-paciente">
            <div id="datos-paciente-titulo">
                <h1>Seccion de Datos Personales</h1>
                <div id="logo-container">
                    <img src="
                            <?
                                if($userPaciente->getSexo()=='Masculino'){
                                    echo constant('URL') . 'assets/img/user1.jpg';
                                }else{
                                    echo constant('URL') . 'assets/img/user2.jpg';
                                }
                            ?>
                        " alt="logodelpaciente" id="datos-logo">
                </div>

            </div>
            <form action='<? echo constant(' URL'). 'paciente/actualizarDatos' ?>' method='post'>
                <table id="table-datos-paciente">
                    <tr>
                        <th colspan="3">
                            <? echo $userPaciente->getNombre() . ' ' . $userPaciente->getApellido(); ?>
                        </th>
                    </tr>
                    <tr>
                        <td>DNI: </td>
                        <td>
                            <? echo $userPaciente->getDni() ?>
                        </td>
                        <td></td>
                        <td></td>
                    </tr>

                    <tr>
                        <td>Actualizar Contraseña</td>
                        <td></td>
                        <td><input type="button" value="Cambiar" onclick="actualizarPass()"></td>
                        <td id="cancelar1"></td>
                    </tr>
                    <!-- Actualizar Password -->
                    <tr id="tituloPass">
                    </tr>
                    <tr id="newPassword">
                    </tr>
                    <tr id="botonActualizarPass">
                    </tr>
                    <tr>
                        <td>Direccion</td>
                        <td>
                            <? echo $userPaciente->getDireccion() ?>
                        </td>
                        <td><input type="button" value="Cambiar" onclick="actualizarDireccion()"></td>
                        <td id="cancelar2"></td>
                    </tr>
                    <!-- Actualizar Direccion -->
                    <tr id="newDir">
                    </tr>
                    <tr>
                    <tr>
                        <td>Celular</td>
                        <td>
                            <? echo $userPaciente->getCelular() ?>
                        </td>
                        <td><input type="button" value="Cambiar" onclick="actualizarCelular()"></td>
                        <td id="cancelar3"></td>
                    </tr>
                    <!-- Actualizar Celular -->
                    <tr id="newCel">
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>
                            <? echo $userPaciente->getEmail() ?>
                        </td>
                        <td><input type="button" value="Cambiar" onclick="actualizarEmail()"></td>
                        <td id="cancelar4"></td>
                    </tr>
                    <!-- Actualizar Email -->
                    <tr id="newEmail">
                    </tr>
                    <tr>
                        <td>Grupo Sanguineo</td>
                        <td>
                            <? echo $userPaciente->getGrupoSanguineo() ?>
                        </td>
                        <td><input type="button" value="Cambiar" onclick="actualizarGS()"></td>
                        <td id="cancelar5"></td>
                    </tr>
                    <!-- Actualizar Grupo Sanguineo -->
                    <tr id="newGS">
                    </tr>
                    <tr>
                        <td>Sexo</td>
                        <td>
                            <? echo $userPaciente->getSexo() ?>
                        </td>
                        <td><input type="button" value="Cambiar" onclick="actualizarSexo()"></td>
                        <td id="cancelar6"></td>
                    </tr>
                    <!-- Actualizar Sexo -->
                    <tr id="newSexo">
                    </tr>
                    <tr>
                        <td>Fecha De Nacimiento</td>
                        <td>
                            <? echo $userPaciente->getFechaNac() ?>
                        </td>
                        <td><input type="button" value="Cambiar" onclick="actualizarFechaNac()"></td>
                        <td id="cancelar7"></td>
                    </tr>
                    <!-- Actualizar Fecha de Naciento -->
                    <tr id="newFechaNac">
                    </tr>
                    <tr>
                        <td>Obra Social</td>
                        <td>
                            <? echo $userPaciente->getObraSocial() ?>
                        </td>
                        <td><input type="button" value="Cambiar" onclick="actualizarObraSocial()"></td>
                        <td id="cancelar8"></td>
                    </tr>
                    <!-- Actualizar Celular -->
                    <tr id="newOS">
                    </tr>
                </table>
            </form>
        </section>




        <?require_once('views/footer.php');?>
        <script>
        var newPassword = document.getElementById('newPassword')
        var titulosPass = document.getElementById('tituloPass')
        var botonActualizarPass = document.getElementById('botonActualizarPass')
        var cancelar1 = document.getElementById('cancelar1')
        var cancelar2 = document.getElementById('cancelar2')
        var cancelar3 = document.getElementById('cancelar3')
        var cancelar4 = document.getElementById('cancelar4')
        var cancelar5 = document.getElementById('cancelar5')
        var cancelar6 = document.getElementById('cancelar6')
        var cancelar7 = document.getElementById('cancelar7')
        var cancelar8 = document.getElementById('cancelar8')

        var newDir = document.getElementById('newDir');
        var newCel = document.getElementById('newCel');
        var newEmail = document.getElementById('newEmail');
        var newGS = document.getElementById('newGS');
        var newSexo = document.getElementById('newSexo');
        var newFechaNac = document.getElementById('newFechaNac');
        var newOS = document.getElementById('newOS');

        function cancelarEvento(n) {
            if (n == 1) {
                newPassword.innerHTML = ''
                titulosPass.innerHTML = ''
                botonActualizarPass.innerHTML = ''
                cancelar1.innerHTML = ''
            }

            if (n == 2) {
                newDir.innerHTML = ''
                cancelar2.innerHTML = ''
            }

            if (n == 3) {
                newCel.innerHTML = ''
                cancelar3.innerHTML = ''
            }

            if (n == 4) {
                newEmail.innerHTML = ''
                cancelar4.innerHTML = ''
            }

            if (n == 5) {
                newGS.innerHTML = ''
                cancelar5.innerHTML = ''
            }

            if (n == 6) {
                newSexo.innerHTML = ''
                cancelar6.innerHTML = ''
            }

            if (n == 7) {
                newFechaNac.innerHTML = ''
                cancelar7.innerHTML = ''
            }

            if (n == 8) {
                newOS.innerHTML = ''
                cancelar8.innerHTML = ''
            }
        }


        function actualizarPass() {
            newPassword.innerHTML =
                "<td ><input type='password' name='newP1' id='newP1' required></td> <td colspan='2'><input type='password' name='newP2' id='newP2' required></td> <td><input type='password' name='newP3' id='newP3' required></td>";
            titulosPass.innerHTML =
                "<td >Contraseña Actual</td> <td colspan='2'>Nueva Contraseña</td> <td>Repetir Nueva Contraseña</td>";
            botonActualizarPass.innerHTML = "<td colspan='4'><input type='submit' value='Actualizar'></td>"
            cancelar1.innerHTML = "<td><input type='button' value='Cancelar' onclick='cancelarEvento(1)'></td>"
        }

        function actualizarDireccion() {
            newDir.innerHTML =
                "<td>Nueva Direccion</td> <td> <input type='text' name='direccion' id='direccion' required> </td> <td colspan='2'><input type='submit' value='Actualizar'></td>";
            cancelar2.innerHTML = "<td><input type='button' value='Cancelar' onclick='cancelarEvento(2)'></td>"
        }

        function actualizarCelular() {
            newCel.innerHTML =
                "<td>Nueva Celular</td> <td> <input type='tel' name='celular' id='celular' required> </td> <td colspan='2'><input type='submit' value='Actualizar'></td>";
            cancelar3.innerHTML = "<td><input type='button' value='Cancelar' onclick='cancelarEvento(3)'></td>"
        }

        function actualizarEmail() {
            newEmail.innerHTML =
                "<td>Nuevo Email</td> <td> <input type='email' name='email' id='email' required> </td> <td colspan='2'><input type='submit' value='Actualizar'></td>";
            cancelar4.innerHTML = "<td><input type='button' value='Cancelar' onclick='cancelarEvento(4)'></td>"
        }

        function actualizarGS() {
            newGS.innerHTML =
                "<td>Nuevo Grupo Sanguineo</td> <td> <input type='text' name='gruposanguineo' id='gruposanguineo' required> </td> <td colspan='2'><input type='submit' value='Actualizar'></td>";
            cancelar5.innerHTML = "<td><input type='button' value='Cancelar' onclick='cancelarEvento(5)'></td>"
        }

        function actualizarSexo() {
            newSexo.innerHTML =
                "<td>Nuevo Sexo</td> <td> <select name='sexo' id='sexo'><option value='Femenino'>Femenino</option><option value='Masculino'>Masculino</option></select> </td> <td colspan='2'><input type='submit' value='Actualizar'></td>";
            cancelar6.innerHTML = "<td><input type='button' value='Cancelar' onclick='cancelarEvento(6)'></td>"
        }

        function actualizarFechaNac() {
            newFechaNac.innerHTML =
                "<td>Nueva Fecha de Nacimiento</td> <td> <input type='date' name='fecha' id='fecha' required> </td> <td colspan='2'><input type='submit' value='Actualizar'></td>";
            cancelar7.innerHTML = "<td><input type='button' value='Cancelar' onclick='cancelarEvento(7)'></td>"
        }

        function actualizarObraSocial() {
            newOS.innerHTML =
                "<td>Nueva Obra Social</td> <td> <select name='obrasocial' id='obrasocial'> <?foreach($obraSocial as $dato){echo " <
                option value = '" . $dato->getNombre() . "' > " . $dato->getNombre() ." < /option>";}?> </select > <
                /td> <td colspan='2'><input type='submit' value='Actualizar'></td > ";
            cancelar8.innerHTML = "<td><input type='button' value='Cancelar' onclick='cancelarEvento(8)'></td>"
        }
        </script>
    </body>

</html>