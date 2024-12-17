<?php
/*
    alumnoModel.php
    Modelo del controlador alumno

    Métodos:
        - get()
*/
class alumnoModel extends Model
{

    /**
     * Método: get()
     * Extrae los detalles de la tabla alumnos
     * @return void
     */
    public function get()
    {
        try {
            //sentencia sql
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

            // ejecuto el prepare
            $stmt = $conexion->prepare($sql);

            //establezco el tipo de fetch
            $stmt->setFetchMode(PDO::FETCH_OBJ);

            //Ejecutamos
            $stmt->execute();

            //devuelvo objeto pdostatement
            return $stmt;
        } catch (mysqli_sql_exception $e) {

            // error de  base dedatos
            include 'template/partials/errorDB.partial.php';



            // libero result
            $result->close();

            // cierro conexión
            $this->db->close();

            // cancelo ejecución programa
            exit();
        } catch (PDOException $s) {
            // error de  base dedatos
            include 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
        }
    }





    /**
     * Método: get_cursos()
     * Extrae los detalles de la tabla alumnos
     * @return void
     */
    public function get_cursos()
    {
        try {
            //sentencia sql
            $sql = "SELECT
                id,
                nombre as curso
            FROM
                cursos
            ORDER BY
                2
            ";

            // conectamos con la base de datos
            $conexion = $this->db->connect();

            // ejecuto el prepare
            $stmt = $conexion->prepare($sql);

            //establezco el tipo de fetch
            $stmt->setFetchMode(PDO::FETCH_KEY_PAIR);

            //Ejecutamos
            $stmt->execute();

            //devuelvo objeto pdostatement
            return $stmt;
        } catch (mysqli_sql_exception $e) {

            // error de  base dedatos
            include 'template/partials/errorDB.partial.php';



            // libero result
            $result->close();

            // cierro conexión
            $this->db->close();

            // cancelo ejecución programa
            exit();
        } catch (PDOException $s) {
            // error de  base dedatos
            include 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
        }
    }
}
