<?php
/*
    autorModel.php

    Modelo del controlador autor

    Métodos:

        - get()
*/

class autorModel extends Model
{

    /*
        método: get()

        Extre los detalles de la tabla autores
    */
    public function get()
    {

        try {

            // sentencia sql
            $sql = "SELECT 
                autores.id,
                autores.nombre as autor,
                autores.nacionalidad,
                autores.email,
                autores.fecha_nac,
                autores.fecha_def,
                autores.premios
            FROM 
                autores
            ORDER BY 
                autores.id;
            ;";

            // conectamos con la base de datos
            $conexion = $this->db->connect();

            // ejecuto prepare
            $stmt = $conexion->prepare($sql);

            // establezco tipo fetch
            $stmt->setFetchMode(PDO::FETCH_OBJ);

            // ejecutamos
            $stmt->execute();

            // devuelvo objeto stmtatement
            return $stmt;
        } catch (PDOException $e) {

            // error base de datos
            require 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
        }
    }
    /*
        método: get_csv()

        Extre los detalles de la tabla autores
    */
    public function get_csv()
    {

        try {

            // sentencia sql
            $sql = "SELECT 
                autores.id,
                autores.nombre as autor,
                autores.nacionalidad,
                autores.email,
                autores.fecha_nac,
                autores.fecha_def,
                autores.premios
            FROM 
                autores
            ;";

            // conectamos con la base de datos
            $conexion = $this->db->connect();

            // ejecuto prepare
            $stmt = $conexion->prepare($sql);

            // establezco tipo fetch
            $stmt->setFetchMode(PDO::FETCH_NUM);

            // ejecutamos
            $stmt->execute();

            // devuelvo objeto stmtatement
            return $stmt;
        } catch (PDOException $e) {

            // error base de datos
            require 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
        }
    }
    /**
     * Método: import
     * descripción: importa un fichero csv con los datos de los autores
     * 
     * @param:
     * - $autores: array con los datos del fichero csv
     */
    public function import($autores)
    {
        try {

            $sql = "INSERT INTO autores (
                id,
                nombre,
                nacionalidad,
                email,
                fecha_nac,
                fecha_def,
                premios
            )
            VALUES (
                :id,
                :nombre,
                :nacionalidad,
                :email,
                :fecha_nac,,
                :fecha_def,,
                :premios
            )";

            $conexion = $this->db->connect();
            $stmt = $conexion->prepare($sql);

            foreach ($autores as $autor) {
                // Reemplazar caracteres específicos en el título
                $idLimpio = str_replace(["'", '"'], "", $autor[0]);

                $stmt->bindParam(':id', $idLimpio, PDO::PARAM_STR, 80);
                $stmt->bindParam(':nombre', $autor[1], PDO::PARAM_STR);
                $stmt->bindParam(':nacionalidad', $autor[2], PDO::PARAM_STR);
                $stmt->bindParam(':email', $autor[3], PDO::PARAM_STR);
                $stmt->bindParam(':fecha_nac,', $autor[4], PDO::PARAM_STR);
                $stmt->bindParam(':fecha_def,', $autor[5], PDO::PARAM_STR);
                $stmt->bindParam(':premios', $autor[6], PDO::PARAM_INT);

                $stmt->execute();
            }
        } catch (PDOException $e) {
            // error base de datos
            require_once 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
        }
    }
    /*
        método: create

        descripción: añade nuevo autor a la tabla autores
        parámetros: objeto de classAutor
    */
    public function create($autor)
    {
        try {

            // sentencia sql
            $sql = "INSERT INTO autores (
                nombre,
                nacionalidad,
                email,
                fecha_nac,
                fecha_def,
                premios
            )
            VALUES (
                :nombre,
                :nacionalidad,
                :email,
                :fecha_nac,
                :fecha_def,
                :premios
            )";

            // conectamos con la base de datos
            $conexion = $this->db->connect();

            // ejecuto prepare
            $stmt = $conexion->prepare($sql);

            // establezco tipo fetch
            $stmt->setFetchMode(PDO::FETCH_OBJ);

            // bindParam
            $stmt->bindParam(':nombre', $autor->nombre, PDO::PARAM_STR);
            $stmt->bindParam(':nacionalidad', $autor->nacionalidad, PDO::PARAM_STR);
            $stmt->bindParam(':email', $autor->email, PDO::PARAM_STR);
            $stmt->bindParam(':fecha_nac', $autor->fecha_nac, PDO::PARAM_STR);
            $stmt->bindParam(':fecha_def', $autor->fecha_def, PDO::PARAM_STR);
            $stmt->bindParam(':premios', $autor->premios, PDO::PARAM_INT);

            // ejecutamos
            $stmt->execute();
        } catch (PDOException $e) {

            // error base de datos
            require 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
        }
    }
    /*
        método: read

        descripción: obtiene los detalles de un autor
        parámetros: id del autor
        devuelve: objeto con los detalles del autor
        
    */
    public function read($id)
    {
        try {

            // sentencia sql
            $sql = "SELECT 
                autores.id,
                autores.nombre as autor,
                autores.nacionalidad,
                autores.email,
                autores.fecha_nac,
                autores.fecha_def,
                autores.premios
            FROM 
                autores
            WHERE 
                autores.id = :id
            ;";

            // conectamos con la base de datos
            $conexion = $this->db->connect();

            // ejecuto prepare
            $stmt = $conexion->prepare($sql);

            // establezco tipo fetch
            $stmt->setFetchMode(PDO::FETCH_OBJ);

            // bindParam
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            // ejecutamos
            $stmt->execute();

            // devuelvo objeto stmtatement
            return $stmt;
        } catch (PDOException $e) {

            // error base de datos
            require 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
        }
    }
    /*
        método: update

        descripción: actualiza los detalles de un autor

        @param:
            
        objeto de classAutor
        id del autor
    */
    public function update(classAutor $autor, $id)
    {
        try {

            // sentencia sql
            $sql = "UPDATE autores SET
                nombre = :nombre,
                nacionalidad = :nacionalidad,
                email = :email,
                fecha_nac = :fecha_nac,
                fecha_def = :fecha_def,
                premios = :premios
            WHERE 
                id = :id
            ;";

            // conectamos con la base de datos
            $conexion = $this->db->connect();

            // ejecuto prepare
            $stmt = $conexion->prepare($sql);

            // establezco tipo fetch
            $stmt->setFetchMode(PDO::FETCH_OBJ);

            // bindParam
            $stmt->bindParam(':nombre', $autor->nombre, PDO::PARAM_STR);
            $stmt->bindParam(':nacionalidad', $autor->nacionalidad, PDO::PARAM_STR);
            $stmt->bindParam(':email', $autor->email, PDO::PARAM_STR);
            $stmt->bindParam(':fecha_nac', $autor->fecha_nac, PDO::PARAM_STR);
            $stmt->bindParam(':fecha_def', $autor->fecha_def, PDO::PARAM_STR);
            $stmt->bindParam(':premios', $autor->premios, PDO::PARAM_INT);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            // ejecutamos
            $stmt->execute();
        } catch (PDOException $e) {

            // error base de datos
            require 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
        }
    }

    /*
        método: delete

        descripción: elimina un autor

        @param: id del autor
    */
    public function delete($id)
    {
        try {

            // sentencia sql
            $sql = "DELETE FROM autores WHERE id = :id;";

            // conectamos con la base de datos
            $conexion = $this->db->connect();

            // ejecuto prepare
            $stmt = $conexion->prepare($sql);

            // establezco tipo fetch
            $stmt->setFetchMode(PDO::FETCH_OBJ);

            // bindParam
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            // ejecutamos
            $stmt->execute();
        } catch (PDOException $e) {

            // error base de datos
            require 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
        }
    }
    /*
        método: filter

        descripción: filtra los autores por una expresión

        @param: expresión a buscar
    */
    public function filter($expresion)
    {
        try {

            // sentencia sql
            $sql = "SELECT 
                autores.id,
                autores.nombre as autor,
                autores.nacionalidad,
                autores.email,
                autores.fecha_nac,
                autores.fecha_def,
                autores.premios
            FROM 
                autores
            WHERE 
                autores.nombre LIKE :expresion
            ORDER BY 
                autores.id;
            ;";

            // conectamos con la base de datos
            $conexion = $this->db->connect();

            // ejecuto prepare
            $stmt = $conexion->prepare($sql);

            // establezco tipo fetch
            $stmt->setFetchMode(PDO::FETCH_OBJ);

            // bindParam
            $stmt->bindParam(':expresion', $expresion, PDO::PARAM_STR);

            // ejecutamos
            $stmt->execute();

            // devuelvo objeto stmtatement
            return $stmt;
        } catch (PDOException $e) {

            // error base de datos
            require 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
        }
    }
    /*
        método: order

        descripción: ordena los autores por un campo

        @param: criterio por el que ordenar
    */
    public function order(int $criterio)
    {
        try {

            // sentencia sql
            $sql = "SELECT 
                autores.id,
                autores.nombre as autor,
                autores.nacionalidad,
                autores.email,
                autores.fecha_nac,
                autores.fecha_def,
                autores.premios
            FROM 
                autores
            ORDER BY 
                :criterio;
            ;";

            // conectamos con la base de datos
            $conexion = $this->db->connect();

            // ejecuto prepare
            $stmt = $conexion->prepare($sql);

            // establezco tipo fetch
            $stmt->setFetchMode(PDO::FETCH_OBJ);

            // bindParam
            $stmt->bindParam(':criterio', $criterio, PDO::PARAM_STR);

            // ejecutamos
            $stmt->execute();

            // devuelvo objeto stmtatement
            return $stmt;
        } catch (PDOException $e) {

            // error base de datos
            require 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
        }
    }
}