<?php
/**
 * Modelo: model.index.php  
 * descripcion: genera un array objetos de la clase articulos
 */


 # Creo un objeto de la clase tabla profesor
 $obj_tabla_profesores = new Class_tabla_profesores();

 # Cargo tabla de especialidad
 $especialidad = $obj_tabla_profesores->getEspecialidad();

 # Cargo la tabla de asignatura
 $asignaturas = $obj_tabla_profesores->getAsignaturas();

 # RElleno el array de objetos
 $obj_tabla_profesores->getDatos();

 # Obtener tabla de profesores
 $array_profesor = $obj_tabla_profesores->tabla;