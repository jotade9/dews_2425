<?php
/*
        modelo:  model.editar.php
        descripcion: carga los datos del libro que deseo actualizar

        Método GET
            - indice
    */

# Cargamos el id del libro
$indice = $_GET['indice'];

# Creo un objeto de la clase tabla de libro
$obj_tabla_libros = new Class_tabla_libros();

# Cargo los datos de libros
$obj_tabla_libros->getDatos();

# Cargo el array  de materias - lista desplegable dinámica
$materia = $obj_tabla_libros->getMaterias();

# Cargo el array  de etiquetas - lista desplegable dinámica
$etiquetas = $obj_tabla_libros->getEtiquetas();

# Obtener el índice del libro en la tabla
//$indice = $obj_tabla_libros->devolver_indice($id);

#Obtener el objeto de la clase libro   correspondiente a ese índice
$libro = $obj_tabla_libros->read($indice);
