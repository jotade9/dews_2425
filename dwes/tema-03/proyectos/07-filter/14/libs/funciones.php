<?php

/**
 * Librería proyecto 31CRUD alumnos
 */

# Obtiene la tabla de alumnos

 function get_tabla_alumnos (){

    $tabla = [
        [
            'id' => 1,
            'nombre' => 'Juan',
            'poblacion' => 'Villamartin',
            'curso' => '2DAW'
        ],
        [
            'id' => 2,
            'nombre' => 'Maria',
            'poblacion' => 'Ubrique',
            'curso' => '2DAW'
        ],
        [
            'id' => 3,
            'nombre' => 'Luis',
            'poblacion' => 'Ubrique',
            'curso' => '2DAW'
        ],
        [
            'id' => 4,
            'nombre' => 'Marta',
            'poblacion' => 'Ubrique',
            'curso' => '2DAW'
        ]
        ];
        return $tabla;
 }

 function buscar_tabla($tabla, $columna, $valor){
    $columna_id = array_column($tabla, $columna);
    $indice = array_search($valor, $columna_id);
    return $indice;
 }
 function buscar_tabla_2($tabla, $columna, $valor){
    foreach($tabla as $indice => $registro){
        if ($registro[$columna] == $valor) {
            return $indice;
        }
    }
    return false;
 }