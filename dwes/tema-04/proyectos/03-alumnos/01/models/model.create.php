<?php
/**
 * modelo: model.create.php 
 * descripcion: añade el nuevo alumno a la tabla
 *  metod POST:
 *      - id
 *      - nombre
 *      - apellidos
 *      - email
 *      - fecha de nacimiento
 *      - curso
 *      - asignaturas
 */

 # Cargo los detalles del formulario
 $id = $_POST['id'];
 $nombre = $_POST['nombre'];
 $apellidos = $_POST['apellidos'];
 $email = $_POST['email'];
 $f_nacimiento = $_POST['f_nacimiento'];
 $curso = $_POST['curso'];
 $asignaturas = $_POST['asignaturas'];

 # Crear un objeto de la clase tabla_alumnos
 $obj_tabla_alumnos = new Class_tabla_alumnos();

 # Obtengo los articulos
 $obj_tabla_alumnos->getAlumnos();

 # Obtengo el array de marcas
 $cursos = $obj_tabla_alumnos->getCurso();

 # Obtengo el array de categorias
 $array_asignaturas = $obj_tabla_alumnos->getAsignaturas();

 # Crear ub objeto de la clase alumnos a partir de los detalles del formulario
 $alumno = new Class_alumno(
    $id,
    $nombre,
    $apellidos,
    $email,
    $f_nacimiento,
    $curso,
    $asignaturas
 );

 # Añadir el alumno a la tabla
 $obj_tabla_alumnos->create($alumno);

 # Obtener la tabla de alumnos
 $array_alumnos = $obj_tabla_alumnos->getTabla();