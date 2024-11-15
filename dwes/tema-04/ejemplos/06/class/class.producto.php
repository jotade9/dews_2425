<<<<<<< HEAD
<?php
class Class_producto
{
    protected $id;
    protected $titulo;
    protected $precio;
    protected $nombreAutor;
    protected $apellidosAutor;
    function __construct(
        $id = null,
        $titulo = null,
        $precio = null,
        $nombreAutor = null,
        $apellidosAutor = null
    ) {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->nombreAutor = $nombreAutor;
        $this->apellidosAutor = $apellidosAutor;
        $this->precio = $precio;
    }
    public function getNombreAutor()
    {
        return $this->nombreAutor;
    }
    public function getApellidosAutor()
    {
        return $this->apellidosAutor;
    }
    public function getTitulo()
    {
        return $this->titulo;
    }
    public function getPrecio()
    {
        return $this->precio;
    }
}

class Class_libro extends Class_producto
{   
    private $num_paginas;
    private$editorial;
    public function __construct(
        $id = null,
        $titulo = null,
        $precio = null,
        $nombreAutor = null,
        $apellidosAutor = null,
        $num_paginas = null,
        $editorial = null
    )
    {
        // llamada al constructor padre
        parent::__construct($id,$titulo,$precio,$nombreAutor,$apellidosAutor);
        $this->num_paginas = $num_paginas;
        $this->editorial = $editorial;
    }
    public function getResumen()
    {
        $resumen = "Titulo: " . $this->getTitulo() . ", Precio: " . $this->getPrecio();

        $resumen .= ", Autor: " . $this->getNombreAutor() . ", Núm.   páginas: " . $this->getNumPaginas();

        $resumen .= ", Editorial: ". $this->getEditorial();
        
        return $resumen;
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
     * Get the value of titulo
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set the value of titulo
     */
    public function setTitulo($titulo): self
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get the value of precio
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set the value of precio
     */
    public function setPrecio($precio): self
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Get the value of nombreAutor
     */
    public function getNombreAutor()
    {
        return $this->nombreAutor;
    }

    /**
     * Set the value of nombreAutor
     */
    public function setNombreAutor($nombreAutor): self
    {
        $this->nombreAutor = $nombreAutor;

        return $this;
    }

    /**
     * Get the value of apellidosAutor
     */
    public function getApellidosAutor()
    {
        return $this->apellidosAutor;
    }

    /**
     * Set the value of apellidosAutor
     */
    public function setApellidosAutor($apellidosAutor): self
    {
        $this->apellidosAutor = $apellidosAutor;

        return $this;
    }

    /**
     * Get the value of num_paginas
     */
    public function getNumPaginas()
    {
        return $this->num_paginas;
    }

    /**
     * Set the value of num_paginas
     */
    public function setNumPaginas($num_paginas): self
    {
        $this->num_paginas = $num_paginas;

        return $this;
    }
    /**
     * Get the value of num_paginas
     */
    public function getEditorial()
    {
        return $this->editorial;
    }

    /**
     * Set the value of num_paginas
     */
    public function setEditorial($editorial): self
    {
        $this->editorial = $editorial;

        return $this;
    }
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
    function __construct(
        $id = null,
        $titulo = null,
        $precio = null,
        $nombreAutor = null,
        $apellidosAutor = null
    ) {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->nombreAutor = $nombreAutor;
        $this->apellidosAutor = $apellidosAutor;
        $this->precio = $precio;
    }
    public function getNombreAutor()
    {
        return $this->nombreAutor;
    }
    public function getApellidosAutor()
    {
        return $this->apellidosAutor;
    }
    public function getTitulo()
    {
        return $this->titulo;
    }
    public function getPrecio()
    {
        return $this->precio;
    }
}

class Class_libro extends Class_producto
{   
    private $num_paginas;
    private$editorial;
    public function __construct(
        $id = null,
        $titulo = null,
        $precio = null,
        $nombreAutor = null,
        $apellidosAutor = null,
        $num_paginas = null,
        $editorial = null
    )
    {
        // llamada al constructor padre
        parent::__construct($id,$titulo,$precio,$nombreAutor,$apellidosAutor);
        $this->num_paginas = $num_paginas;
        $this->editorial = $editorial;
    }
    public function getResumen()
    {
        $resumen = "Titulo: " . $this->getTitulo() . ", Precio: " . $this->getPrecio();

        $resumen .= ", Autor: " . $this->getNombreAutor() . ", Núm.   páginas: " . $this->getNumPaginas();

        $resumen .= ", Editorial: ". $this->getEditorial();
        
        return $resumen;
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
     * Get the value of titulo
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set the value of titulo
     */
    public function setTitulo($titulo): self
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get the value of precio
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set the value of precio
     */
    public function setPrecio($precio): self
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Get the value of nombreAutor
     */
    public function getNombreAutor()
    {
        return $this->nombreAutor;
    }

    /**
     * Set the value of nombreAutor
     */
    public function setNombreAutor($nombreAutor): self
    {
        $this->nombreAutor = $nombreAutor;

        return $this;
    }

    /**
     * Get the value of apellidosAutor
     */
    public function getApellidosAutor()
    {
        return $this->apellidosAutor;
    }

    /**
     * Set the value of apellidosAutor
     */
    public function setApellidosAutor($apellidosAutor): self
    {
        $this->apellidosAutor = $apellidosAutor;

        return $this;
    }

    /**
     * Get the value of num_paginas
     */
    public function getNumPaginas()
    {
        return $this->num_paginas;
    }

    /**
     * Set the value of num_paginas
     */
    public function setNumPaginas($num_paginas): self
    {
        $this->num_paginas = $num_paginas;

        return $this;
    }
    /**
     * Get the value of num_paginas
     */
    public function getEditorial()
    {
        return $this->editorial;
    }

    /**
     * Set the value of num_paginas
     */
    public function setEditorial($editorial): self
    {
        $this->editorial = $editorial;

        return $this;
    }
}
>>>>>>> 880701ca79aea3b9a52b24be21ccbac733d67c82
