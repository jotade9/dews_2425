<?php
# Cargo los detalles del formulario
$id = $_POST['id'];
$descripcion= $_POST['descripcion'];
$modelo = $_POST['modelo'];
$categoria = $_POST['categoria'];
$unidades = $_POST['unidades'];
$precio = $_POST['precio'];

# Cargo en un array la tabla articulos
$articulos = generar_tabla();

# Creo un array asociativo con los detalles del nuevo producto
$new_articulo = [
    'id' => $id,
    'descripcion' => $descripcion,
    'modelo' => $modelo,
    'categoria' => $categoria,
    'unidades' => $unidades,
    'precio' => $precio
];

# Añadir el nuevo producto a la tabla
$articulos[] = $new_articulo;