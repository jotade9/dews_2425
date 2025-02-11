<?php

/*
    albumModel.php

    Modelo del controlador album

    Métodos:

        - get()
*/

class albumModel extends Model
{

    /*
        método: get()

        Extre los detalles de la tabla albumes
    */
    public function get()
    {

        try {

            // sentencia sql
            $sql = "SELECT 
                albumes.id,
                albumes.titulo,
                albumes.lugar,
                albumes.categoria,
                albumes.etiquetas,
                albumes.num_fotos,
                albumes.num_visitas
            FROM 
                albumes 
            ORDER BY albumes.id";

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
       método: get_cursos()

       Extre los detalles de los cursos para generar lista desplegable 
       dinámica
   */
    public function get_cursos()
    {

        try {

            // sentencia sql
            $sql = "SELECT 
                        id,
                        titulo as curso
                    FROM 
                        cursos
                    ORDER BY
                        2
            ";

            // conectamos con la base de datos
            $conexion = $this->db->connect();

            // ejecuto prepare
            $stmt = $conexion->prepare($sql);

            // establezco tipo fetch
            $stmt->setFetchMode(PDO::FETCH_KEY_PAIR);

            // ejecutamos
            $stmt->execute();

            // devuelvo objeto stmtatement
            return $stmt->fetchAll();
        } catch (PDOException $e) {

            // error base de datos
            require 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
        }
    }

    /*
        método: create

        descripción: añade nuevo album
        parámetros: objeto de classalbum
    */

    public function create(classAlbum $album)
    {

        try {
            $sql = "INSERT INTO albumes (
                    titulo,
                    descripcion,
                    autor,
                    fecha,
                    lugar,
                    categoria,
                    etiquetas,
                    carpeta
                )
                VALUES (
                    :titulo,
                    :descripcion,
                    :autor,
                    :fecha,
                    :lugar,
                    :categoria,
                    :etiquetas,
                    :carpeta
                )
            ";
            # Conectar con la base de datos
            $conexion = $this->db->connect();


            $stmt = $conexion->prepare($sql);

            $stmt->bindParam(':titulo', $album->titulo, PDO::PARAM_STR, 30);
            $stmt->bindParam(':descripcion', $album->descripcion, PDO::PARAM_STR, 50);
            $stmt->bindParam(':autor', $album->autor, PDO::PARAM_STR, 50);
            $stmt->bindParam(':fecha', $album->fecha, PDO::PARAM_STR, 50);
            $stmt->bindParam(':lugar', $album->lugar, PDO::PARAM_STR, 50);
            $stmt->bindParam(':categoria', $album->categoria, PDO::PARAM_STR, 13);
            $stmt->bindParam(':etiquetas', $album->etiquetas, PDO::PARAM_STR, 30);
            $stmt->bindParam(':carpeta', $album->carpeta, PDO::PARAM_STR, 9);


            // añado album
            $stmt->execute();
        } catch (PDOException $e) {
            // error base de datos
            require_once 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
        }
    }

    /*
        método: read

        descripción: obtiene los detalles de un album
        parámetros: id del album
        devuelve: objeto con los detalles del album
        
    */

    public function read(int $id)
    {

        try {
            $sql = "
                    SELECT 
                            id,
                            titulo, 
                            descripcion,
                            autor,
                            fecha,
                            lugar,
                            categoria,
                            etiquetas,
                            carpeta
                    FROM 
                            albumes
                    WHERE
                            id = :id
                    LIMIT 1
            ";

            # Conectar con la base de datos
            $conexion = $this->db->connect();


            $stmt = $conexion->prepare($sql);

            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->setFetchMode(PDO::FETCH_OBJ);
            $stmt->execute();

            return $stmt->fetch();
        } catch (PDOException $e) {
            // // error base de datos
            require_once 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
            exit();

        }
    }

    /*
        método: update

        descripción: actualiza los detalles de un album

        @param:
            - objeto de classalbum
            - id del album
    */

    public function update(classAlbum $album, $id)
    {

        try {

            $sql = "
            
            UPDATE albumes
            SET
                    titulo = :titulo,
                    descripcion = :descripcion,
                    autor = :autor,
                    fecha = :fecha,
                    lugar = :lugar,
                    categoria = :categoria,
                    etiquetas = :etiquetas,
                    carpeta = :carpeta
            WHERE
                    id = :id
            LIMIT 1
            ";

            $conexion = $this->db->connect();

            $stmt = $conexion->prepare($sql);

            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            $stmt->bindParam(':titulo', $album->titulo, PDO::PARAM_STR, 30);
            $stmt->bindParam(':descripcion', $album->descripcion, PDO::PARAM_STR, 50);
            $stmt->bindParam(':autor', $album->autor, PDO::PARAM_STR, 50);
            $stmt->bindParam(':fecha', $album->fecha, PDO::PARAM_STR, 50);
            $stmt->bindParam(':lugar', $album->lugar, PDO::PARAM_STR, 50);
            $stmt->bindParam(':categoria', $album->categoria, PDO::PARAM_STR, 9);
            $stmt->bindParam(':etiquetas', $album->etiquetas, PDO::PARAM_STR, 30);
            $stmt->bindParam(':carpeta', $album->carpeta, PDO::PARAM_STR, 9);

            $stmt->execute();
        } catch (PDOException $e) {
            // error base de datos
            require_once 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
            exit();
        }
    }

    /*
        método: delete

        descripción: elimina un album

        @param: id del album
    */

    public function delete(int $id)
    {

        try {

            $sql = "
                DELETE FROM albumes
                WHERE id = :id
                LIMIT 1
            ";

            $conexion = $this->db->connect();

            $stmt = $conexion->prepare($sql);

            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            $stmt->execute();
        } catch (PDOException $e) {
            // error base de datos
            require_once 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
            exit();
        }
    }

    /*
        método: validateIdalbum

        descripción: valida el id de un album. Que exista en la base de datos

        @param: 
            - id del album

    */

    public function validateIdAlbum(int $id) {

        try {

            $sql = "
                SELECT 
                    id
                FROM 
                    albumes
                WHERE
                    id = :id
            ";

            $conexion = $this->db->connect();
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() == 1) {
                return TRUE;
            } 

            return FALSE;
            

        } catch (PDOException $e) {

            // error base de datos
            require_once 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
            exit();
        }
    }

