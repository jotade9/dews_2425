<?php

/*
    clase: class.tabla_articulos.php
    descripcion: define la clase que va a contener el array de objetos de la clase alumnos.
*/

class Class_tabla_alumnos extends Class_conexion
{


    /*
        método: getAlumnos()
        descripcion: devuelve un array de objetos
    */

    public function getAlumnos()
{
        $sql = "
            select
                alumnos.id,
                alumnos.nombre,
                alumnos.apellidos,
                alumnos.email,
                alumnos.telefono,
                alumnos.nacionalidad,
                alumnos.dni,
                timestampdiff(YEAR, alumnos.fechaNac, now()) as edad,
                cursos.nombreCorto as curso
            FROM
                alumnos
            INNER JOIN
                cursos
            ON alumnos.id_curso = cursos.id
        ";

        // ejecuto comando sql
        $result = $this->mysqli->query($sql);

        // obtengo un objeto de la clase mysqli_result
        // deuelvo dicho objeto
        return $result;

}

    /*
        método: create()
        descripcion: permite añadir un objeto de la clase artículo a la tabla
        parámetros:

            - $articulo - objeto de la clase artículos

    */
    public function create(Class_alumno $alumno)
    {
        $this->tabla[] = $alumno;
    }



    /*
        método: read()
        descripción: permite obtener el objeto de la clase artículo  correspondiente a un índice de la tabla
        parámetros:
            - $indice - índice de la tabla
    */

    public function read($indice)
    {
        return $this->tabla[$indice];
    }


    /*
        método: update()
        descripción: permite actualizar los detalles de un artículo en la tabla

        parámetros:
            $articulo - objeto de la clase artículo, con los detalles actualizados
            $ indice - indice de la tabla
    */

    public function update(Class_alumno $alumno, $indice)
    {
        $this->tabla[$indice] = $alumno;
    }

    /*
        método: delete()
        descripción: permite eliminar un alumno en la tabla

        parámetros:
            $ indice - indice de la tabla en la que se encuentra el articulo
    */

    public function delete($indice)
    {
        unset($this->tabla[$indice]);
    }
}
