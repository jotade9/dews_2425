<<<<<<< HEAD
<?php
/**
 * archivo: class.libro.php 
 * descripción: definicion d ela clase libro con encapsulamiento
 */

 class Class_libro{
    private $id;
    private $titulo;
    private $precio;
    private $paginas;
    private $autor;
    private $tematicas;

    public function __construct(
        $id = null,
        $titulo = null,
        $precio = 0,
        $paginas = 0,
        $autor = null,
        $tematicas = []
    )
    {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->precio = $precio;
        $this->paginas = $paginas;
        $this->autor = $autor;
        $this->tematicas = $tematicas;
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
     * Get the value of paginas
     */
    public function getPaginas()
    {
        return $this->paginas;
    }

    /**
     * Set the value of paginas
     */
    public function setPaginas($paginas): self
    {
        $this->paginas = $paginas;

        return $this;
    }

    /**
     * Get the value of autor
     */
    public function getAutor()
    {
        return $this->autor;
    }

    /**
     * Set the value of autor
     */
    public function setAutor($autor): self
    {
        $this->autor = $autor;

        return $this;
    }

    /**
     * Get the value of tematica
     */
    public function getTematicas()
    {
        return $this->tematicas;
    }

    /**
     * Set the value of tematica
     */
    public function setTematica($tematicas): self
    {
        $this->tematicas = $tematicas;

        return $this;
    }
=======
<<<<<<< HEAD
<?php
/**
 * archivo: class.libro.php 
 * descripción: definicion d ela clase libro con encapsulamiento
 */

 class Class_libro{
    private $id;
    private $titulo;
    private $precio;
    private $paginas;
    private $autor;
    private $tematicas;

    public function __construct(
        $id = null,
        $titulo = null,
        $precio = 0,
        $paginas = 0,
        $autor = null,
        $tematicas = []
    )
    {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->precio = $precio;
        $this->paginas = $paginas;
        $this->autor = $autor;
        $this->tematicas = $tematicas;
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
     * Get the value of paginas
     */
    public function getPaginas()
    {
        return $this->paginas;
    }

    /**
     * Set the value of paginas
     */
    public function setPaginas($paginas): self
    {
        $this->paginas = $paginas;

        return $this;
    }

    /**
     * Get the value of autor
     */
    public function getAutor()
    {
        return $this->autor;
    }

    /**
     * Set the value of autor
     */
    public function setAutor($autor): self
    {
        $this->autor = $autor;

        return $this;
    }

    /**
     * Get the value of tematica
     */
    public function getTematicas()
    {
        return $this->tematicas;
    }

    /**
     * Set the value of tematica
     */
    public function setTematica($tematicas): self
    {
        $this->tematicas = $tematicas;

        return $this;
    }
=======
<?php
/**
 * archivo: class.libro.php 
 * descripción: definicion d ela clase libro con encapsulamiento
 */

 class Class_libro{
    private $id;
    private $titulo;
    private $precio;
    private $paginas;
    private $autor;
    private $tematicas;

    public function __construct(
        $id = null,
        $titulo = null,
        $precio = 0,
        $paginas = 0,
        $autor = null,
        $tematicas = []
    )
    {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->precio = $precio;
        $this->paginas = $paginas;
        $this->autor = $autor;
        $this->tematicas = $tematicas;
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
     * Get the value of paginas
     */
    public function getPaginas()
    {
        return $this->paginas;
    }

    /**
     * Set the value of paginas
     */
    public function setPaginas($paginas): self
    {
        $this->paginas = $paginas;

        return $this;
    }

    /**
     * Get the value of autor
     */
    public function getAutor()
    {
        return $this->autor;
    }

    /**
     * Set the value of autor
     */
    public function setAutor($autor): self
    {
        $this->autor = $autor;

        return $this;
    }

    /**
     * Get the value of tematica
     */
    public function getTematicas()
    {
        return $this->tematicas;
    }

    /**
     * Set the value of tematica
     */
    public function setTematica($tematicas): self
    {
        $this->tematicas = $tematicas;

        return $this;
    }
>>>>>>> 880701ca79aea3b9a52b24be21ccbac733d67c82
>>>>>>> 7c139080c002fe1675da1016599ab6d972ca90e2
 }