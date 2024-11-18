<?php
/**
 * modelo: model.editar.php 
 * descripcion: cargo los datos del profesor que deseo editar
 * 
 * metodo get:
 *  -indice
 */

 # Cargamos el id del profesor
 $indice = $_GET['indice'];

 # Creo un objeto de la clase tabla profesor
 $obj_tabla_profesores = new Class_tabla_profesores();

 # Cargo los datos
 $obj_tabla_profesores->getDatos();

 # Cargo la array de especialidad
 $especialidad = $obj_tabla_profesores->getEspecialidad();

 #Cargo el array de asignaturas
 $asignaturas = $obj_tabla_profesores->getAsignaturas();

 # obtener el objeto de la clase profesor correspondiente a ese indice
 $profesor = $obj_tabla_profesores->read($indice);