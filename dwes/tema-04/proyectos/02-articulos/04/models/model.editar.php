<?php
/*
        modelo:  model.editar.php
        descripcion: carga los datos del artículo que deseo actualizar

        Método GET
            - indice
    */

# Cargamos el id del artículo
$indice = $_GET['indice'];

# Creo un objeto de la clase tabla de artículo
$obj_tabla_articulos = new Class_tabla_articulos();

# Cargo los datos de artículos
$obj_tabla_articulos->getDatos();

# Cargo el array  de marcas - lista desplegable dinámica
$marcas = $obj_tabla_articulos->getMarcas();

# Cargo el array  de categorias - lista desplegable dinámica
$categorias = $obj_tabla_articulos->getCategorias();

# Obtener el índice del artículo en la tabla
//$indice = $obj_tabla_articulos->devolver_indice($id);

#Obtener el objeto de la clase artículo   correspondiente a ese índice
$articulo = $obj_tabla_articulos->read($indice);
