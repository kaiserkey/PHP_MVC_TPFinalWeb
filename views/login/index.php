<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Login</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="<? echo constant('URL');?>assets/css/generalStyle.css" rel="stylesheet">
        <link rel="shortcut icon" href="<? echo constant('URL');?>assets/img/favicon-32x32.png" type="image/x-icon">
    </head>
    <body id="container">
    <?require_once('views/header.php');?>
    <div id="login-max">
    <section class="login-container">
            <?  $this->showMessages(); ?>
            <form action="<? echo constant('URL');?>login/authenticate" method="post">
                <table class="login-table">
                    <tr>
                        <th colspan="2"><h1>Inicio De Sesion</h1></th>
                    </tr>
                    <tr>
                        <td><label for="dni">DNI</label></td>
                        <td><input type="number" name="dni" id="dni" class="login-input" required></td>
                    </tr>
                    <tr>
                        <td><label for="password">Password</label></td>
                        <td><input type="password" name="password" id="password" class="login-input" required></td>
                    </tr>
                    <tr>
                        <td colspan="2" id="login-centrar"><input type="submit" value="Entrar" class="login-entrar"></td>
                    </tr>
                    <tr>
                        <td colspan="2" id="login-centrar"> <p>¿No Tienes Cuenta?</p> <a href="<? echo constant('URL') . 'signup'; ?>" class="login-registrarse">Registrarse</a></td>
                    </tr>
                </table>
            </form>
        </section>
    </div>

    <?require_once('views/footer.php');?>
    </body>
</html>