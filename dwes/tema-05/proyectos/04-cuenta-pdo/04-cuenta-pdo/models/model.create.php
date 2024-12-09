<?php
    /*
        apellidos: model.create.php
        descripción: añade la nuevo cuenta a la tabla
        
        Métod POST (cliente):
            - num_cuenta
            - id_cliente
            - fecha_alta
            - fecha_ul_mov
            - num_movtos
            - saldo
            
    */

    
  
    // Carga los datos del formulario
    $num_cuenta = $_POST['num_cuenta'];
    $id_cliente = $_POST['id_cliente'];
    $fecha_alta = $_POST['fecha_alta']; 
    $fecha_ul_mov = $_POST['fecha_ul_mov']; 
    $num_movtos = $_POST['num_movtos'];
    $saldo = $_POST['saldo'];

    // Crear objeto de la clase Class_cuenta
    $cuenta = new Class_cuenta(
        null,           
        $num_cuenta,
        $id_cliente,
        $fecha_alta,
        $fecha_ul_mov,
        $num_movtos,
        $saldo
    );
    # Añadimos cuenta a la tabla
    $conexion = new Class_tabla_cuentas();

    $conexion->create($cuenta);

    