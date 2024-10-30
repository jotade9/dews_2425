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

# Cargar la tabla de alumnos
$alumnos = get_tabla_alumnos();

# Buscar id en la tabla alumnos y devuelvo indice.
$indice_editar = buscar_tabla_2($alumnos, 'id', $id);

# Validar la búsqueda
if ($indice_editar === false) {
    echo "ERROR: alumno no encontrado";
    exit();
}

 // Creo el array de registro sólo con los detalles del alumno
 $registro = $alumnos[$indice_editar];

 #print_r($registro);
 #exit();
