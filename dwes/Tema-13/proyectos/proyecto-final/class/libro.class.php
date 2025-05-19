<?php

    /*
        Creamos una clase para cada tabla
        las propiedades públicas y una propiedad para cada columna

        No respetará la propiedad de encapsulamiento.
    */

    class classLibro {

        public $id;
        public $titulo;
        public $autor;
        public $editorial;
        public $precio;
        public $unidades;
        public $fecha_edicion;
        public $isbn;
        public $generos;
        

        public function __construct(
            $id = null,
            $titulo = null,
            $autor = null,
            $editorial = null,
            $precio = null,
            $unidades = null,
            $fecha_edicion = null,
            $isbn = null,
            $generos = []
            ) {
                $this->id = $id;
                $this->titulo = $titulo;
                $this->autor = $autor;
                $this->editorial = $editorial;
                $this->precio = $precio;
                $this->unidades = $unidades;
                $this->fecha_edicion = $fecha_edicion;
                $this->isbn = $isbn;
                $this->generos = $generos;
            } 


        
    }