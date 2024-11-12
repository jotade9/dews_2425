<?php
/**
 * clase: class.tabla_alumno$alumnos.php 
 * descripcion: define la clase que va a contener el array de objetos de la clase alumnos
 */

 class Class_tabla_alumnos
 {
    private $tabla;
    
    public function __construct()
    {
        $this->tabla = [];
    }

    /**
     * Get the value of tabla
     */
    public function getTabla()
    {
        return $this->tabla;
    }

    /**
     * Set the value of tabla
     */
    public function setTabla($tabla): self
    {
        $this->tabla = $tabla;

        return $this;
    }
    public function getCurso(){
        $cursos = [
            '1SMR',
            '2SMR',
            '1DAW',
            '2DAW',
            '1AD',
            '2AD'
        ];
        asort($cursos);
        return $cursos;
    }
    public function getAsignaturas(){
        $asignaturas = [
            'DWES',
            'DWEC',
            'Despliegue Aplicaciones',
            'HLC',
            'EINEM',
            'Diseño Interfaces'
        ];
        asort($asignaturas);
        return $asignaturas;
    }
    /**
     * método: getAlumnos()
     * descripcion: devuelve un aray de objetos
     */
    public function getAlumnos(){
        # Alumno 1
        $alumno = new Class_alumno(
            1,
            'Juan',
            'Perez Garcia',
            'juanpg@gmail.com',
            '11-11-2002',
            0,
            [1, 3, 5]

        );
        # Añado el objeto a la tabla
        $this->tabla[] = $alumno;

        # Alumno 2
        $alumno = new Class_alumno(
            2,
            'Maria',
            'Lopez Martinez', 
            'maria.lopez@gmail.com', 
            '20-05-2003', 
            3, 
            [2, 3]
        );
        # Añado el objeto a la tabla
        $this->tabla[] = $alumno;

        # Alumno 3
        $alumno = new Class_alumno(
            3,
            'Carlos',
            'Gomez Sanchez',
            'carlosg@gmail.com',
            '15-02-2001',
            0,
            [4, 5]

        );
        #Añado el objeto a la tabla
        $this->tabla[] = $alumno;

        # Alumno 4
        $alumno = new Class_alumno(
            4,
            'Ana',
            'Martinez Ruiz',
            'anamr@gmail.com',
            '30-07-2002',
            1,
            [0, 5]
        );
        # Añado el objeto a la tabla
        $this->tabla[] = $alumno;

        # Alumno 5
        $alumno = new Class_alumno(
            5,
            'Luis',
            'Fernandez Soto',
            'luisfs@gmail.com',
            '05-09-2003',
            2,
            [1,4]
        );
        # Añado el objeto a la tabla
        $this->tabla[] = $alumno;
    }
    /**
     * Método: mostrar_nombre_categoria()
     * descripcion: devuelve un array con el nombre de las asignaturas
     * parámetros:
     *      -indice_asignaturas
     */

     public function mostrar_nombre_asignaturas($indice_asignaturas = []){
        # Creo un array de nombre de asignaturas vacio
        $nombre_asignaturas = [];

        # Cargo el array de asignaturas de los alumnos
        $asignaturas_alumnos = $this->getAsignaturas();

        foreach ($indice_asignaturas as $indice_asignatura) {
            $nombre_asignaturas[]=$asignaturas_alumnos[$indice_asignatura];
        }
        # Ordeno
        asort($nombre_asignaturas);
        return $nombre_asignaturas;
     }
     /**
      * método: create()
      * descripcion: permite añadir un nuevo objeto de la clase alumno a la tabla
      * parámetros:
      *     - $alumno - objeto de a clase alumno
      */
      public function create(Class_alumno $alumno){
        $this->tabla[] = $alumno;
      }
 }