<?php
/**
 * Ejemplo
 * Descripción: crear objetos a patir de la clase Class_vehiculo
 */
include 'class/class.vehiculo.php';
# Creo un objeto de la clase vehiculo
 $vehiculo = new Class_vehiculo('1234BFH', 10);


# Mostrar detalles del vehiculo
echo "Matricula: ". $vehiculo->getMatricula();
echo "<br>";
echo "Velocidad: ". $vehiculo->getVelocidad();
echo "<br>";

// var_dump($vehiculo);

