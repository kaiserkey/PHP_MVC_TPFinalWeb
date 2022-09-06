<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Inicio</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="<? echo constant('URL');?>assets/css/generalStyle.css" rel="stylesheet">
        <link rel="shortcut icon" href="<? echo constant('URL');?>assets/img/favicon-32x32.png" type="image/x-icon">
    </head>
    <body id="container">
    <?require_once('views/header.php');?>
        <section id="mensaje-usuario">
                <h1>PERSONAL DE SALUD AGRADECE</h1>
                <p>
                    La tercera ola de contagios COVID 19 llegó con cifras que multiplican las 
                    récords de casos registrados en muy poco tiempo, lo que provocó un desborde de 
                    la demanda y por ende impactó fuertemente en el sistema de salud. En estos momentos 
                    nos encontramos bajo tensión por sobredemanda en atención médica e hisopados en GUARDIAS, 
                    la más alta desde que comenzó la pandemia. A diferencia de las olas anteriores, el nivel 
                    de respuesta de la vacunación actual en la población, permite se reduzcan las internaciones 
                    “críticas” ya que aún con un nivel de contagiosidad mayor, esta tercera ola no estaría 
                    impactando de la misma forma que lo hizo en su comienzo, la variante delta. Por el pico de 
                    contagios y sospecha de diagnóstico COVID, la demanda de atención en nuestra Clinica, 
                    se incrementó en un 1000%. Cualquier sistema de atención de salud se tensiona con esta sobredemanda porque 
                    además también nosotros como equipo de salud, nos contagiamos. Por eso recordamos 
                    la importancia de cuidarse en forma responsable, aislarse en casos confirmados y 
                    solo requerir hisopados, en caso que el médico lo indique a fin de no saturar los 
                    sistemas de emergencias. Sabemos que la demanda creciente, genera cuellos de botella en 
                    la atención y desde ya pedimos disculpas por las molestias ocasionadas. Hoy más que nunca 
                    agradecemos al equipo de trabajo su compromiso y vocación y a los pacientes que así lo 
                    valoran y nos lo hacen saber amorosamente. Creemos que es en estos momentos álgidos cuando 
                    se muestra de qué estamos hechos.
                </p>
                <h2>GRACIAS POR ACOMPAÑAR AL PERSONAL DE SALUD en estos momentos.</h2>
                <h2>Y ¡GRACIAS a cada integrante del equipo que lo hace posible, dándolo todo!</h2>
            </section>
        <section class="inicio-section1">
            <h1 class="inicio-titulo">NUESTRA MISIÓN</h1>
            <p class="inicio-texto">
                Proporcionar asistencia sanitaria especializada de calidad a los habitantes de la provincia de Neuquén, contribuyendo a satisfacer las necesidades de salud y el bienestar de la comunidad.
                Desarrollar nuestra vocación docente e investigadora, aportando en la capacitación de futuros profesionales especialistas.
                Brindar en nuestros servicios equidad, eficiencia, excelencia y calidad.
            </p>
        </section>
        <section class="inicio-section2">
            <h1 class="inicio-titulo">NUESTRA VISIÓN</h1>
            <p class="inicio-texto">
                Queremos ser un lugar de referencia, que proporcione soluciones a sus problemas de salud de la manera más eficiente posible.
                Queremos ser para los profesionales un lugar de trabajo atractivo, valorado por la eficacia clínica, el nivel tecnológico y una gestión de calidad.
                Queremos ser, para las Instituciones y Organizaciones de nuestro entorno, un colaborador necesario para mejorar la calidad de vida de los ciudadanos y el bienestar de la Comunidad.
            </p>
        </section>
        <section class="inicio-section3">
            <h1 class="inicio-titulo">NUESTROS VALORES</h1>
            <h1 class="inicio-titulo">COMPROMISO CON EL PACIENTE</h1>
            <ul>
                <li>Consideración integral del paciente</li>
                <li>Eficacia clínica</li>
                <li>Atención y trato personalizado</li>
                <li>Información adecuada</li>
            </ul>
            <h1 class="inicio-titulo">PROFESIONALIDAD</h1>
            <ul>
                <li>Desarrollo de las competencias profesionales</li>
                <li>Actualización permanente de los conocimientos</li>
                <li>Ética profesional</li>
            </ul>
        </section>
    <?require_once('views/footer.php');?>
    </body>
</html>