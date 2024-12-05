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
        $result = $this->db->query($sql);

        // obtengo un objeto de la clase mysqli_result
        // deuelvo dicho objeto
        return $result;
    }

    /*
        método: create()
        descripcion: permite añadir un objeto de la clase alumno a la tabla
        parámetros:

            - $aalumno - objeto de la clase alumno

    */
    public function create(Class_alumno $alumno)
    {
        // Crear la sententencia preparada
        $sql = "
        INSERT INTO
            alumnos(
                    nombre,
                    apellidos,
                    email,
                    telefono,
                    nacionalidad,
                    dni,
                    fechaNac,
                    id_curso
                    )
            VALUES      ( ?, ?, ?, ?, ?, ?, ?, ?)
            ";
        // ejecuto la sentencia preparada
        $stmt = $this->db->prepare($sql);

        // Verifico la sentencia
        if ($stmt === false) {
            die("ERROR al preparar SQL" . $this->db->error);
        }
        // vinculamos los parámetros
        $stmt->bind_param(
            "sssisssi",
            $nombre,
            $apellidos,
            $email,
            $telefono,
            $nacionalidad,
            $dni,
            $fechaNac,
            $id_curso
        );

        // asignar valores
        $nombre = $alumno->nombre;
        $apellidos = $alumno->apellidos;
        $email = $alumno->email;
        $telefono = $alumno->telefono;
        $nacionalidad = $alumno->nacionalidad;
        $dni = $alumno->dni;
        $fechaNac = $alumno->fechaNac;
        $id_curso = $alumno->id_curso;
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

    /**
     * getCursos()
     * 
     * Métod que me devuelve todos los cursos en un array assoc de cursos
     */
    public function getCursos(){
        $sql = "
            SELECT
                    id,
                    nombreCorto as curso
            FROM
                    cursos
            ORDER BY
                    nombreCorto ASC
        ";
        $result = $this->db->query($sql);

        // devuelve todos los valores de la tabla cursos
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
