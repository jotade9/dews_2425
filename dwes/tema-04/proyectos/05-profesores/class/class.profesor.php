<?php
/**
 * archivo: class.profesor.php 
 * descripcion: describe la clase profesor sin encapsulamiento
 */

 class Class_profesor{
    public $id;
    public $nombre;
    public $apellidos;
    public $nrp;
    public $fecha_nacimiento;
    public $poblacion;
    public $especialidad;// lista desplegable
    public $asignaturas;//lista checkbox

    public function __construct(
        $id = null,
        $nombre = null,
        $apellidos = null,
        $nrp = null,
        $fecha_nacimiento = null,
        $poblacion = null,
        $especialidad = null,
        $asignaturas = []
    ){
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->nrp = $nrp;
        $this->fecha_nacimiento = $fecha_nacimiento;
        $this->poblacion = $poblacion;
        $this->especialidad = $especialidad;
        $this->asignaturas = $asignaturas;
    }
    public function getEdad(){
        # Convertimos la fecha de nacimiento en un objeto DateTime
        $fechaNac = new DateTime($this->fecha_nacimiento);
        $fechaActual = new DateTime();

        # Calculo la diferencia entre la fecha actual y la fecha de nacimiento
        $diferencia = $fechaActual->diff($fechaNac);

        # Devolcmos la diferencia en años
        return $diferencia->y;


    }
 }