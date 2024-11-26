<?php

/**
 * Ejemplo clase mysqli_sql_exception
 * Estructura try{} catch{}
 * 
 *  */

// Conexión debase de datos fp
try {
    // Habilitar el modo de excepciones en mysqli.
    mysqli_report(MYSQLI_REPORT_ERROR, MYSQLI_REPORT_STRICT);

    // Conectamos a la base de datos
    $db = new mysqli('localhost', 'root', '', 'fp');

    // ejecutamos consulta de alumnos
    $result = $sb->query("select * from alumnos order by id");
} catch (mysqli_sql_exception $e) {
    echo "Mensaje: " . $e->getMessage();
    echo "<br>";
    echo "Line: " . $e->getLine();
    echo "<br>";
    echo "Line: " . $e->getFile();
    exit();
}

print_r($result->fetch_all(MYSQLI_ASSOC));
