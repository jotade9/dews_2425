<<<<<<< HEAD
<?php

    class Class_producto
    {
        protected $id;
        protected $titulo;
        protected $precio;
        protected $nombreAutor;
        protected $apellidosAutor;

        public function __construct($id = null, $titulo = null, $precio = null, $nombreAutor = null, $apellidosAutor = null)
        {
            $this->id = $id;
            $this->titulo = $titulo;
            $this->precio = $precio;
            $this->nombreAutor = $nombreAutor;
            $this->apellidosAutor = $apellidosAutor;
        }

        // Getters
        public function getId()
        {
            return $this->id;
        }

        public function getTitulo()

        {
            return $this->titulo;
        }

        public function getPrecio()
        {
            return $this->precio;
        }

        public function getNombreAutor()
        {
            return $this->nombreAutor;
        }

        public function getApellidosAutor()
        {
            return $this->apellidosAutor;
        }

        // Setters
        public function setId($id)
        {
            $this->id = $id;
        }

        public function setTitulo($titulo)
        {
            $this->titulo = $titulo;
        }

        public function setPrecio($precio)
        {
            $this->precio = $precio;
        }

        public function setNombreAutor($nombreAutor)
        {
            $this->nombreAutor = $nombreAutor;
        }

        public function setApellidosAutor($apellidosAutor)
        {
            $this->apellidosAutor = $apellidosAutor;
        }

        // Método para obtener el autor completo
        public function getAutor()
        {
            return $this->nombreAutor . " " . $this->apellidosAutor;
        }
    }


    class Class_libro extends Class_producto
    {
        private $numPaginas;
        private $editorial;
        function __construct(
            $id = null,
            $titulo = null,
            $precio = null,
            $nombreAutor = null,
            $apellidosAutor = null,
            $numPaginas = null,
            $editorial = null
        ) {
            // Llamada al método padre
            parent::__construct(
                $id,
                $titulo,
                $precio,
                $nombreAutor,
                $apellidosAutor,
            );
            $this->numPaginas = $numPaginas;
            $this->editorial = $editorial;
        }
        public function getNumPaginas()
        {
            return $this->numPaginas;
        }
        public function getResumen()
        {
            $resumen = "Titulo: " . $this->getTitulo() . ", Precio: " .$this->getPrecio();
            $resumen .= ", Autor: " . $this->getAutor() . ", Núm. páginas: " . $this->getNumPaginas();
            return $resumen;
        }

        public function muestra_libro() {
            // echo $this->getId(); --> esto también podríamos hacerlo con los getters
            echo $this->id;
            echo '<BR>';
            echo $this->titulo;
            echo '<BR>';
            echo $this->editorial;
            echo '<BR>';
            echo $this->numPaginas;
            echo '<BR>';
        }
=======
<?php

    class Class_producto
    {
        protected $id;
        protected $titulo;
        protected $precio;
        protected $nombreAutor;
        protected $apellidosAutor;

        public function __construct($id = null, $titulo = null, $precio = null, $nombreAutor = null, $apellidosAutor = null)
        {
            $this->id = $id;
            $this->titulo = $titulo;
            $this->precio = $precio;
            $this->nombreAutor = $nombreAutor;
            $this->apellidosAutor = $apellidosAutor;
        }

        // Getters
        public function getId()
        {
            return $this->id;
        }

        public function getTitulo()

        {
            return $this->titulo;
        }

        public function getPrecio()
        {
            return $this->precio;
        }

        public function getNombreAutor()
        {
            return $this->nombreAutor;
        }

        public function getApellidosAutor()
        {
            return $this->apellidosAutor;
        }

        // Setters
        public function setId($id)
        {
            $this->id = $id;
        }

        public function setTitulo($titulo)
        {
            $this->titulo = $titulo;
        }

        public function setPrecio($precio)
        {
            $this->precio = $precio;
        }

        public function setNombreAutor($nombreAutor)
        {
            $this->nombreAutor = $nombreAutor;
        }

        public function setApellidosAutor($apellidosAutor)
        {
            $this->apellidosAutor = $apellidosAutor;
        }

        // Método para obtener el autor completo
        public function getAutor()
        {
            return $this->nombreAutor . " " . $this->apellidosAutor;
        }
    }


    class Class_libro extends Class_producto
    {
        private $numPaginas;
        private $editorial;
        function __construct(
            $id = null,
            $titulo = null,
            $precio = null,
            $nombreAutor = null,
            $apellidosAutor = null,
            $numPaginas = null,
            $editorial = null
        ) {
            // Llamada al método padre
            parent::__construct(
                $id,
                $titulo,
                $precio,
                $nombreAutor,
                $apellidosAutor,
            );
            $this->numPaginas = $numPaginas;
            $this->editorial = $editorial;
        }
        public function getNumPaginas()
        {
            return $this->numPaginas;
        }
        public function getResumen()
        {
            $resumen = "Titulo: " . $this->getTitulo() . ", Precio: " .$this->getPrecio();
            $resumen .= ", Autor: " . $this->getAutor() . ", Núm. páginas: " . $this->getNumPaginas();
            return $resumen;
        }

        public function muestra_libro() {
            // echo $this->getId(); --> esto también podríamos hacerlo con los getters
            echo $this->id;
            echo '<BR>';
            echo $this->titulo;
            echo '<BR>';
            echo $this->editorial;
            echo '<BR>';
            echo $this->numPaginas;
            echo '<BR>';
        }
>>>>>>> 880701ca79aea3b9a52b24be21ccbac733d67c82
    }