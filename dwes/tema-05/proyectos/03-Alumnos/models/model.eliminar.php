<?php
/*
        modelo:  model.eliminar.php
        descripcion: carga los datos del libro que deseo eliminar

        Método GET
            - indice
    */

# Cargamos el id del artículo
$indice = $_GET['indice'];

# Creo un objeto de la clase tabla de artículo
$obj_tabla_libros = new Class_tabla_libros();

# Cargo los datos de artículos
$obj_tabla_libros->getDatos();

# Cargo el array  de materias - lista desplegable dinámica
$materia = $obj_tabla_libros->getMaterias();

# Cargo tabla de categorías
$etiquetas = $obj_tabla_libros->getEtiquetas();


#Obtener el objeto de la clase artículo   correspondiente a ese índice
$obj_tabla_libros->delete($indice);

# Obtengo la tabla de libros actualizada para la vista
$array_libros = $obj_tabla_libros->tabla;
