<?php
/**
 * modelo: model.create.php 
 * decripcion: añade el nuevo articulo a la tabla
 *   Metod POST:
 *      - id
 *      - descripcion
 *      - modelo
 *      - marca(indice)
 *      - unidades
 *      - precio
 *      - categorias[]
 */

 # Cargo los detalles del formulario
 $id = $_POST['id'];
 $descripcion = $_POST['descripcion'];
 $modelo = $_POST['modelo'];
 $marca = $_POST['marca'];
 $unidades = $_POST['unidades'];
 $precio = $_POST['precio'];
 $categorias = $_POST['categorias'];

 # Validacion

 # Crear un objeto de la clase tabla_articulos
 $obj_tabla_articulos = new Class_tabla_articulos();

 # Obtengo los articulos
 $obj_tabla_articulos->getDatos();

 # Obtengo el array de marcas
 $marcas = $obj_tabla_articulos->getMarcas();

 # Obtengo el array de categorias
 $array_categorias = $obj_tabla_articulos->getCategorias();

 # Crear un objeto de la clase articulos a partir de los detalles del formulario
 // Ojo al orden de los parametros, debe coincidir con el orden de la clase articulo
 $articulo = new Class_articulo(
    $id,
    $descripcion,
    $modelo,
    $marca,
    $categorias,
    $unidades,
    $precio
);

# Añadir el articulo a la tabla
$obj_tabla_articulos->create($articulo);

# Obtener la tabla articulos
$array_articulos = $obj_tabla_articulos->getTabla();