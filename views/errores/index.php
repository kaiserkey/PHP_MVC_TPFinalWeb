<!DOCTYPE html>
<html lang="es">
<head>
    <title>Error 404</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<? echo constant('URL');?>assets/css/generalStyle.css" rel="stylesheet">
    <link rel="shortcut icon" href="<? echo constant('URL');?>assets/img/favicon-32x32.png" type="image/x-icon">
</head>
<body id="container">
<?require_once('views/header.php');?>
    <section id="error404">
        <img src="<? echo constant('URL');?>assets\img\Error-404.webp" alt="Error 404">
    </section>
<?require_once('views/footer.php');?>
</body>
</html>