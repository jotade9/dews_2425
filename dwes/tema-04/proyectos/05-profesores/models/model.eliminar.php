<?php
/**
 * modelo: model.eliminar.php 
 * descripcion: cargo los datos del profesor que deseo eliminar
 * 
 * Metodo GET:
 *  -indice
 */

 # Cargamos el id del profesor
 $indice = $_GET['indice'];

 # Creo un objeto de la clase tabla de profesores
 $obj_tabla_profesores = new Class_tabla_profesores();

 # Cargo los datos de los profesores
 $obj_tabla_profesores->getDatos();

 # Cargo la array de la especialidad
 $especialidad = $obj_tabla_profesores->getEspecialidad();

 # Cargo el array de las asignaturas
 $asignaturas = $obj_tabla_profesores->getAsignaturas();

 #Obtener el profesor de la clase profesor correspondiente a ese indice
 $obj_tabla_profesores->delete($indice);

 # Objtengo la tabla de profesores actualizada para la vista
 $array_profesor = $obj_tabla_profesores->tabla;