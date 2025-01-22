<?php
session_start();

// Actualiza visitas a la página
$_SESSION['page_visits']['services']++;
$_SESSION['visits']++;

// Muestra la información
echo "<h1>Services</h1>";
echo "<p>SID de la sesión: " . $_SESSION['sid'] . "</p>";
echo "<p>Nombre de la sesión: " . $_SESSION['name'] . "</p>";
echo "<p>Fecha y hora de inicio de la sesión: " . $_SESSION['start_time'] . "</p>";
echo "<p>Visitas a esta página durante la sesión: " . $_SESSION['page_visits']['services'] . "</p>";

// Menú de navegación
echo '<nav>
        <a href="index.php">Home</a>
        <a href="about.php">About</a>
        <a href="services.php">Services</a>
        <a href="events.php">Events</a>
        <a href="close.php">Close</a>
      </nav>';
?>
