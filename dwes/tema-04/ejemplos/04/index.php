<?php
/**
 * Ejemplo
 * Descripción: crear objetos a patir de la clase Class_vehiculo
 */
include 'class/class.vehiculo.php';
# Creo un objeto de la clase vehiculo
 $vehiculo = new Class_vehiculo();

# Establecer la matricula del vehiculo 6712HRM
// $vehiculo->setMatricula('6712HRM');
$vehiculo->matricula = '6712HRM0';

# Establecer velocidad a 10km/h
// $vehiculo->setVelocidad(10);
$vehiculo->velocidad = 10;
// de esta forma no cumple el criterio de encapsulación
// Para el criterio de encapsulación debemos
// acceder mediante metodos
// encapsulacion- atributo private
// no encapsulación - atributo public

# Mostrar detalles del vehiculo
echo "Matricula: ". $vehiculo->getMatricula();
echo "<br>";
echo "Velocidad: ". $vehiculo->getVelocidad();

 //var_dump($vehiculo);