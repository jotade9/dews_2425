<?php

/**
 * Clase: class.calculadora.php 
 * Descricpción: definición de la clase calculadora
 *      -Propiedades: valor1, valor2, operador, resultado
 *      -Métodos: suma(), resta(), division(), multiplicacion(), potencia()
 * autor:
 * versión:
 * fecha:
 */

class Class_calculadora
{
    # Propiedades o atributos de la clase
    private $valor1;
    private $valor2;
    private $operador;
    private $resultado;

    # Métodos o funciones
    // Constructor
    // Metodo que se ejecuta automaticamente cuando se crea un objeto  a partir de dicha clase

    public function __construct(
        $valor1 = 0,
        $valor2 = 0,
        $operador = null
    ) {
        $this->valor1 = $valor1;
        $this->valor2 = $valor2;
        $this->operador = $operador;
        $this->resultado = 0;
    }

    # Metodo que devuelve la propiedad valor1
    public function getvalor1()
    {
        return $this->valor1;
    }

    # Metodo que devuelve la propiedad mvalor2
    public function getvalor2()
    {
        return $this->valor2;
    }

    # Metodo que establece la propiedad valor1
    public function setvalor1($valor1)
    {
        $this->valor1 = $valor1;
    }

    # Metodo que establece la propiedad valor2
    public function setvalor2($valor2)
    {
        $this->valor2 = $valor2;
    }

    # Metodo que devuelve la propiedad operador
    public function getOperador()
    {
        return $this->operador;
    }
    # Metodo que devuelve la propiedad operador
    public function setOperador()
    {
        return $this->operador;
    }

    public function getResultado()
    {
        return $this->resultado;
    }

    // Metodos para las operaciones

    # Metodo que suma los valores
    public function sumar()
    {
        $this->resultado = $this->valor1 + $this->valor2;
    }

    # Metodo que resta los valores
    public function restar()
    {
        $this->resultado = $this->valor1 - $this->valor2;
    }

    # Metodo que multiplica los valores
    public function producto()
    {
        $this->resultado = $this->valor1 * $this->valor2;
    }

    # Metodo que divide los valores
    public function division()
    {
        if ($this->valor2 != 0) {
            $this->resultado = $this->valor1 / $this->valor2;
        } else {
            $this->resultado = "Error: División por cero";
        }
    }

    # Metodo que potencia los valores
    public function potenciar()
    {
        $this->resultado = $this->valor1 ** $this->valor2;
    }
}