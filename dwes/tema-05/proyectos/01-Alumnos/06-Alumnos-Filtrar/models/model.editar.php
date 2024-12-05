<?php

    /*
        modelo: model.editar.php
        descripción: carga los detalles del alumno que deseo editar

        Método GET:

            - id del alumno
    */

    # Cargamos el id del alumno
    $id = $_GET['id'];

    # Creo un objeto de la clase tabla alumnos
    $tabla_alumnos = new Class_tabla_alumnos();

    # Cargo tabla de cursos
    $cursos = $tabla_alumnos->getCursos();

    # Obtener los detalles del alumno
    // Objeto de la clase alumnos
    $alumno = $tabla_alumnos->read($id);

    