<?php

    /*
        modelo: model.mostrar.php
        descripción: carga los datos del cuenta que deseo mostrar

        Método GET:

            - id de la cuenta
    */

    # Cargamos el id del cuenta que vamos a mostrar
    $id = $_GET['id'];

    # Creo un objeto de la clase tabla cuentas
    $conexion = new Class_tabla_cuentas();


    # Obtener los detalles del cuenta 
    // objeto de la clase cuenta
    $cuenta = $conexion->read($id);

   
