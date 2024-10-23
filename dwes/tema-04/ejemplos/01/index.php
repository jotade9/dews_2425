<?php
/**
 * Ejemplo
 * Descripción: crear objetos a patir de la clase Class_vehiculo
 */
include 'class/class.vehiculo.php';
# Creo un objeto de la clase vehiculo
 $vehiculo = new Class_vehiculo();

# Establecer la matricula del vehiculo 6712HRM
$vehiculo->setMatricula('6712HRM');

# Establecer velocidad a 10km/h
$vehiculo->setVelocidad(10);

# Mostrar detalles del vehiculo
echo "Matricula: ". $vehiculo->getMatricula();
echo "<br>";
echo "Velocidad: ". $vehiculo->getVelocidad();

 //var_dump($vehiculo);