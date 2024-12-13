<?php
/**
 * alumnoModel.php
 * 
 * Modelo del controlador alumno
 * 
 * Métodos:
 *      - get()
 */

 Class alumnoModel extends Model {
    /**
     * método: get()
     * Extrae los detalle de la tabla alumnos
     */

     public function get() {
        try {
            // sentencia sql
            $sql = "SELECT 
                alumnos.id,
                CONCAT(', ', alumnos.apellidos, alumnos.nombre) as alumno,
                alumnos.email,
                alumnos.telefono,
                alumnos.nacionalidad,
                alumnos.dni,
                timestampdiff(YEAR, alumnos.fechaNac, NOW()) AS edad,
                cursos.nombreCorto AS curso
            FROM 
                alumnos 
            INNER JOIN
                cursos
            ON alumnos.id_curso = cursos.id
            ORDER BY alumnos.id";

            // conectamos con la base de datos
            $conexion = $this->db->connect();

            // ejecuto prepare
            $stmt = $conexion->prepare($sql);

            // establezco tipo fetch
            $stmt->setFetchMode(PDO::FETCH_OBJ);

            // ejcutamos
            $stmt->execute();

            // devuelvo objeto pdostatement
            return $stmt;

        } catch (PDOException $e) {

            // error base de datos
            require ('templatepartials/errorDB.partial.php');

            $stmt = null;

            $conexion = null;

            $this->db = null;
        }
     }
 }