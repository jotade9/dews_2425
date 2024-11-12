<?php
/**
 * archivo: class.alumno.php 
 * descripcion: define la clase alumno con propiedad encapsulamiento
 */

 class Class_alumno {
    private $id;
    private $nombre;
    private $apellidos;
    private $email;
    private $f_nacimiento;
    private $curso;
    private $asignaturas;

    public function __construct(
        $id = null,
        $nombre = null,
        $apellidos = null,
        $email = null,
        $f_nacimiento = null,
        $curso = null,
        $asignaturas = null
    ){
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->email = $email;
        $this->f_nacimiento = $f_nacimiento;
        $this->curso = $curso;
        $this->asignaturas = $asignaturas;
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of nombre
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     */
    public function setNombre($nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get the value of apellidos
     */
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * Set the value of apellidos
     */
    public function setApellidos($apellidos): self
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     */
    public function setEmail($email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of f_nacimiento
     */
    public function getFNacimiento()
    {
        return $this->f_nacimiento;
    }

    /**
     * Set the value of f_nacimiento
     */
    public function setFNacimiento($f_nacimiento): self
    {
        $this->f_nacimiento = $f_nacimiento;

        return $this;
    }

    /**
     * Get the value of curso
     */
    public function getCurso()
    {
        return $this->curso;
    }

    /**
     * Set the value of curso
     */
    public function setCurso($curso): self
    {
        $this->curso = $curso;

        return $this;
    }

    /**
     * Get the value of asignaturas
     */
    public function getAsignaturas()
    {
        return $this->asignaturas;
    }

    /**
     * Set the value of asignaturas
     */
    public function setAsignaturas($asignaturas): self
    {
        $this->asignaturas = $asignaturas;

        return $this;
    }
    public function getEdad(){
        # Convertimos la fecha de nacimiento en un objeto DateTime
        $fechaNac = new DateTime($this->f_nacimiento);
        $fechaActual = new DateTime();

        # Calculo la diferencia entre la fecha actual y la fecha de nacimiento
        $diferencia = $fechaActual->diff($fechaNac);

        # Devolcmos la diferencia en años
        return $diferencia->y;


    }
 }