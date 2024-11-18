<?php
/**
 * modelo: model.update.php 
 * descripcion: actualizo los datos del registro a partir de los detalles del formulario
 * 
 * metodo post:
 *          - id
 *          - nombre
*           - apellidos
*           - fecha_nacimiento
*           - poblacion
*           - especialidad (indice)
*           - asignaturas (array)
* metodo get:
*   -indice (indice de la tabla correspondiente a dicho registro)
 */

 # cargo los detalles del formulario
 $id = $_POST['id'];
 $nombre = $_POST['nombre'];
 $apellidos = $_POST['apellidos'];
 $nrp = $_POST['nrp'];
 $fecha_nacimiento = $_POST['fecha_nacimiento'];
 $poblacion = $_POST['poblacion'];
 $especialidad_profesor = $_POST['especialidad'];
 $asignaturas_profesor = $_POST['asignaturas'];

 # Cargo el indice de la tabla donde se encuentra el profesor
$indice = $_GET['indice'];

# Creo un objeto de la clase tabla profesor
$obj_tabla_profesores = new Class_tabla_profesores();

# Cago los datos en el objeto
$obj_tabla_profesores->getDatos();

# Creo ub objeto de la clase profesor a partir de los detalles del formulario
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

# Actualizo la tabla
$obj_tabla_profesores->update($profesor, $indice);

# extraer la tabla para la vista
$array_profesor = $obj_tabla_profesores->tabla;

# Cargo array de especialidad
$especialidad = $obj_tabla_profesores->getEspecialidad();

# Cargo el array de asignaturas
$asignaturas = $obj_tabla_profesores->getAsignaturas();