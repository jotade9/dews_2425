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
                libros.generos_id,
                libros.stock,
                libros.precio
            FROM 
                libros 
            INNER JOIN
                autores
            ON autores.id = libros.autor_id
            INNER JOIN
                editoriales
            ON editoriales.id = libros.editorial_id
            ORDER BY libros.id
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
       método: get_nombre_generos()

   */
  public function get_nombre_generos($generos)
{
    try {
        // Convierte la cadena de IDs de géneros separados por comas en un array.
        $array_id_generos = explode(',', $generos);

        // Obtiene todos los nombres de los géneros disponibles de la base de datos.
        $array_nombre_generos = $this->get_generos();

        // Crea un array vacío para almacenar los nombres de los géneros.
        $array_generos = [];

        // Recorre los IDs de géneros y los usa para obtener los nombres de los géneros.
        foreach ($array_id_generos as $id_genero) {
            // Agrega el nombre del género al array.
            $array_generos[] = $array_nombre_generos[$id_genero];
        }

        // Une los nombres de los géneros con comas y los devuelve.
        return implode(', ', $array_generos);

    } catch (PDOException $e) {
        // En caso de un error de base de datos, se carga una vista de error.
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
            $stmt->bindParam(':fecha_edicion', $libro->fecha_edicion, PDO::PARAM_STR, 10);
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
                        libros.generos_id,
                        libros.stock,
                        libros.precio,
                        libros.fecha_edicion,
                        libros.isbn
                    FROM 
                        libros 
                    INNER JOIN
                        autores
                    ON autores.id = libros.autor_id
                    INNER JOIN
                        editoriales
                    ON editoriales.id = libros.editorial_id
                    WHERE
                        libros.id = :id
                    LIMIT 1";

            # Conectar con la base de datos
            $conexion = $this->db->connect();


            $stmt = $conexion->prepare($sql);

            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->setFetchMode(PDO::FETCH_OBJ);
            $stmt->execute();

            $libro = $stmt->fetch();

            if ($libro) {
                // Convierte `generos_id` en un array
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
            - objeto de classLibro
            - id del libro
    */

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
            $stmt->bindParam(':fecha_edicion', $libro->fecha_edicion, PDO::PARAM_STR);
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
                autores.nombre as autor,
                editoriales.nombre as editorial,                        
                libros.generos_id,
                libros.stock,
                libros.precio,
                libros.fecha_edicion,
                libros.isbn
            FROM 
                libros 
            INNER JOIN
                autores
            ON autores.id = libros.autor_id
            INNER JOIN
                editoriales
            ON editoriales.id = libros.editorial_id
            WHERE
                CONCAT_WS(  ', ', 
                            libros.id,
                        libros.titulo,
                        autores.nombre,
                        editoriales.nombre,                        
                        libros.generos_id,
                        libros.stock,
                        libros.precio,
                        libros.fecha_edicion,
                        libros.isbn
                ) 
                like :expresion

            ORDER BY libros.id


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
                libros.generos_id,
                libros.stock,
                libros.precio,
                libros.fecha_edicion,
                libros.isbn
            FROM 
                libros 
            INNER JOIN
                autores
            ON autores.id = libros.autor_id
            INNER JOIN
                editoriales
            ON editoriales.id = libros.editorial_id
                        
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
}