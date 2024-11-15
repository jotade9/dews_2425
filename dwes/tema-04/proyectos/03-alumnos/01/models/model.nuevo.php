<?php

/*
        Modelo: model.nuevo.php
        Descripción: genera los datos necesarios para añadir nuevos alumnos
    */



# Creo un objeto de la clase tabla alumnos
$obj_tabla_alumnos = new Class_tabla_alumnos();

# Cargo tabla de marcas
$cursos = $obj_tabla_alumnos->getCurso();

# Cargo tabla de categorías
$asignaturas = $obj_tabla_alumnos->getAsignaturas();