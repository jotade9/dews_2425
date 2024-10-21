<?php

/**
 * Modelo: model.show.php 
 * Descricion: muestra formulario con los detalles no editables de un alumno.
 * 
 * Metodo GET:
 *      -id alumno que se desea mostrar
 */

# Cargo id
$id = $_GET['id'];

# Cargar la tabla de libros
$libros = get_tabla_libros();

# Buscar id en la tabla libros y devuelvo indice.
$indice_editar = buscar_tabla_2($libros, 'id', $id);

# Validar la búsqueda
if ($indice_editar === false) {
    echo "ERROR: alumno no encontrado";
    exit();
}

 // Creo el array de registro sólo con los detalles del alumno
 $registro = $libros[$indice_editar];

 #print_r($registro);
 #exit();
