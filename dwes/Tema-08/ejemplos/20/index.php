<?php 

/*
    Crerar archivo comprimido con la clase ZipArchive

    La clase ZipArchive permite crear archivos comprimidos en formato Zip

    Proceso:
    - Crear archivo Zip
    - Añadir
    - Cerrar archivo

*/

$zipFile = 'archivo.zip';

$zip = new ZipArchive();

if($zip->open($zipFile, ZipArchive::CREATE) === TRUE){

    $zip ->addFile('files/933-536x354.jpg');
    $zip->addFile('files/Tema8.pdf');

    //Cerrar archivo ZIP 
    $zip -> close();
}else{
    echo 'Error al crear archivo ZIP';
}

//Descargar
header('Content-Type: application/zip');
header('Content-Disposition: attachment; filename="' . basename($zipFile) . '"');
header('Content-Length: ' . filesize($zipFile));

// Leer el archivo y enviarlo al navegador
readfile($zipFile);