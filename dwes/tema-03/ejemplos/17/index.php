<?php

/*
    función array_keys()
*/

$array_equipo = array(
    'portero',
    'laterales',
    'centrales',
    'mediocentros',
    'interiores',
    'delanteros'
);

$array_indices = array_keys($array_equipo);

// Devuelve los índices de un array, sean numerales o asociativos ej: 'id'
print_r($array_indices);