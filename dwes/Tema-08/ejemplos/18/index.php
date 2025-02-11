<?php

$alumnos = [
    [1, 'Carlos', 'Gómez Pérez', '1DAW', 'Madrid'],
    [2, 'Laura', 'Martínez López', '2SMR', 'Sevilla'],
    [3, 'David', 'Fernández Ruiz', '1AD', 'Barcelona']
];

print_r($alumnos);

//  Creamo el fichero csv
$fichero = fopen('csv/alumnos.csv', 'wB');

// Escribimos los datos en el fichero
foreach ($alumnos as $alumno) {
    fputcsv($fichero, $alumno, ';');
}

// Cerramos el fichero
fclose($fichero);


echo "Fichero creado correctamente";