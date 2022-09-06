<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Registro De Pacientes</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="<? echo constant('URL');?>assets/css/generalStyle.css" rel="stylesheet">
        <link rel="shortcut icon" href="<? echo constant('URL');?>assets/img/favicon-32x32.png" type="image/x-icon">
    </head>
    <body id="container">
    <?require_once('views/header.php');?>
        <div id="signup-container">
        
            <?  $this->showMessages(); ?>
            
            <form action="<? echo constant('URL');?>/signup/newUser" method="post">

                <table class="signup-table">
                    <thead class="signup-head">
                        <tr>
                            <th colspan="2">Registro Para Nuevos Pacientes</th>
                        </tr>
                    </thead>
                    <tbody class="signup-body">
                        <tr>
                            <td class="signup-text">
                                <label for="nombre">Nombre/s: </label>
                            </td>
                            <td class="signup-input">
                                <input type="text" name="nombre" id="nombre" required>
                            </td>
                        </tr>
                        <tr>
                            <td class="signup-text">
                                <label for="apellido">Apellido/s: </label>
                            </td>
                            <td class="signup-input">
                                <input type="text" name="apellido" id="apellido" required>
                            </td>
                        </tr>
                        <tr>
                            <td class="signup-text">
                                <label for="password">Contraseña: </label>
                            </td>
                            <td class="signup-input">
                                <input type="password" name="password" id="password" required>
                            </td>
                        </tr>
                        <tr>
                            <td class="signup-text">
                                <label for="fecha_nacimiento">Fecha De Nacimiento: </label>
                            </td>
                            <td class="signup-input">
                                <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" required>
                            </td>
                        </tr>
                        <tr>
                            <td class="signup-text">
                                <label for="sexo">Sexo: </label></td>
                            <td class="signup-option">
                                <select name="sexo" id="sexo" required>
                                    <option value="Femenino">Femenino</option>
                                    <option value="Masculino">Masculino</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="signup-text">
                                <label for="dni">DNI(sin puntos): </label>
                            </td>
                            <td class="signup-input">
                                <input type="number" name="dni" id="dni" required>
                            </td>
                        </tr>
                        <tr>
                            <td class="signup-text">
                                <label for="email">email: </label>
                            </td>
                            <td class="signup-input">
                                <input type="email" name="email" id="email" required>
                            </td>
                        </tr>
                        <tr>
                            <td class="signup-text">
                                <label for="celular">Celular: </label>
                            </td>
                            <td class="signup-input">
                                <input type="tel" name="celular" id="celular" required>
                            </td>
                        </tr>
                        <tr>
                            <td class="signup-text">
                                <label for="direccion">Direccion: </label>
                            </td>
                            <td class="signup-input">
                                <input type="text" name="direccion" id="direccion" required>
                            </td>
                        </tr>
                        <tr >
                            <td colspan="2" id="submit-align">
                                <input type="submit" value="Registrarse" name="registrarse" class="signup-submit">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
        <?require_once('views/footer.php');?>
    </body>
</html>