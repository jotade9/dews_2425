<?php
    /*
        Ejemplo 1: Crear un archivo de texto plano

        Abrir, escribir y cerrar archivo
    */
    $archivo = fopen("archivo.txt", "a");
    if (!$archivo) {
        echo "No se pudo abrir el archivo";
        exit;
    }
    // Escribir en el archivo
    fwrite($archivo, "Hola mundo\n");
    fwrite($archivo, "Este es un archivo de texto\n");
    fwrite($archivo, "Soy el Pablo Macías Salguero\n");

    // Cerrar el archivo
    fclose($archivo);

    // Mensaje de éxito
    echo "Archivo creado";
