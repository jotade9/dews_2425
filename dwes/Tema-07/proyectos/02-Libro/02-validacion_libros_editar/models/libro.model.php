<?php

/*
    libroModel.php

    Modelo del controlador libro

    Métodos:

        - get()
*/

class libroModel extends Model
{

    /*
        método: get()

        Extre los detalles de la tabla libros
    */
    public function get()
    {

        try {

            // sentencia sql
            $sql = "SELECT 
                libros.id,
                libros.titulo,
                autores.nombre as autor,
                editoriales.nombre as editorial,
                GROUP_CONCAT(generos.tema SEPARATOR ', ') AS generos_nombres, 
                libros.stock,
                libros.precio
            FROM 
                libros
            INNER JOIN
                autores
            ON 
                autores.id = libros.autor_id
            INNER JOIN
                editoriales
            ON 
                editoriales.id = libros.editorial_id
            INNER JOIN
                generos
            ON 
                FIND_IN_SET(generos.id, libros.generos_id) > 0 -- Relación entre libros y géneros
            GROUP BY 
                libros.id
            ORDER BY 
                libros.id;
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
       método: get_generos()

       Extre los detalles de los generos para generar lista desplegable 
       dinámica
   */
    public function get_generos()
    {

        try {

            // sentencia sql
            $sql = "SELECT 
                        id,
                        tema as genero
                    FROM 
                        generos
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
       método: get_autores()

       Extre los detalles de los autores para generar lista desplegable 
       dinámica
   */
    public function get_autores()
    {

        try {

            // sentencia sql
            $sql = "SELECT 
                      id,
                      nombre as autor
                  FROM 
                      autores
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
         método: get_editoriales()

         Extre los detalles de los generos para generar lista desplegable 
         dinámica
     */
    public function get_editoriales()
    {

        try {

            // sentencia sql
            $sql = "SELECT 
                      id,
                      nombre as editorial
                  FROM 
                      editoriales
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

        descripción: añade nuevo libro
        parámetros: objeto de classLibro
    */

    public function create(classLibro $libro)
    {

        try {
            $sql = "INSERT INTO libros (
                    titulo,
                    precio,
                    stock,
                    fecha_edicion,
                    isbn,
                    autor_id,
                    editorial_id,
                    generos_id

                )
                VALUES (
                    :titulo,
                    :precio,
                    :stock,
                    :fecha_edicion,
                    :isbn,
                    :autor_id,
                    :editorial_id,
                    :generos_id
                )
            ";
            # Conectar con la base de datos
            $conexion = $this->db->connect();


            $stmt = $conexion->prepare($sql);

            $stmt->bindParam(':titulo', $libro->titulo, PDO::PARAM_STR, 80);
            $stmt->bindParam(':precio', $libro->precio, PDO::PARAM_STR);
            $stmt->bindParam(':stock', $libro->unidades, PDO::PARAM_INT);
            $stmt->bindParam(':fecha_edicion', $libro->fechaEdicion, PDO::PARAM_STR, 10);
            $stmt->bindParam(':isbn', $libro->isbn, PDO::PARAM_STR, 13);
            $stmt->bindParam(':autor_id', $libro->autor, PDO::PARAM_INT);
            $stmt->bindParam(':editorial_id', $libro->editorial, PDO::PARAM_INT);
            $stmt->bindParam(':generos_id', implode(",", $libro->generos), PDO::PARAM_STR);


            // añado libros
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

        descripción: obtiene los detalles de un libro
        parámetros: id del libro
        devuelve: objeto con los detalles del libro
        
    */

    public function read(int $id)
    {

        try {
            $sql = "
                    SELECT 
                        libros.id,
                        libros.titulo,
                        autores.id AS autor_id,
                        autores.nombre AS autor,
                        editoriales.id AS editorial_id,
                        editoriales.nombre AS editorial,
                        GROUP_CONCAT(generos.tema SEPARATOR ', ') AS generos_nombres, 
                        libros.generos_id,
                        libros.stock,
                        libros.precio,
                        libros.fecha_edicion,
                        libros.isbn
                    FROM 
                        libros
                    INNER JOIN
                        autores
                    ON 
                        autores.id = libros.autor_id
                    INNER JOIN
                        editoriales
                    ON 
                        editoriales.id = libros.editorial_id
                    INNER JOIN
                        generos
                    ON 
                        FIND_IN_SET(generos.id, libros.generos_id) > 0 -- Relación entre libros y géneros
                    
                    WHERE
                                libros.id = :id
                                GROUP BY 
                        libros.id
                    ORDER BY 
                        libros.id
                    
                    LIMIT 1";

            # Conectar con la base de datos
            $conexion = $this->db->connect();


            $stmt = $conexion->prepare($sql);

            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->setFetchMode(PDO::FETCH_OBJ);
            $stmt->execute();

            $libro = $stmt->fetch();

            if ($libro) {
                // Convierte generos_id en un array
                $libro->generos = explode(',', $libro->generos_id);
            }

            return $libro;
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

        descripción: actualiza los detalles de un libro

        @param:
            
objeto de classLibro
id del libro*/

public function update(classLibro $libro, $id)
{

    try {

        $sql = "

        UPDATE libros
        SET
                titulo = :titulo,
                precio = :precio,
                stock = :stock,
                fecha_edicion = :fecha_edicion,
                isbn = :isbn,
                autor_id = :autor_id,
                editorial_id = :editorial_id,
                generos_id = :generos_id
        WHERE
                id = :id
        LIMIT 1
        ";

        $conexion = $this->db->connect();

        $stmt = $conexion->prepare($sql);

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        $stmt->bindParam(':titulo', $libro->titulo, PDO::PARAM_STR, 80);
        $stmt->bindParam(':precio', $libro->precio, PDO::PARAM_STR);
        $stmt->bindParam(':stock', $libro->unidades, PDO::PARAM_INT);
        $stmt->bindParam(':fecha_edicion', $libro->fechaEdicion, PDO::PARAM_STR);
        $stmt->bindParam(':isbn', $libro->isbn, PDO::PARAM_STR, 13);
        $stmt->bindParam(':autor_id', $libro->autor, PDO::PARAM_INT);
        $stmt->bindParam(':editorial_id', $libro->editorial, PDO::PARAM_INT);
        $stmt->bindParam(':generos_id', implode(",", $libro->generos), PDO::PARAM_STR);

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

        descripción: elimina un libro

        @param: id del libro
    */

    public function delete(int $id)
    {

        try {

            $sql = "
                DELETE FROM libros
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
        método: filter

        descripción: filtra los libros por una expresión

        @param: expresión a buscar
    */
    public function filter($expresion)
    {
        try {
            $sql = "

            SELECT 
                libros.id,
                libros.titulo,
                autores.nombre AS autor,
                editoriales.nombre AS editorial,
                GROUP_CONCAT(generos.tema SEPARATOR ', ') AS generos_nombres, -- Nombres concatenados
                libros.stock,
                libros.precio,
                libros.fecha_edicion,
                libros.isbn
            FROM 
                libros
            INNER JOIN
                autores
            ON 
                autores.id = libros.autor_id
            INNER JOIN
                editoriales
            ON 
                editoriales.id = libros.editorial_id
            INNER JOIN
                generos
            ON 
                FIND_IN_SET(generos.id, libros.generos_id) > 0 -- Relación entre libros y géneros
            GROUP BY 
                libros.id
            HAVING
                CONCAT_WS(  
                    ', ', 
                    libros.id,
                    libros.titulo,
                    autor,
                    editorial,
                    generos_nombres, -- Se usa el alias definido en el SELECT
                    libros.stock,
                    libros.precio,
                    libros.fecha_edicion,
                    libros.isbn
                ) 
                LIKE :expresion
            ORDER BY 
                libros.id;

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

        descripción: ordena los libros por un campo

        @param: campo por el que ordenar
    */
    public function order(int $criterio)
    {

        try {

            # comando sql
            $sql = "
            SELECT 
                libros.id,
                libros.titulo,
                autores.nombre as autor,
                editoriales.nombre as editorial,                        
                GROUP_CONCAT(generos.tema SEPARATOR ', ') AS generos_nombres, 
                libros.stock,
                libros.precio,
                libros.fecha_edicion,
                libros.isbn
            FROM 
                libros
            INNER JOIN
                autores
            ON 
                autores.id = libros.autor_id
            INNER JOIN
                editoriales
            ON 
                editoriales.id = libros.editorial_id
            INNER JOIN
                generos
            ON 
                FIND_IN_SET(generos.id, libros.generos_id) > 0 -- Relación entre libros y géneros
            GROUP BY 
                libros.id
                        
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
        método: validateForeignKeyCurso($autor_id)

        descripción: valida el autor_id seleccionado. Que exista en la tabla autores

        @param: 
            - $autor_id

    */
    public function validateForeignKeyAutor(int $autor_id) {

        try {

            $sql = "
                SELECT 
                    id
                FROM 
                    autores
                WHERE
                    id = :autor_id
            ";

            $conexion = $this->db->connect();
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':autor_id', $autor_id, PDO::PARAM_INT);
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

    /*
        método: validateForeignKeyEditorial($editorial_id)

        descripción: valida el editorial_id seleccionado. Que exista en la tabla editoriales

        @param: 
            - $editorial_id

    */
    public function validateForeignKeyEditorial(int $editorial_id) {

        try {

            $sql = "
                SELECT 
                    id
                FROM 
                    editoriales
                WHERE
                    id = :editorial_id
            ";

            $conexion = $this->db->connect();
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':editorial_id', $editorial_id, PDO::PARAM_INT);
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

    /*
        método: validateUniqueISBN($isbn)

        descripción: valida el isbn de un libro. Que no exista en la base de datos

        @param: 
            - $isbn

    */
    public function validateUniqueISBN($isbn) {

        try {

            $sql = "
                SELECT 
                    id
                FROM 
                    libros
                WHERE
                    isbn = :isbn
            ";

            $conexion = $this->db->connect();
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':isbn', $isbn, PDO::PARAM_STR, 13);
            $stmt->setFetchMode(PDO::FETCH_OBJ);
            $stmt->execute();

            if ($stmt->rowCount() == 0) {
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
        método: validateForeignKeyGenero($genero)

        descripción: valida el genero seleccionado. Que exista en la tabla generos

        @param: 
            - $genero

    */
    public function validateForeignKeyGenero(int $genero) {

        try {

            $sql = "
                SELECT 
                    id
                FROM 
                    generos
                WHERE
                    id = :genero
            ";

            $conexion = $this->db->connect();
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':genero', $genero, PDO::PARAM_INT);
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
