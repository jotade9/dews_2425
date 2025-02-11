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

// ruta completa directorio actual
echo 'Ruta completa directorio actual:' . getcwd() . '<br>';

// nombre del directorio
echo 'Directorio Actual:' . basename(getcwd()) . '<br>';

// directorio padre del directorio actual
echo 'Directorio Padre del actual:' . dirname(getcwd()) . '<br>';

//Modificar el nombre de una carpeta
//pdf -> archivos_pdf
rename('pdf', 'archivos_pdf');


$files = glob('*');
echo "<pre>";
print_r($files);
echo "<pre>";

//Crear la carpeta imagenes
//mkdir('imagenes');

$files = glob('*');
echo "<pre>";
print_r($files);
echo "<pre>";

//Eliminar la carpeta txt_new
//Entro en la carpeta txt_new
chdir('txt_new');

//Eliminar todos los archivos
$files = glob('*');

foreach($files as $file){
    if(is_file($file)){
    unlink($file);
    }else{
        rmdir($file);
    }
}

//Pongo directorio activo el directorio padre
chdir('..');

//Elimino la carpeta
rmdir('txt_new');

echo 'carpeta eliminada correctamente';









/*
//ver contenido del directorio files con glob
$files = glob('files/*.*');

//muestro el contenido
echo '<pre>';
print_r($files);
echo '<pre>';
*/


