<?php

    /*
        Creamos una clase para cada tabla
        las propiedades públicas y una propiedad para cada columna

        No respetará la propiedad de encapsulamiento.
    */

    class classAlbum {

        public $id;
        public $titulo;
        public $lugar;
        public $categoria;
        public $etiquetas;
        public $num_fotos;
        public $num_visitas;
        

        public function __construct(
            $id = null,
            $titulo = null,
            $lugar = null,
            $categoria = null,
            $etiquetas = null,
            $num_fotos = null,
            $num_visitas = null
        ) {
            $this->id = $id;
            $this->titulo = $titulo;
            $this->lugar = $lugar;
            $this->categoria = $categoria;
            $this->etiquetas = $etiquetas;
            $this->num_fotos = $num_fotos;
            $this->num_visitas = $num_visitas;

        }

        public function edad(){
            $fechaNacimiento = new DateTime($this->fechaNac);
            $hoy = new DateTime();
            $edad = $hoy->diff($fechaNacimiento)->y;
            return $edad;
        }

        
    }