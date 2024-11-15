<?php
/**
 *  Modelo: model.index.php 
 *  Descripcion: genera array objetos de la clase articulos
 */

 # Creo un objeto de la clase alumno
 $obj_tabla_alumnos = new Class_tabla_alumnos();

 # Cargo la tabla de cursos
 $cursos = $obj_tabla_alumnos->getCurso();

 # Cargo la tabla de asignaturas
 $asignaturas = $obj_tabla_alumnos->getAsignaturas();

 # Relleno el array de objetos
 $obj_tabla_alumnos->getAlumnos();

 # Obtener tabla de articulos (Este paso es necesario porque hay que devolver un array y no un objeto)
 $array_alumnos = $obj_tabla_alumnos->getTabla();