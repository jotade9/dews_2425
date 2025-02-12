<?php
/**
 * hacer saber si archivo.txt es fichero o directorio
 */
$ruta='files';
$archivo='archivo.txt';

$ruta=$ruta.'/'.$archivo;
if (is_file($ruta)) {
    echo "Es un fichero";
} elseif (is_dir($ruta)) {
    echo "Es un directorio";
} else {
    echo "No es ni fichero ni directorio";
}

echo "Directorio actual: ".getcwd();

$dir=opendir('files');

echo 'Archivos en el directorio:<br>';

//leer $directorio
while ($archivo=readdir($dir)) {
    if (is_file('files/'.$archivo)) {
        echo 'Archivo: '. $archivo.' - '.filesize('files/'.$archivo).' bytes<br>';
    }else{
        echo 'Directorio: '. $archivo.'<br>';
    }
}
closedir($dir);