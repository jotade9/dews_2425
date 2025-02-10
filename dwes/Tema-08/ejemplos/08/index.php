<?php

    /*
        Ver los metadatos de un archivo

        - stat(): Devuelve información sobre un archivo
    */

    // Acceso a la ruta del archivo
    $ruta = 'files';
    $archivo = 'archivo.txt';

    $ruta = $ruta . '/' . $archivo; // Por si me dan la ruta y el archivo por separado

    // Obtener los metadatos del archivo
    $metadatos = stat($ruta); // Los devuelve en forma de array

    // Mostrar los metadatos
    echo '<pre>';
    print_r($metadatos);
    echo '</pre>';
