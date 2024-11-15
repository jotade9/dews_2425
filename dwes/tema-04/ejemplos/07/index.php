<<<<<<< HEAD
<?php

    /*
        concepto de herencias
    */

    include "class/class.producto.php";

    $producto = new Class_producto(
        1,
        'La tormenta',
        20.45,
        'Juan',
        'Riquelme'
    );

    $libro = new Class_libro(
        2,
        'Ubrique villa olímpica',
        20.99,
        'Pedro',
        'Ortega',
        456,
        'Alfaguara' 
    );

    // $producto -> titulo = 'La tormenta perfecta'; Si queremos modificar una propiedad privada no nos vale esto
    $producto -> setTitulo('La tormenta perfecta'); // Para modificar una propiedad privada debemos usar los setters

    $libro->muestra_libro();


=======
<?php

    /*
        concepto de herencias
    */

    include "class/class.producto.php";

    $producto = new Class_producto(
        1,
        'La tormenta',
        20.45,
        'Juan',
        'Riquelme'
    );

    $libro = new Class_libro(
        2,
        'Ubrique villa olímpica',
        20.99,
        'Pedro',
        'Ortega',
        456,
        'Alfaguara' 
    );

    // $producto -> titulo = 'La tormenta perfecta'; Si queremos modificar una propiedad privada no nos vale esto
    $producto -> setTitulo('La tormenta perfecta'); // Para modificar una propiedad privada debemos usar los setters

    $libro->muestra_libro();


>>>>>>> 880701ca79aea3b9a52b24be21ccbac733d67c82
