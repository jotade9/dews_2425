<?php

/**
 * Clase: class.vehiculo.php 
 * Descricpción: definición de la clase vehiculo
 * autor:
 * versión:
 * fecha:
 */

class Class_vehiculo
{
    # Propiedades o atributos de la clase
    public $matricula;
    public $velocidad;

    # Métodos o funcioines
    // Constructor
    // Metodo que se ejecuta automaticamente cuando se crea un objeto  a partir de dicha clase

    public function __construct(
        // si no le asigno valor null los parametros serian obligatorios
        $matricula = null,
        $velocidad = null
    ) {
        $this->matricula = $matricula;
        $this->velocidad = $velocidad;
    }

    # Metodo que devuelve la propiedad matricula
    public function getMatricula()
    {
        return $this->matricula;
    }

    # Metodo que devuelve la propiedad mvelocidad
    public function getVelocidad()
    {
        return $this->velocidad;
    }

    # Metodo que establece la propiedad matricula
    public function setMatricula($matricula)
    {
        $this->matricula = $matricula;
    }

    # Metodo que establece la propiedad velocidad
    public function setVelocidad($velocidad)
    {
        $this->velocidad = $velocidad;
    }

    # Metodo que aumenta la velocidad
    public function aumentarVelocidad()
    {
        $this->velocidad++;
    }

    # Metodo que disminuye la velocidad
    public function disminuirVelocidad()
    {
        $this->velocidad--;
    }

    # Método que para el coche
    public function parar()
    {
        $this->velocidad = 0;
    }
    # Método destructor
    // No se suele utilizar, PHP gestiona bastante bien la liberación de recursos
    // Una vez que ofrece la respuesta
    public function __destruct()
    {
        echo "Objeto destruido correctamente...";
    }
}
