<?php

/*
        archivo:class.jugador.php
        nombre: define la clase jugador sin encapsulamiento
    */
class Class_jugador
{
    public $id;
    public $nombre;
    public $f_nacimiento;
    public $altura;
    public $peso;
    public $nacionalidad;
    public $num_camiseta;
    public $valor_mercado;
    public $equipo_id;
    public $posiciones_id;

    public function __construct(
        $id = null,
        $nombre = null,
        $f_nacimiento = null,
        $altura = null,
        $peso = null,
        $nacionalidad = null,
        $num_camiseta = null,
        $valor_mercado = null,
        $equipo_id = null,
        $posiciones_id = []

    ) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->f_nacimiento = $f_nacimiento;
        $this->altura = $altura;
        $this->peso = $peso;
        $this->nacionalidad = $nacionalidad;
        $this->num_camiseta = $num_camiseta;
        $this->valor_mercado = $valor_mercado;
        $this->equipo_id = $equipo_id;
        $this->posiciones_id = $posiciones_id;
    }

    public function getEdad() {
        $fechaNacimiento = new DateTime($this->f_nacimiento);
        $hoy = new DateTime();
        $edad = $hoy->diff($fechaNacimiento)->y;
        return $edad;
    }
}
