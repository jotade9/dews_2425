<?php
session_start();

// Calcula la duración de la sesión
$end_time = date("Y-m-d H:i:s");
$duration = strtotime($end_time) - strtotime($_SESSION['start_time']);

// Muestra la información final
echo "<h1>Sesion Cerrada</h1>";
echo "<p>SID de la sesión: " . $_SESSION['sid'] . "</p>";
echo "<p>Nombre de la sesión: " . $_SESSION['name'] . "</p>";
echo "<p>Contador de visitas totales en la web: " . $_SESSION['visits'] . "</p>";
echo "<p>Fecha y hora de inicio de la sesión: " . $_SESSION['start_time'] . "</p>";
echo "<p>Fecha y hora de fin de la sesión: " . $end_time . "</p>";
echo "<p>Duración de la sesión: " . gmdate("H:i:s", $duration) . "</p>";

// Destruye la sesión
session_destroy();

// Menú de navegación
echo '<nav>
        <a href="index.php">Home</a>
      </nav>';
?>
