<?php

    /*
        Leer archivo como array

        - file(): Lee un archivo y lo convierte en un array
    */

    // Abrir archivo en modo lectura
    $archivo = file("archivo.txt");

    // Muestro el array
    echo "<pre>";
    print_r($archivo);
    echo "</pre>";

    // Muestro sólo la ultima línea
    echo 'Ultima línea: ' . $archivo[count($archivo) - 1];