    /*
        método: filter

        descripción: filtra los albumes por una expresión

        @param: expresión a buscar
    */
    public function filter($expresion)
    {
        try {
            $sql = "

            SELECT 
                albumes.id,
                albumes.titulo,
                albumes.autor,
                albumes.fecha,
                albumes.lugar,
                albumes.categoria,
                albumes.etiquetas,
                albumes.carpeta,
            FROM
                albumes
            WHERE

                CONCAT_WS(  ', ', 
                            albumes.id,
                            albumes.titulo,
                            albumes.autor,
                            albumes.fecha,
                            albumes.lugar,
                            albumes.categoria,
                            albumes.etiquetas,
                            albumes.carpeta) 
                like :expresion

            ORDER BY 
                albumes.id
            
            ";

            # Conectar con la base de datos
            $conexion = $this->db->connect();

            $stmt = $conexion->prepare($sql);

            $stmt->bindValue(':expresion', '%' . $expresion . '%', PDO::PARAM_STR);
            $stmt->setFetchMode(PDO::FETCH_OBJ);
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {

            // error base de datos
            require_once 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
            exit();
        }
    }

    /*
        método: order

        descripción: ordena los albumes por un campo

        @param: campo por el que ordenar
    */
    public function order(int $criterio) {

        try {

            # comando sql
            $sql = "
            SELECT 
                albumes.id,
                concat_ws(', ', albumes.descripcion, albumes.titulo) album,
                albumes.lugar,
                albumes.categoria,
                albumes.etiquetas,
                albumes.num_fotos,
                cursos.tituloCorto curso,
                timestampdiff(YEAR,  albumes.fechaNac, NOW() ) edad 
            FROM
                albumes
            INNER JOIN
                cursos
            ON 
                albumes.id_curso = cursos.id
            ORDER BY 
                :criterio
            ";

            # conectamos con la base de datos

            // $this->db es un objeto de la clase database
            // ejecuto el método connect de esa clase

            $conexion = $this->db->connect();

            # ejecutamos mediante prepare
            $stmt = $conexion->prepare($sql);

            $stmt->bindParam(':criterio', $criterio, PDO::PARAM_INT);

            # establecemos  tipo fetch
            $stmt->setFetchMode(PDO::FETCH_OBJ);

            #  ejecutamos 
            $stmt->execute();

            # devuelvo objeto stmtatement
            return $stmt;

        } catch (PDOException $e) {

            // error base de datos
            require_once 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
            exit();

        }
    }

    /*
        método: validateUniquenum_fotos

        descripción: valida el num_fotos de un album. Que no exista en la base de datos

        @param: 
            - num_fotos del album

    */
    public function validateUniquenum_fotos($num_fotos) {

        try {

            $sql = "
                SELECT 
                    num_fotos
                FROM 
                    albumes
                WHERE
                    num_fotos = :num_fotos
            ";

            $conexion = $this->db->connect();
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':num_fotos', $num_fotos, PDO::PARAM_STR, 9);
            $stmt->setFetchMode(PDO::FETCH_OBJ);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return FALSE;
            } 

            return TRUE;
            

        } catch (PDOException $e) {

            // error base de datos
            require_once 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
            exit();
        }
    }

    /*
        método: validateUniquelugar

        descripción: valida el lugar de un album. Que no exista en la base de datos

        @param: 
            - lugar del album

    */
    public function validateUniquelugar($lugar) {

        try {

            $sql = "
                SELECT 
                    lugar
                FROM 
                    albumes
                WHERE
                    lugar = :lugar
            ";

            $conexion = $this->db->connect();
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':lugar', $lugar, PDO::PARAM_STR, 50);
            $stmt->setFetchMode(PDO::FETCH_OBJ);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return FALSE;
            } 

            return TRUE;
            

        } catch (PDOException $e) {

            // error base de datos
            require_once 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
            exit();
        }
    }

    /*
        método: validateForeignKeyCurso($id_curso)

        descripción: valida el id_curso seleccionado. Que exista en la tabla cursos

        @param: 
            - $id_curso

    */
    public function validateForeignKeyCurso(int $id_curso) {

        try {

            $sql = "
                SELECT 
                    id
                FROM 
                    cursos
                WHERE
                    id = :id_curso
            ";

            $conexion = $this->db->connect();
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':id_curso', $id_curso, PDO::PARAM_INT);
            $stmt->setFetchMode(PDO::FETCH_OBJ);
            $stmt->execute();

            if ($stmt->rowCount() == 1) {
                return TRUE;
            } 

            return FALSE;
            

        } catch (PDOException $e) {

            // error base de datos
            require_once 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
            exit();
        }
    }
}
