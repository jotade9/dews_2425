<<<<<<< HEAD
<?php
# Cargo id
$id = $_GET['id'];

# Cargar la tabla de articulos
$tabla = generar_tabla();

# Buscar id en la tabla libros y devuelvo indice.
$indice_editar = buscar_registro($tabla, 'id', $id);

# Validar la búsqueda
if ($indice_editar === false) {
    echo "ERROR: articulo no encontrado";
    exit();
}

 // Creo el array de registro sólo con los detalles del articulo
 $registro = $tabla[$indice_editar];
    
=======
<?php
# Cargo id
$id = $_GET['id'];

# Cargar la tabla de articulos
$tabla = generar_tabla();

# Buscar id en la tabla libros y devuelvo indice.
$indice_editar = buscar_registro($tabla, 'id', $id);

# Validar la búsqueda
if ($indice_editar === false) {
    echo "ERROR: articulo no encontrado";
    exit();
}

 // Creo el array de registro sólo con los detalles del articulo
 $registro = $tabla[$indice_editar];
    
>>>>>>> 880701ca79aea3b9a52b24be21ccbac733d67c82
?>