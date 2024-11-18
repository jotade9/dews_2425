<?php
/**
 * modelo: model.create.php 
 * descripcion: añade el nuevo profesor a la tabla
 * 
 *      Metodo POST:
 *          - id
 *          - nombre
*           - apellidos
*           - fecha_nacimiento
*           - poblacion
*           - especialidad (indice)
*           - asignaturas (array)
 */

# Cargo los detalles del formulario
$id = $_POST['id'];
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$nrp = $_POST['nrp'];
$fecha_nacimiento = $_POST['fecha_nacimiento'];
$poblacion = $_POST['poblacion'];
$especialidad_profesor = $_POST['especialidad'];
$asignaturas_profesor = $_POST['asignaturas'];

# Crear un objeto de la clase tabla profesor
$obj_tabla_profesores = new Class_tabla_profesores();

# Cargo los profesores
$obj_tabla_profesores->getDatos();
# Cargo el array de especialidad
$especialidad = $obj_tabla_profesores->getEspecialidad();

# Cargo el array de asignaturas
$asignaturas = $obj_tabla_profesores->getAsignaturas();

# Creo un objeto de la clase profesor a partir de los detalles del formulario
$profesor = new Class_profesor(
    $id,
    $nombre,
    $apellidos,
    $nrp,
    $fecha_nacimiento,
    $poblacion,
    $especialidad_profesor,
    $asignaturas_profesor
);
# Añado el profesor a la tabla
$obj_tabla_profesores->create($profesor);

$array_profesor = $obj_tabla_profesores->tabla;

