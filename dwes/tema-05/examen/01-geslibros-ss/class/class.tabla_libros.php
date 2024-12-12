<?php

/*
    clase: class.tabla_libros.php
    descripcion: define la clase que va a contener el array de objetos de la clase libro.
*/



class Class_tabla_libros extends Class_conexion
{


    /*
        método: getLibros()
        descripcion: devuelve un objeto pdostatement con los detalles de los libros
    */

    public function get_libros()
    {
        try {
            $sql = 'SELECT
                libros.id,
                libros.titulo,
                libros.precio,
                libros.stock,
                libros.fecha_edicion,
                libros.isbn,
                autores.nombre as autor,
                editoriales.nombre as editorial,
                libros.generos_id
                FROM 
                libros
                INNER JOIN autores ON libros.autor_id = autores.id
                INNER JOIN editoriales ON libros.editorial_id = editoriales.id
                GROUP by libros.id
                ORDER BY libros.id;
            ';
            // obtengo objeto clase pdostatement
            $stmt = $this->pdo->prepare($sql);

            // establezco tipo de fetch
            $stmt->setFetchMode(PDO::FETCH_OBJ);

            // ejecuto
            $stmt->execute();

            return $stmt;
            
        } catch (PDOException $e) {

            include 'views/partials/errorDB.php';

            // libero pdostatement
            $stmt = null;

            // cierro conexión
            $this->pdo = null;

            // cancelo ejecución programa
            exit();

            
        }
    }

    /*
        método: get_generos()
        descripcion: devuelve un array clave valor con la tabla géneros
    */

    public function get_generos()
    {
        try {
            $sql = 'SELECT
                tema
                FROM 
                generos
                ORDER BY
                tema ASC;
            ';
            // Sentencia preparada
            // Obtengo objeto clase pdostatement
            $stmt = $this->pdo->prepare($sql);

            // Establecemos tipo de fetch
            $stmt->setFetchMode(PDO::FETCH_KEY_PAIR);

            // Ejecutar la consulta
            $stmt->execute();

            // Obtener todos los resultados en un array asociativo
            $generos = $stmt->fetchAll();

            // Retornar el array
            return $generos;
            
        } catch (PDOException $e) {

            include 'views/partials/errorDB.php';

            // libero pdostatement
            $stmt = null;

            // cierro conexión
            $this->pdo = null;

            // cancelo ejecución programa
            exit();

            
        }

            
    }


    /*
        método: get_generos_asociados()
        descripcion: devuelve un array con los géneros asociados a un libro

        Parámetros:
        - $generos_id - lista indice de géneros asociados a un libro
    */

    public function get_generos_asociados($generos_id)
    {   

            // Creamos una array
            $generos_id = explode(", ", $generos_id);

            // Cargamos los generos
            $generos = $this->get_generos();

            // creamos un array vacio para cargar los generos asociados al libro
            $generos_nominativos = [];

            // Hacemos un foreach para introducir los generos asociados al array que vamos a mostrar
            foreach ($generos_id as $value) {
                $generos_nominativos[] = $generos[$value] ;
            }
            // devolvemos el array con los generos asociados
            return $generos_nominativos;   
    }

    /*
        método: get_autores()
        descripcion: devuelve un pdostatement par clave valor
    */

    public function get_autores()
    {
        try {
            $sql = 'SELECT
                nombre
                FROM 
                autores
                ORDER BY
                nombre ASC;
            ';
            // Sentencia preparada
            // Obtengo objeto clase pdostatement
            $stmt = $this->pdo->prepare($sql);

            // Establecemos tipo de fetch
            $stmt->setFetchMode(PDO::FETCH_KEY_PAIR);

            // Ejecutar la consulta
            $stmt->execute();

            // Obtener todos los resultados en un array asociativo
            $generos = $stmt->fetchAll();

            // Retornar el array
            return $generos;
            
        } catch (PDOException $e) {

            include 'views/partials/errorDB.php';

            // libero pdostatement
            $stmt = null;

            // cierro conexión
            $this->pdo = null;

            // cancelo ejecución programa
            exit();

            
        }
    }

    /*
        método: get_editoriales()
        descripcion: devuelve un pdostatement par clave valor
    */

