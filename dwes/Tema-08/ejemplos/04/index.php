<?php

    /*
        Leer archivo

        - fread(): Lee un archivo
    */

    // Abrir archivo
    $archivo = fopen("archivo.txt", "r");

    // Valido apertura del archivo
    if (!$archivo) {
        // Mensaje de error
        echo "No se pudo abrir el archivo";
        exit();
    }

    // Leer archivo completo
    $contenido = fread($archivo, 20);

    // Mostrar contenido con saltos de línea
    echo nl2br($contenido); // nl2br() convierte saltos de línea en <br>

    // Cerrar archivo
    fclose($archivo);