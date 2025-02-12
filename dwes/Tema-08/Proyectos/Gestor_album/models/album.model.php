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
                categorias.nombre as categoria,
                albumes.etiquetas,
                albumes.num_fotos,
                albumes.num_visitas,
                albumes.carpeta
            FROM 
                albumes 
            INNER JOIN
                categorias
            ON albumes.id_categoria = categorias.id
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
       método: get_categorias()

       Extre los detalles de los categorias para generar lista desplegable 
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
        parámetros: objeto de classAlbum
    */

    public function create(classAlbum $album)
    {

        try {

            //Si no existe la carpeta images, la creamos
            if (!is_dir('images')) {
                mkdir('images');
            }

            //Crear carpeta en la carpeta local images 
            $ruta = 'images/' . $album->carpeta;
            mkdir($ruta);





            $sql = "INSERT INTO albumes (
                    titulo,
                    descripcion,
                    autor,
                    fecha,
                    lugar,
                    id_categoria,
                    etiquetas,
                    num_fotos,
                    num_visitas,
                    carpeta
                )
                VALUES (
                    :titulo,
                    :descripcion,
                    :autor,
                    :fecha,
                    :lugar,
                    :id_categoria,
                    :etiquetas,
                    :num_fotos,
                    :num_visitas,
                    :carpeta
                )
            ";
            # Conectar con la base de datos
            $conexion = $this->db->connect();


            $stmt = $conexion->prepare($sql);

            $stmt->bindParam(':titulo', $album->titulo, PDO::PARAM_STR, 100);
            $stmt->bindParam(':descripcion', $album->descripcion, PDO::PARAM_STR, 50);
            $stmt->bindParam(':autor', $album->autor, PDO::PARAM_STR, 50);
            $stmt->bindParam(':fecha', $album->fecha, PDO::PARAM_STR);
            $stmt->bindParam(':lugar', $album->lugar, PDO::PARAM_STR, 50);
            $stmt->bindParam(':id_categoria', $album->id_categoria, PDO::PARAM_INT);
            $stmt->bindParam(':etiquetas', $album->etiquetas, PDO::PARAM_STR, 250);
            $stmt->bindParam(':num_fotos', $album->num_fotos, PDO::PARAM_INT);
            $stmt->bindParam(':num_visitas', $album->num_visitas, PDO::PARAM_INT);
            $stmt->bindParam(':carpeta', $album->carpeta, PDO::PARAM_STR, 50);

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
                            id_categoria,
                            etiquetas,
                            num_fotos,
                            num_visitas,
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
                    id_categoria = :id_categoria,
                    etiquetas = :etiquetas,
                    num_fotos = :num_fotos,
                    num_visitas = :num_visitas,
                    carpeta  = :carpeta
            WHERE
                    id = :id
            LIMIT 1
            ";

            $conexion = $this->db->connect();

            $stmt = $conexion->prepare($sql);

            $stmt->bindParam(':titulo', $album->titulo, PDO::PARAM_STR, 100);
            $stmt->bindParam(':descripcion', $album->descripcion, PDO::PARAM_STR, 50);
            $stmt->bindParam(':autor', $album->autor, PDO::PARAM_STR, 50);
            $stmt->bindParam(':fecha', $album->fecha, PDO::PARAM_STR);
            $stmt->bindParam(':lugar', $album->lugar, PDO::PARAM_STR, 50);
            $stmt->bindParam(':id_categoria', $album->id_categoria, PDO::PARAM_INT);
            $stmt->bindParam(':etiquetas', $album->etiquetas, PDO::PARAM_STR, 250);
            $stmt->bindParam(':num_fotos', $album->num_fotos, PDO::PARAM_INT);
            $stmt->bindParam(':num_visitas', $album->num_visitas, PDO::PARAM_INT);
            $stmt->bindParam(':carpeta', $album->carpeta, PDO::PARAM_STR, 50);
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
        método: delete

        descripción: elimina un album

        @param: id del album
    */

    public function delete(int $id, $carpeta)
    {

        try {

            //Eliminamos las carpeta local asociada dentro de la carpeta images y su contenido
            $ruta = 'images/' . $carpeta;

            if (is_dir($ruta)) {
                $files = glob($ruta . '/*'); // Obtiene todos los archivos dentro de la carpeta

                foreach ($files as $file) {
                    unlink($file); // Elimina cada archivo
                }

                rmdir($ruta); // Finalmente, elimina la carpeta vacía
            }

            rmdir($ruta);




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

    public function validateIdAlbum(int $id)
    {

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
                albumes.lugar,
                categorias.nombre as categoria,
                albumes.etiquetas,
                albumes.num_fotos,
                albumes.num_visitas,
                albumes.carpeta
            FROM
                albumes         
            INNER JOIN
                categorias
            ON albumes.id_categoria = categorias.id
            WHERE

                CONCAT_WS(  ', ', 
                            albumes.id,
                            albumes.titulo,
                            albumes.lugar,
                            categorias.nombre,
                            albumes.etiquetas,
                            albumes.num_fotos,
                            albumes.num_visitas) 
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
    public function order(int $criterio)
    {

        try {

            # comando sql
            $sql = "
            SELECT 
                albumes.id,
                albumes.titulo,
                albumes.lugar,
                categorias.nombre as categoria,
                albumes.etiquetas,
                albumes.num_fotos,
                albumes.num_visitas,
                albumes.carpeta
            FROM
                albumes       
            INNER JOIN
                categorias
            ON albumes.id_categoria = categorias.id
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

        descripción: valida el id_categoria seleccionado. Que exista en la tabla categorias

        @param: 
            - $id_categoria

    */
    public function validateForeignKeyCategoria(int $id_categoria)
    {

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


    /*


    metodo: validateUniqueCarpeta($carpeta)

    descripcion: valida si en la carpeta local images no existe una carpeta con ese nombre

    @param: 
            - $carpeta

    */

    public function validateUniqueCarpeta($carpeta)
    {

        $ruta = 'images/' . $carpeta;

        if (is_dir($ruta)) {
            return FALSE;
        }

        return TRUE;
    }


    /*


    metodo: update_visitas($id, $num_visitas)

    descripcion: actualiza el numero de visitas de un album

    @param: 
            - $id
            -$num_visitas

    */

    public function update_visitas($id, $num_visitas)
    {

        try {

            $sql = "
            
            UPDATE albumes
            SET
                    num_visitas = :num_visitas
            WHERE
                    id = :id
            LIMIT 1
            ";

            $conexion = $this->db->connect();

            $stmt = $conexion->prepare($sql);

            $stmt->bindParam(':num_visitas', $num_visitas, PDO::PARAM_INT);
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

    Método: subirArchivo

    Descripción: sube un archivo a la carpeta images

    @param: 
            - $ficheros
            - $carpeta

    */

    public function subirArchivo($ficheros, $carpeta)
    {

        $num = count($ficheros['tmp_name']);

        # genero array de error de fichero
        $FileUploadErrors = array(
            0 => 'Imagen subido con éxito.',
            1 => 'La imagen subida excede la directiva upload_max_filesize.',
            2 => 'La imagen subida excede la directiva MAX_FILE_SIZE especificada en el formulario HTML.',
            3 => 'La imagen no ha terminado de subirse.',
            4 => 'No se subió ninguna imagen.',
            6 => 'Falta la carpeta.',
            7 => 'No se pudo escribir la imagen en el disco.',
            8 => 'Una extensión de PHP detuvo la subida de ficheros.',
        );

        $error = null;

        for ($i = 0; $i <= $num - 1 && is_null($error); $i++) {
            if ($ficheros['error'][$i] != UPLOAD_ERR_OK) {
                $error = $FileUploadErrors[$ficheros['error'][$i]];
            } else {
                $tamMaximo = 4200000;
                if ($ficheros['size'][$i] > $tamMaximo) {

                    $error = "Fichero excede tamaño maximo";
                }
                $info = new SplFileInfo($ficheros['name'][$i]);
                $tipos_permitidos = ['GIF', 'PNG', 'JPG', 'JPEG'];
                if (!in_array(strtoupper($info->getExtension()), $tipos_permitidos)) {
                    $error = "La extension debe ser .png .jpg .jpeg o .gif .";
                }
            }
        }

        if (is_null($error)) {
            for ($i = 0; $i <= $num - 1; $i++) {
                if (is_uploaded_file($ficheros['tmp_name'][$i])) {
                    move_uploaded_file($ficheros['tmp_name'][$i], "images/" . $carpeta . "/" . $ficheros['name'][$i]);
                }
            }
            $_SESSION['mensaje'] = "Ficheros subidos con exito";
        } else {
            $_SESSION['error'] = $error;
        }
    }


    /*

    Método: numeroFotos

    Descripción: actualiza el numero de fotos de un album

    @param: 
            - $id
            - $numFotos

    */


    public function numeroFotos($id, $numFotos)
    {
        try {
            $sql = "UPDATE albumes SET num_fotos = :numFotos WHERE id = :id";
            $conexion = $this->db->connect();
            $pdost = $conexion->prepare($sql);
            $pdost->bindParam(':numFotos', $numFotos, PDO::PARAM_INT);
            $pdost->bindParam(':id', $id, PDO::PARAM_INT);
            $pdost->execute();
        } catch (PDOException $e) {
            include_once('template/partials/errorDB.php');
            exit();
        }
    }


}
