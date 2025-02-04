<?php

/**
 * MOdelo: model.delete.php 
 * Descricion: Muestra formulario con los detalles editables de un alumno
 * 
 * Metodo GET:
 *      -id alumno que se desea editar
 */

# Cargo id del alumno que voy a editar
$id = $_GET['id'];

# Cargar la tabla de alumnos
$alumnos = get_tabla_alumnos();

# Buscar id en la tabla alumnos y devuelvo indice.
$indice_eliminar = buscar_tabla($alumnos, 'id', $id);

# Validar la búsqueda
if ($indice_eliminar !== false) {
    # ELiminar Alumno
    unset($alumnos[$indice_eliminar]);
}else{
    echo "ERROR: alumno no encontrado";
    exit();
};
