<?php

echo 'Directorio actual: '. getcwd() . '<br>';

$files=scandir('files',1);

//Muestra el contenifo del directorio files
echo '<pre>';
print_r($files);
echo '</pre>';

//Muestra el contenido de los archivos
foreach ($files as $file) {
    if (is_file('files/'.$file)) {
        echo '<h2> Archivo: '.$file.'</h2>';
    }else{
        echo '<h2> Directorio: '.$file.'</h2>';
    }
}