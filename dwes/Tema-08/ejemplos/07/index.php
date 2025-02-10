<?php

    /*
        Leer archivo como array

        - fgets(): Lee una línea de un archivo
    */

    // Abrir archivo en modo lectura
    $archivo = fopen('archivo.txt', 'r');

    // Valido apertura del archivo
    if (!$archivo) {
        // Mensaje de error
        die('No se pudo abrir el archivo');
    }

    $lineas = [];

    // Recorro el archivo línea por línea
    while (!feof($archivo)) {
        // Leer línea
        $linea = fgets($archivo);
    }

    // Cierro el archivo
    fclose($archivo);
    
    // Imprimo el contenido
    echo '<pre>';
    print_r($lineas);
    echo '</pre>';