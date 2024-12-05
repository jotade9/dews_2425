<?php
/**
 * Clase conexion mediante msqli
 */

 Class Class_conexion{
    public $server;

    public $user;

    public $pass;

    public $base_datos;

    public $mysqli;

    public function __construct(
        $server,
        $user,
        $pass,
        $base_datos,
    )
    {
        // asigno valor a las propiedades
        $this->server = $server;
        $this->user = $user;
        $this->pass = $pass;
        $this->base_datos = $base_datos;

        // realizo la conexion
        $this->mysqli = new mysqli($server, $user, $pass, $base_datos);

        // verificar conexion
        if($this->mysqli->connect_errno){
            die('ERROR DE CONEXION: ' . $this->mysqli->connect_error);

        }
    }
 }