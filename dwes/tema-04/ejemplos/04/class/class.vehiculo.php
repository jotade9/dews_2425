<<<<<<< HEAD
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

    public function __construct()
    {
        $this->matricula = null;
        $this->velocidad = null;
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
}
=======
<<<<<<< HEAD
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

    public function __construct()
    {
        $this->matricula = null;
        $this->velocidad = null;
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
}
=======
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

    public function __construct()
    {
        $this->matricula = null;
        $this->velocidad = null;
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
}
>>>>>>> 880701ca79aea3b9a52b24be21ccbac733d67c82
>>>>>>> 7c139080c002fe1675da1016599ab6d972ca90e2
