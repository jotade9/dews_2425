<?php

    /*
        Creamos una clase para cada tabla
        las propiedades públicas y una propiedad para cada columna

        No respetará la propiedad de encapsulamiento.
    */
    class classAutor {
        
        public $id;
        public $nombre;
        public $nacionalidad;
        public $email;
        public $fecha_nac;
        public $fecha_def;
        public $premios;
        

        public function __construct(
            $id = null,
            $nombre = null,
            $nacionalidad = null,
            $email = null,
            $fecha_nac = null,
            $fecha_def = null,
            $premios = []
            ) {
                $this->id = $id;
                $this->nombre = $nombre;
                $this->nacionalidad = $nacionalidad;
                $this->email = $email;
                $this->fecha_nac = $fecha_nac;
                $this->fecha_def = $fecha_def;
                $this->premios = $premios;
            }

            // Creamos un metodo edad() que devuelve la edad actual del autor y en el caso de que haya fallecido la edad que tenía en el momento de su fallecimiento
            public function edad(){
                $fecha_nac = new DateTime($this->fecha_nac);
                $fecha_def = new DateTime($this->fecha_def);
                $hoy = new DateTime();
                if($fecha_def > $hoy){
                    return $fecha_nac->diff($hoy)->y;
                }else{
                    return $fecha_nac->diff($fecha_def)->y;
                }
            }
    }