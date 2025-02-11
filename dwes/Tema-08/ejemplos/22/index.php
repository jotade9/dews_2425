<?php 

/*
    Descomprimir un archivo zip

*/

$zipFile = 'files.zip';

$zip = new ZipArchive();

if($zip->open($zipFile) === FALSE){

        echo 'Error al abrir el archivo ZIP';
        exit;
}

// Extraer el contenido del archivo ZIP
$zip->extractTo('files');

// Cerrar archivo ZIP
$zip->close();

//Mensaje de exito
echo 'Archivo descomprimido correctamente';