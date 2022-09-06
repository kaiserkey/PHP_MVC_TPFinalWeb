<header id="header">
<nav >
    <ul>
        <?
            if(empty($_SESSION)){

                echo "<li>";
                echo "<a href='";
                echo constant('URL') . 'inicio';
                echo "'>";
                echo "Inicio";
                echo "</a>";
                echo "</li>";

                echo "<li>";
                echo "<a href='";
                echo constant('URL') . 'areas';
                echo "'>";
                echo "Areas Asistenciales";
                echo "</a>";
                echo "</li>";

                echo "<li>";
                echo "<a href='";
                echo constant('URL') . 'obrassociales';
                echo "'>";
                echo "Obras Sociales";
                echo "</a>";
                echo "</li>";
            }

            if(isset($_SESSION['paciente'])){
                echo "<li>";
                echo "<a href='";
                echo constant('URL') . 'inicioLog';
                echo "'>";
                echo "Inicio";
                echo "</a>";
                echo "</li>";

                echo "<li>";
                echo "<a href='";
                echo constant('URL') . 'areasLog';
                echo "'>";
                echo "Areas Asistenciales";
                echo "</a>";
                echo "</li>";

                echo "<li>";
                echo "<a href='";
                echo constant('URL') . 'obrassocialesLog';
                echo "'>";
                echo "Obras Sociales";
                echo "</a>";
                echo "</li>";

                echo "<li>";
                echo "<a href='";
                echo constant('URL') . 'dashboard';
                echo "'>";
                echo "Resumen";
                echo "</a>";
                echo "</li>";

                echo "<li>";
                echo "<a href='";
                echo constant('URL') . 'turnos';
                echo "'>";
                echo "Turnos";
                echo "</a>";
                echo "</li>";
    
                echo "<li>";
                echo "<a href='";
                echo constant('URL') . 'paciente';
                echo "'>";
                echo "Mis Datos";
                echo "</a>";
                echo "</li>";

                echo "<li id='login-align'>";
                echo "<a href='";
                echo constant('URL') . 'dashboard/salir';
                echo "'>";
                echo "Salir";
                echo "</a>";
                echo "</li>";
            }
            if(isset($_SESSION['administrador'])){
                echo "<li>";
                echo "<a href='";
                echo constant('URL') . 'inicioLog';
                echo "'>";
                echo "Inicio";
                echo "</a>";
                echo "</li>";

                echo "<li>";
                echo "<a href='";
                echo constant('URL') . 'areasLog';
                echo "'>";
                echo "Areas Asistenciales";
                echo "</a>";
                echo "</li>";

                echo "<li>";
                echo "<a href='";
                echo constant('URL') . 'obrassocialesLog';
                echo "'>";
                echo "Obras Sociales";
                echo "</a>";
                echo "</li>";

                echo "<li>";
                echo "<a href='";
                echo constant('URL') . 'gestionarAgendas';
                echo "'>";
                echo "Gestionar Agendas";
                echo "</a>";
                echo "</li>";

                echo "<li>";
                echo "<a href='";
                echo constant('URL') . 'buscarDatos';
                echo "'>";
                echo "Buscar Datos";
                echo "</a>";
                echo "</li>";

                echo "<li id='login-align'>";
                echo "<a href='";
                echo constant('URL') . 'gestionarAgendas/salir';
                echo "'>";
                echo "Salir";
                echo "</a>";
                echo "</li>";

                echo "<li>";
                echo "<a href='";
                echo constant('URL') . 'gestionarRoles';
                echo "'>";
                echo "Gestionar Usuarios";
                echo "</a>";
                echo "</li>";
            }
            if(isset($_SESSION['administracion'])){
                echo "<li>";
                echo "<a href='";
                echo constant('URL') . 'inicioLog';
                echo "'>";
                echo "Inicio";
                echo "</a>";
                echo "</li>";

                echo "<li>";
                echo "<a href='";
                echo constant('URL') . 'areasLog';
                echo "'>";
                echo "Areas Asistenciales";
                echo "</a>";
                echo "</li>";

                echo "<li>";
                echo "<a href='";
                echo constant('URL') . 'obrassocialesLog';
                echo "'>";
                echo "Obras Sociales";
                echo "</a>";
                echo "</li>";

                echo "<li>";
                echo "<a href='";
                echo constant('URL') . 'administrarTurnos';
                echo "'>";
                echo "Administrar Turnos";
                echo "</a>";
                echo "</li>";

                echo "<li>";
                echo "<a href='";
                echo constant('URL') . 'buscarPacientes';
                echo "'>";
                echo "Buscar Pacientes";
                echo "</a>";
                echo "</li>";

                echo "<li>";
                echo "<a href='";
                echo constant('URL') . 'reservarTurnos';
                echo "'>";
                echo "Reservar Turnos";
                echo "</a>";
                echo "</li>";

                echo "<li id='login-align'>";
                echo "<a href='";
                echo constant('URL') . 'administrarTurnos/salir';
                echo "'>";
                echo "Salir";
                echo "</a>";
                echo "</li>";
            }
        ?>
        <li id="login-align"><a href="<? echo constant('URL') ?>">Login</a></li>
    </ul>
</nav>
</header>