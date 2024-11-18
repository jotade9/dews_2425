<?php
/**
 * Modelo: model.nuevo.php 
 * descripcion: genera los datos necesarios para ñadir nuevo articulo
 */

 # Creo un array de la clase tabla profesores
 $obj_tabla_profesores = new Class_tabla_profesores();

 # Cargo tabla de especialidad
 $especialidad = $obj_tabla_profesores->getEspecialidad();
 # Cargo la tabla de asignaturas
 $asignaturas = $obj_tabla_profesores->getAsignaturas();
