<?php

/**
 * 
 * model.order.php
 * Descripcion: permite ordenar la tabla por cualquiera de las columnas siempre en orden ascendente
 * 
 * Metodo GET:
 *      -criterio: id, nombre, poblacion, curso
 */
# Obtenemos criterio de ordenación
$criterio = $_GET['criterio'];

 # cargamos la tabla
$libros = get_tabla_libros();

# Ordenar tabla

// Cargo en un array todos los valores de la colimna de ordenación
$aux = array_column($libros, $criterio);

// Función array_multisort
array_multisort($aux, SORT_ASC, $libros);