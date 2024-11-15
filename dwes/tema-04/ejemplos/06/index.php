<<<<<<< HEAD
<?php
/**
 * Concepto de herencias
 * 
 * 
 */

 include 'class/class.producto.php';

 $producto = new Class_producto(
    1,
    'La tormenta',
    20.45,
    'Juan',
    "Riquelme"
 );
 $libro = new Class_libro(
    2,
    'Ubrique villa olimpica',
    23.45,
    'Pedro',
    'Ortega',
    456,
    'Alfaguara'
 );
 var_dump($producto);
 echo '<br>';
var_dump($libro);
$libro -> getResumen();
echo '<br>';
=======
<?php
/**
 * Concepto de herencias
 * 
 * 
 */

 include 'class/class.producto.php';

 $producto = new Class_producto(
    1,
    'La tormenta',
    20.45,
    'Juan',
    "Riquelme"
 );
 $libro = new Class_libro(
    2,
    'Ubrique villa olimpica',
    23.45,
    'Pedro',
    'Ortega',
    456,
    'Alfaguara'
 );
 var_dump($producto);
 echo '<br>';
var_dump($libro);
$libro -> getResumen();
echo '<br>';
>>>>>>> 880701ca79aea3b9a52b24be21ccbac733d67c82
echo $libro->getResumen();