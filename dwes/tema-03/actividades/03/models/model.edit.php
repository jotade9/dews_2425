<?php

/**
 * MOdelo: model.edit.php 
 * Descricion: edita un elemento de la lista
 * 
 * Metodo GET:
 *      -id alumno que se desea eliminar
 */

# Cargo id
$id = $_GET['id'];

# Cargar la tabla de alumnos
$libros = get_tabla_libros();

# Buscar id en la tabla alumnos y devuelvo indice.
$indice_editar = buscar_tabla($libros, 'id', $id);

# Validar la búsqueda
if ($indice_editar !== false) {


    # ELiminar libro
    unset($libros[$indice_editar]);

} else {

    echo "ERROR: libro no encontrado";

}