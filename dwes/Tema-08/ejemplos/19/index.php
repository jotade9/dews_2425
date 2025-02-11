<?php

//  Creamo el fichero csv
$fichero = fopen('csv/alumnos.csv', 'rB');

// Leemos los datos del fichero
while ($alumno = fgetcsv($fichero, 0, ';')) {
    echo '<pre>';
    print_r($alumno);
    echo '</pre>';
}

// Cerramos el fichero
fclose($fichero);


