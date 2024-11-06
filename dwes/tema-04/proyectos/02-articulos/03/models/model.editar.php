<?php
/**
 * modelo: model.editar.php 
 * descripcion: carga los datos de los articulos que deseo actualizar
 * 
 * Metodo GET: 
 *      -id del articulo
 */

 # Cargamos el id del articulo
 $id= $_GET['id'];

 # Creo un objeto de la clase tabla de articulos
 $obj_tabla_articulos = new Class_tabla_articulos();

 # Cargo el array de marcas - lista desplegable dinámica
 $marcas = $obj_tabla_articulos->getMarcas();

 # Cargo el array de categorias - lista checkbox dinámica
 $categorias = $obj_tabla_articulos->getCategorias();

 # Obtener el indice del articulo en la tabla
 $indice = $obj_tabla_articulos->devolver_indice($id);

 # Obtener el objeto de la clase articulo correspondiente a ese indice
 $articulo = $obj_tabla_articulos->read($indice);
 var_dump($articulo);
 exit();