    public function get_editoriales()
    {
        try {
            $sql = 'SELECT
                nombre
                FROM 
                editoriales
                ORDER BY
                nombre ASC;
            ';
            // Sentencia preparada
            // Obtengo objeto clase pdostatement
            $stmt = $this->pdo->prepare($sql);

            // Establecemos tipo de fetch
            $stmt->setFetchMode(PDO::FETCH_KEY_PAIR);

            // Ejecutar la consulta
            $stmt->execute();

            // Obtener todos los resultados en un array asociativo
            $generos = $stmt->fetchAll();

            // Retornar el array
            return $generos;
            
        } catch (PDOException $e) {

            include 'views/partials/errorDB.php';

            // libero pdostatement
            $stmt = null;

            // cierro conexión
            $this->pdo = null;

            // cancelo ejecución programa
            exit();

            
        }
    }

    /*
        método: create()
        descripcion: permite añadir un nuevo libro a la tabla
        
        parámetros:

            - $libro - objeto de la clase libro

    */
    public function create(Class_libro $libro)
    {
        try {
            $sql = 'INSERT TO
            Libros(
                id,
                titulo,
                precio,
                stock,
                fecha_edicion,
                isbn,
                autor_id,
                editorial_id,
                generos_id)
            VALUES(
                :id,
                :titulo,
                :precio,
                :stock,
                :fecha_edicion,
                :isbn,
                :autor_id,
                :editorial_id,
                :generos_id)';

        // utilizamos metodo prepare
        $stmt = $this->pdo->prepare($sql);
        
        // vinculamos los parametros
        $stmt->bindParam(':id', $libro->id, pdo::PARAM_INT);
        $stmt->bindParam(':titulo', $libro->titulo, pdo::PARAM_STR);
        $stmt->bindParam(':precio', $libro->precio, pdo::PARAM_STR);
        $stmt->bindParam(':stock', $libro->stock, pdo::PARAM_INT);
        $stmt->bindParam(':fecha_edicion', $libro->fecha_edicion, pdo::PARAM_STR);
        $stmt->bindParam(':isbn', $libro->isbn, pdo::PARAM_INT);
        $stmt->bindParam(':autor_id', $libro->autor_id, pdo::PARAM_INT);
        $stmt->bindParam(':editorial_id', $libro->editorial_id, pdo::PARAM_INT);
        $stmt->bindParam(':generos_id', $libro->generos_id, pdo::PARAM_INT);
        
        // Ejecutamos
        $stmt->execute();

            
            
        } catch (PDOException $e) {
            // incluimos los mensajes de error
            include 'views/partials/errorDB.php';

            // libero pdostatement
            $stmt = null;

            // cierro conexión
            $this->pdo = null;

            // cancelo ejecución programa
            exit();
        }
    }

    

    /*
        método: order()
        descripcion: devuelve un objeto de la clase pdostatement con los 
        detalles de los libros  ordenados por un criterio.

        Parámetros:

            - criterio: posición de la columna en la tabla libros
                        por la que quiero ordenar
    */

    /*
        método: order()
        descripcion: devuelve un objeto de la clase mysqli_result con los 
        detalles de los libros  ordenados por un criterio.

        Parámetros:

            - criterio: posición de la columna en la tabla libros
                        por la que quiero ordenar
    */
    public function order(int $criterio)
    {
        try {

            // sentencia sql
            $sql = "SELECT 
                    libros.id,
                    libros.titulo,
                    libros.precio,
                    libros.stock,
                    libros.fecha_edicion,
                    libros.isbn,
                    autores.nombre as autor,
                    editoriales.nombre as editorial,
                    libros.generos_id
                    FROM
                        libros
                        INNER JOIN autores ON libros.autor_id = autores.id
                    GROUP BY libros.id
                    ORDER BY :criterio";

            // ejecuto prepare
            $stmt = $this->pdo->prepare($sql);

            // vincular parámetros
            $stmt->bindParam(':criterio', $criterio, PDO::PARAM_INT);

            // tipo de fetch
            $stmt->setFetchMode(PDO::FETCH_OBJ);

            // ejecutamos
            $stmt->execute();

            // Devolvemos objeto clase PDOStatement
            return $stmt;
        } catch (PDOException $e) {

            // error de  base dedatos
            include 'views/partials/errorDB.php';

            // libero stmt
            $stmt = null;

            // cierro conexión
            $this->pdo = null;

            // cancelo ejecución programa
            exit();
        }
    }

}
