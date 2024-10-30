<?php
/**
 * Modelo: model.update.php
 * 
 * Descripcion: actualiza los detalles de un alumno
 * 
 * Método POST:
 *      -nombre
 *      -poblacion
 *      -curso
 * 
 * Método GET:
 *      -id
 *      -
 */

 #Extraemos los valores del formulario
 $id = $_POST['id'];
 $nombre = $_POST['nombre'];
 $poblacion = $_POST['poblacion'];
 $curso = $_POST['curso'];

 # Extraemos el id del alumno
 $id = $_GET['id'];

 # Obtenemos el indice de la tabla donde se encuentra ese alumno
 $indice_editar = buscar_tabla_2($alumnos,'id',$id_editar);

 # Creo un array asociativo con los detalles actualizados del alumno
 $registro = [
    'id' => $id,
    'nombre' => $nombre,
    'poblacion' => $poblacion,
    'curso' => $curso
 ];
 #Cargo la tabla alumnos
 $alumnos = get_tabla_alumnos();

 # Actualizo la tabla alumnos
 $alumnos[$indice_editar] = $registro;

 # array_push($alumnos, $registro);