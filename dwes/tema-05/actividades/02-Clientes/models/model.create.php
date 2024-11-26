<?php
/*
        apellidos: model.create.php
        descripción: añade el nuevo cliente a la tabla
        
        Métod POST (cliente):
            - id
            
    */

# Cargo los detalles del  formulario

$apellidos = $_POST['apellidos'];
$nombre = $_POST['nombre'];
$telefono = $_POST['telefono'];
$ciudad = $_POST['ciudad'];
$dni = $_POST['dni'];
$email = $_POST['email'];


# Validación

# Creamos objeto de la clase Class_cliente
$cliente = new Class_cliente(
    null,
    $apellidos ,
    $nombre ,
    $telefono ,
    $ciudad ,
    $dni ,
    $email,
    (new DateTime())->format('Y-m-d H:i:s'),
    (new DateTime())->format('Y-m-d H:i:s')
);

# Añadimos cliente a la tabla
$clientes = new Class_tabla_clientes('localhost', 'root', '', 'gesbank');

$clientes->create($cliente);

# Redirecciono al controlador index
header("location: index.php");
