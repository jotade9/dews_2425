<?php

/**
 * 
 * model.order.php
 * Descripcion: permite filtrar la tabla a partir de una expresión
 * Todas las filas que contengan dicha expresiñon se mostrarán
 * 
 * Metodo GET:
 *      -expresión:  expresión de filtrado.
 */
# Obtenemos criterio de ordenación
$expresion = $_GET['expresion'];

# cargamos la tabla
$alumnos = get_tabla_alumnos();

# Filtramos la tabla a partir de la expresión

// Creo una array vacío donde iré cargando las filas que cumplen con la expresiñon de filtrado

$aux = [];

// Recorrer la tabla fila a fila para comprobar la expresión

foreach($alumnos as $registro) {
    if(array_search($expresion, $registro, false)){
        $aux[]= $registro;
    }
}
$alumnos = $aux;