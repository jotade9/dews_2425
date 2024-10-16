<?php

/**
 * 
 * model.index.php
 * 
 * crear tabla
 * 
 * Array bidimensional
 * 
 * indice primario: numerico
 * indice secundario: asociativo
 */

$libros = [
    [
        'id' => 1,
        'titulo' => 'Los señores del tiempo',
        'autor' => 'García Sénz de Urturi',
        'genero' => 'Novela',
        'precio' => number_format(19.5, 2, ',', '.')
    ],
    [
        'id' => 2,
        'titulo' => 'El Rey recibe',
        'autor' => 'Eduardo Mendoza',
        'genero' => 'Novela',
        'precio' => number_format(20.5, 2, ',', '.')
    ],
    [
        'id' => 3,
        'titulo' => 'Diario de una mujer',
        'autor' => 'Eduardo Mendoza',
        'genero' => 'Juvenil',
        'precio' => number_format(12.95, 2, ',', '.')
    ],
    [
        'id' => 4,
        'titulo' => 'El Quijote de la Mancha',
        'autor' => 'Miguel de Cervantes',
        'genero' => 'Novela',
        'precio' => number_format(15.95, 2, ',', '.')
    ]
];
