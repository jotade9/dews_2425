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
                albumes.descripcion,
                albumes.autor,
                albumes.fecha,
                albumes.lugar,
                albumes.etiquetas,
                albumes.num_fotos,
                albumes.num_visitas,
                categorias.nombre as categoria
            FROM 
                albumes
            INNER JOIN
                categorias
            ON
                albumes.categoria_id = categorias.id 
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
        método: get_album()

        Extrae los detalles de los albumes para generar lista desplegable 
        dinámica
    */
    public function get_album()
    {

        try {

            // sentencia sql
            $sql = "SELECT 
                id,
                titulo as album
            FROM 
                albumes
            ORDER BY id";

            // conectamos con la base de datos
            $conexion = $this->db->connect();

            // ejecuto prepare
            $stmt = $conexion->prepare($sql);

            // establezco tipo fetch
            $stmt->setFetchMode(PDO::FETCH_KEY_PAIR);

            // ejecutamos
            $stmt->execute();

            // devuelvo objeto stmtatement
            return $stmt->fetchall();
        } catch (PDOException $e) {

            // error base de datos
            require 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
        }
    }

    /*
       método: get_categorias()

       Extrae los detalles de las categorias para generar lista desplegable 
       dinámica
   */
    public function get_categorias()
    {

        try {

            // sentencia sql
            $sql = "SELECT 
                id,
                nombre as categoria
            FROM 
                categorias
            ORDER BY id";

            // conectamos con la base de datos
            $conexion = $this->db->connect();

            // ejecuto prepare
            $stmt = $conexion->prepare($sql);

            // establezco tipo fetch
            $stmt->setFetchMode(PDO::FETCH_KEY_PAIR);

            // ejecutamos
            $stmt->execute();

            // devuelvo objeto stmtatement
            return $stmt->fetchall();
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
                    etiquetas,
                    num_fotos,
                    num_visitas,
                    carpeta,
                    categoria_id,
                    created_at
                )
                VALUES (
                    :titulo,
                    :descripcion,
                    :autor,
                    :fecha,
                    :lugar,
                    :etiquetas,
                    0,
                    0,
                    :carpeta,
                    :categoria_id,
                    NOW()
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
            $stmt->bindParam(':etiquetas', $album->etiquetas, PDO::PARAM_STR, 30);
            $stmt->bindParam(':carpeta', $album->carpeta, PDO::PARAM_STR, 9);
            $stmt->bindParam(':categoria_id', $album->categoria_id, PDO::PARAM_INT);


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
                            etiquetas,
                            carpeta,
                            categoria_id
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
            - objeto de classAlbum
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
                    etiquetas = :etiquetas,
                    carpeta = :carpeta,
                    categoria_id = :categoria_id
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
            $stmt->bindParam(':etiquetas', $album->etiquetas, PDO::PARAM_STR, 30);
            $stmt->bindParam(':carpeta', $album->carpeta, PDO::PARAM_STR, 9);
            $stmt->bindParam(':categoria_id', $album->categoria_id, PDO::PARAM_INT);

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
        método: validateIdAlbum

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
                albumes.etiquetas,
                albumes.num_fotos,
                albumes.num_visitas,
                albumes.carpeta,
                categorias.nombre as categoria
            FROM
                albumes
            INNER JOIN
                categorias
            ON
                albumes.categoria_id = categorias.id
            WHERE

                CONCAT_WS(  ', ', 
                            albumes.id,
                            albumes.titulo,
                            albumes.descripcion,
                            albumes.autor,
                            albumes.fecha,
                            albumes.lugar,
                            albumes.etiquetas,
                            albumes.num_fotos,
                            albumes.num_visitas,
                            albumes.carpeta,
                            categorias.nombre) 
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
                albumes.titulo,
                albumes.descripcion,
                albumes.autor,
                albumes.fecha,
                albumes.lugar,
                albumes.etiquetas,
                albumes.num_fotos,
                albumes.num_visitas,
                albumes.carpeta,
                categorias.nombre as categoria
            FROM
                albumes
            INNER JOIN
                categorias
            ON
                albumes.categoria_id = categorias.id
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
        método: validateForeignKeyCategoria($id_categoria)

        descripción: valida el id de la categoria seleccionada. Que exista en la tabla categorias

        @param: 
            - $id_categoria

    */
    public function validateForeignKeyCategoria(int $id_categoria) {

        try {

            $sql = "
                SELECT 
                    id
                FROM 
                    categorias
                WHERE
                    id = :id_categoria
            ";

            $conexion = $this->db->connect();
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':id_categoria', $id_categoria, PDO::PARAM_INT);
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
    /**
     * Método obtenerCarpetaPorId
     * descripcion que obtiene carpeta por id
     * @param $albumId
     * 
     */
    public function obtenerCarpetaPorId($albumId)
    {
        try {
            $sql = "SELECT carpeta FROM albumes WHERE id = :id";
            $conexion = $this->db->connect();
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':id', $albumId, PDO::PARAM_INT);
            $stmt->setFetchMode(PDO::FETCH_OBJ);
            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException $e) {
            require_once 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
            exit();
        }
    }
    /**
     * Método numeroVisitas($id)
     * descripcion que incrementa el número de visitas
     * @param $id
     */
    public function numeroVisitas($id)
    {
        try {
            $sql = "UPDATE albumes SET num_visitas = num_visitas + 1 WHERE id = :id";
            $conexion = $this->db->connect();
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            require_once 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
            exit();
        }
    }

    /**
     * método numeroFotos($idAlbum, $numFotos)
     * descripcion que actualiza el número de fotos de un album
     * @param $idAlbum
     */
    public function numeroFotos($idAlbum, $numFotos)
    {
        try {
            $sql = "UPDATE albumes SET num_fotos = :numFotos WHERE id = :idAlbum";
            $conexion = $this->db->connect();
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':idAlbum', $idAlbum, PDO::PARAM_INT);
            $stmt->bindParam(':numFotos', $numFotos, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            require_once 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
            exit();
        }
    }
    /**
     * método subirArchivo($ficheros, $carpeta)
     * descripcion que sube un archivo a la carpeta
     * @param $ficheros
     */
    public function subirArchivo($ficheros, $carpeta)
{
    $num = count($ficheros['tmp_name']);

    # Mensajes de error de subida de archivos
    $FileUploadErrors = [
        0 => 'Imagen subida con éxito.',
        1 => 'El archivo excede el tamaño máximo permitido.',
        2 => 'El archivo excede la directiva MAX_FILE_SIZE del formulario HTML.',
        3 => 'El archivo solo se subió parcialmente.',
        4 => 'No se subió ningún archivo.',
        6 => 'Falta la carpeta temporal.',
        7 => 'No se pudo escribir el archivo en el disco.',
        8 => 'Una extensión de PHP detuvo la subida de archivos.',
    ];

    $error = null;

    // Crear la carpeta si no existe
    $rutaDestino = "images/" . $carpeta;
    if (!is_dir($rutaDestino)) {
        mkdir($rutaDestino, 0777, true); // Crea la carpeta con permisos adecuados
    }

    for ($i = 0; $i < $num; $i++) {
        if ($ficheros['error'][$i] != UPLOAD_ERR_OK) {
            $error = $FileUploadErrors[$ficheros['error'][$i]];
        } else {
            $tamMaximo = 4200000;
            if ($ficheros['size'][$i] > $tamMaximo) {
                $error = "El archivo excede el tamaño máximo permitido (4MB).";
            }
            $info = new SplFileInfo($ficheros['name'][$i]);
            $tipos_permitidos = ['GIF', 'PNG', 'JPG', 'JPEG'];
            if (!in_array(strtoupper($info->getExtension()), $tipos_permitidos)) {
                $error = "El archivo debe tener una extensión válida: PNG, JPG, JPEG o GIF.";
            }
        }
    }

    if (is_null($error)) {
        for ($i = 0; $i < $num; $i++) {
            if (is_uploaded_file($ficheros['tmp_name'][$i])) {
                move_uploaded_file($ficheros['tmp_name'][$i], $rutaDestino . "/" . basename($ficheros['name'][$i]));
            }
        }
        $_SESSION['mensaje'] = "Archivo(s) subido(s) con éxito.";
    } else {
        $_SESSION['error'] = $error;
    }
}

    /*
        método: getAlbumesByCategoria

        descripción: obtiene los albumes de una categoria

        @param: id de la categoria
    */
    public function getAlbumesByCategoria(int $id_categoria) {

        try {

            $sql = "
                SELECT 
                    albumes.id,
                    albumes.titulo,
                    albumes.autor,
                    albumes.fecha,
                    albumes.lugar,
                    albumes.etiquetas,
                    albumes.carpeta,
                    categorias.nombre as categoria
                FROM
                    albumes
                INNER JOIN
                    categorias
                ON
                    albumes.categoria_id = categorias.id
                WHERE
                    albumes.categoria_id = :id_categoria
                ORDER BY 
                    albumes.id
            ";

            # Conectar con la base de datos
            $conexion = $this->db->connect();

            $stmt = $conexion->prepare($sql);

            $stmt->bindParam(':id_categoria', $id_categoria, PDO::PARAM_INT);
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


}
