<?php
/**
 * Operaciones basicas de archivos y directorios
 * chdir= Cambiar de directorio
 * getcwd= Obtener el directorio actual
 * mkdir= Crear un directorio
 * rmdir= Borrar un directorio
 * opendir= Abrir un directorio
 * readdir= Leer un directorio
 * closedir= Cerrar un directorio
 * rewinddir= Reiniciar un directorio
 * readdir= Leer un directorio
 * chrort= Cambiar los permisos de un archivo
 */
echo 'Directorio actual: '.getcwd().'<br>';

// Cambiar de directorio
chdir('files');
echo 'Directorio actual: '.getcwd().'<br>';

// Cambiar un directorio padre
chdir('..');
echo 'Directorio actual: '.getcwd().'<br>';

//mostrar contenido de un directorio
$directorio=dir('.');
while($archivo=$directorio->read()){
    echo $archivo.'<br>';
}
