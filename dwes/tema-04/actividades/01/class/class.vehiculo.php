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
        $operador = null,
        $resultado = 0
    )
    {
        $this->valor1 = null;
        $this->valor2 = null;
        $this->operador = null;
        $this->resultado = null;
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

    # Metodo que suma los valores
    public function sumar()
    {
        $this->resultado=($this->valor1 + $this->valor2);
    }

    # Metodo que disminuye la valor2
    public function disminuirvalor2()
    {
        $this->valor2--;
    }

    # Método que para el coche
    public function parar()
    {
        $this->valor2 = 0;
    }
}
