<?php

/*
   Manejo de directorios

   

   Funciones:
    - chdir: Cambia el directorio actual
    - getcwd : directorio actual
    - mkdir: Crear directorio
    - rmdir : eliminar directorio
    - glob: acceder al contenido del directorio
    - dirname: devuelve el directorio padre de la ruta establecida
    - is_dir: determina si es un directorio
    - pathinfo: devuelve información sobre ruta de un archivo
    - basename: devuelve el nombre del directorio actual
    - unlink: eliminar un archivo

*/

// ruta completa directorio actual
echo 'Ruta completa directorio actual:' . getcwd() . '<br>';

// nombre del directorio
echo 'Directorio Actual:' . basename(getcwd()) . '<br>';

// directorio padre del directorio actual
echo 'Directorio Padre del actual:' . dirname(getcwd()) . '<br>';


//Cambiamos como directorio actual
chdir('files');

//mostramos detalles con pathinfo
print_r( pathinfo('archivos_pdf/Tema 08 -Gestión de Archivos y Directorios.pdf'));