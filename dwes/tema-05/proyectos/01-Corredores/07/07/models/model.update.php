<?php

/*
    Modelo: model.update.php
    Descripción: actualiza los datos del alumno

     Métod POST:
        
        - Los detalles del alumno
    
    Método GET:

        - id del alumno
*/


# Cargo el id del alumno
$id = $_GET['id'];

# Cargo los detalles del  formulario

$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$ciudad = $_POST['ciudad'];
$fechaNacimiento = $_POST['fechaNacimiento'];
$sexo = $_POST['sexo'];
$email = $_POST['email'];
$dni = $_POST['dni'];
$id_categoria = $_POST['id_categoria'];
$id_club = $_POST['id_club'];

# Validación

# Creamos objeto de la clase Class_corredor
$corredor = new Class_corredor(
    null,
    $nombre,
    $apellidos,
    $ciudad,
    $fechaNacimiento,
    $sexo,
    $email,
    $dni,
    $id_categoria,
    $id_club
);

  # Añadimos corredor a la tabla
  $corredores = new Class_tabla_corredores();

  $corredores->update($corredor, $id);

  # Redirecciono al controlador index
  header("location: index.php");
