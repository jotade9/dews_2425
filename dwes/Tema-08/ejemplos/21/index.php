<?php

    /*
        Crear archivo comprimido con la clase ZipArchive

        La clase ZipArchive permite crear archivos comprimidos en formato zip

        Funciones: 
            - Crear archivo zip
            - Añadir ficheros al archivo zip
            - Cerrar archivo zip
    */

    // Nombre del archivo zip
    $zipFile = 'files.zip';

    // Crear objeto ZipArchive
    $zip = new ZipArchive();

    // Crear archivo zip
    if ($zip->open($zipFile, ZipArchive::CREATE) === FALSE) {
        echo 'Error al crear el archivo ZIP';
        exit();
    }
    
    // Añadir ficheros al archivo ZIP
    $files = glob('files/*');

    // Recorro todo el array de archivos y los añado al archivo zip
    foreach ($files as $file) {
        $zip->addFile($file, basename($file));
    }

    // Cerrar archivo ZIP
    $zip->close();