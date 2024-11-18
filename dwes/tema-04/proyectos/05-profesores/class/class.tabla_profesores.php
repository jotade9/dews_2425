<?php

/**
 * archivo: class.tabla_profesor.php 
 * descripcion: define la clase que va a tener la array de objetos de la clase articulos
 */

class Class_tabla_profesores
{
    public $tabla;
    public function __construct()
    {
        $this->tabla = [];
    }

    public function getEspecialidad()
    {
        $especialidades = [
            'Literatura Española',
            'Ciencias Sociales',
            'Matemáticas',
            'Ciencias de la Salud',
            'Ingeniería',
            'Tecnología',
            'Humanidades',
            'Artes',
            'Informática',
            'Religión',
            'Inglés'
        ];
        
        return $especialidades;
    }

    public function getAsignaturas()
    {
        $asignaturas = [
            'Sistemas informáticos',
            'Bases de datos',
            'Programación',
            'Lenguajes de marcas y sistemas de gestión de información',
            'Entornos de desarrollo',
            'Desarrollo web en entorno cliente',
            'Desarrollo web en entorno servidor',
            'Despliegue de aplicaciones web',
            'Diseño de interfaces web',
            'Empresa e iniciativa emprendedora',
            'Formación y orientación laboral (FOL)',
            'Proyecto de desarrollo de aplicaciones web (normalmente al final del ciclo)',
            'Inglés técnico'
        ];
        return $asignaturas;
    }
    /**
     * metodo: getDatos()
     * descripcion: devuelve un array de objetos
     */
    public function getDatos()
    {
        # profesor 1
        $profesor = new Class_profesor(
            1,
            'Carlos',
            'López Fernández',
            'NRP12345',
            '25-03-1985',
            'Madrid',
            1,
            [0, 2, 5]
        );
        $this->tabla[] = $profesor;

        # profesor 2
        $profesor = new Class_profesor(
            2,
            'Ana',
            'García Martínez',
            'NRP23456',
            '10-07-1990',
            'Barcelona',
            8,  // Especialidad: Informática
            [1, 3, 6]  // Asignaturas: Bases de datos, Lenguajes de marcas, Desarrollo web en entorno servidor
        );
        $this->tabla[] = $profesor;
        
        $profesor = new Class_profesor(
            3,
            'Juan',
            'Pérez Sánchez',
            'NRP34567',
            '30-12-1978',
            'Valencia',
            0,  // Especialidad: Literatura Española
            [0, 2, 8]  // Asignaturas: Sistemas informáticos, Programación, Diseño de interfaces web
        );
        $this->tabla[] = $profesor;
        
        $profesor = new Class_profesor(
            4,
            'María',
            'Rodríguez Gómez',
            'NRP45678',
            '15-05-1982',
            'Sevilla',
            5,  // Especialidad: Tecnología
            [4, 7, 9]  // Asignaturas: Entornos de desarrollo, Despliegue de aplicaciones web, Empresa e iniciativa emprendedora
        );
        $this->tabla[] = $profesor;
        
        $profesor = new Class_profesor(
            5,
            'Pedro',
            'Martínez Pérez',
            'NRP56789',
            '20-11-1995',
            'Bilbao',
            6,  // Especialidad: Humanidades
            [3, 5, 10]  // Asignaturas: Lenguajes de marcas, Desarrollo web en entorno cliente, Formación y orientación laboral (FOL)
        );
        $this->tabla[] = $profesor;
    }

    public function mostrar_nombre_asignatura($indice_asignatura = []){
        # creo array de nombre de categorías vacío
        $nombre_asignatura = [];
        # Cargo el array de especialidad de los prfesores
        $asignatura_profesor = $this->getAsignaturas();

        foreach ($indice_asignatura as $indice) {
            $nombre_asignatura[] = $asignatura_profesor[$indice];
        }
        # Ordeno
        asort($nombre_asignatura);
        return $nombre_asignatura;

    }

    /**
     * metodo: create()
     * descripcion: permite añadir un objeto de la clase profesor a la tabla
     * prametros:
     *      - $profesor - objeto de la clase profesor
     */

     public function create(Class_profesor $profesor){
        $this->tabla[] = $profesor;
     }

     /**
      * metodo: read()
      * descripcion: permite obtener el objeto de la clase profesor correspondiente a un indice de la tabla
      * parámetros: 
      *     - $indice - indice de la tabla
      */

      public function read($indice){
        return $this->tabla[$indice];
      }

      /**
       * metodo: update()
       * descripcion: permit actualizar los detalles de un profesor de la tabla
       * parámetros:
       *        - $profesor - objeto de la clase profesor, con los detalles actualizados
       *        - $indice - indice de la tabla
       */

       public function update(Class_profesor $profesor, $indice){
        $this->tabla[$indice] = $profesor;
       }
       
       /**
        * metodo: delete()
        * descripcion: permite eliminar un profesor en la tabla
        * parámetros: 
        *       $indice - indice de la tabla en que se encuentra el profesor
        *
        */

        public function delete($indice){
            unset($this->tabla[$indice]);
        }
}
