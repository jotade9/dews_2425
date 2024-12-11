<?php

    /*
        modelo: model.editar.php
        descripción: carga los datos del cuenta que deseo actualizar

        Método GET:

            - id del cuenta
    */

    # Cargamos el id del cuenta que vamos a editar
    $id = $_GET['id'];

    # Creo un objeto de la clase tabla cuentas
    $conexion = new Class_tabla_cuentas();

    # Obtener los detalles del cuenta 
    // objeto de la clase cuenta
    $cuenta = $conexion->read($id);

    // Cargamos la tabla de clientes
    $clientes = $conexion->getClientes();