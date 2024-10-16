<?php

/*
Funcion inplode();
Convierte un array en una cadena
*/
$array_equipo = array(
    'portero',
    'laterales',
    'centrales',
    'mediocentros',
    'interiores',
    'delanteros'
);

$cadena_equipo = implode(";", $array_equipo);
echo "El equipo separaro por ';' es el siguiente: " . $cadena_equipo;

$cadena_equipo2 = implode($array_equipo);
echo "<br><br>El equipo sin parámetro string es el siguiente: " . $cadena_equipo2;