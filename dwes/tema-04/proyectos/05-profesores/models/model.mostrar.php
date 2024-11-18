<?php
/**
 * modelo: model.mostrar.php 
 * descripcion: carga los datos del profesor
 * 
 * metodo get:
 * 
 *      - indice de la tabla en la que se encuentra el profesor
 */

 # Cargamos el id del profesor

 $indice = $_GET['indice'];

 # Creo un objeto d ela clase tabla profesor
 $obj_tabla_profesores = new Class_tabla_profesores();

 # Cargo los datos
 $obj_tabla_profesores->getDatos();

 # Cargo el array de especialidad
 $especialidad = $obj_tabla_profesores->getEspecialidad();

 # Cargo el array de asignaturas
 $asignaturas = $obj_tabla_profesores->getAsignaturas();

 # Obtengo el objeto de la clase profesor correspondiente al indice
 $profesor = $obj_tabla_profesores->read($indice);