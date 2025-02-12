<?php

/*
    albumModel.php

    Modelo del  controlador albumes

    Definir los métodos de acceso a la base de datos
    
    - insert
    - update
    - select
    - delete
    - etc..
*/

class albumModel extends Model
{

    /*
        Extrae los detalles  de los albumes
    */
    public function get()
    {

        try {

            # comando sql
            $sql = "
                SELECT 
                   *
                FROM
                    albumes
                ORDER BY 
                    id
                ";

            # conectamos con la base de datos

            // $this->db es un objeto de la clase database
            // ejecuto el método connect de esa clase

            $conexion = $this->db->connect();

            # ejecutamos mediante prepare
            $pdost = $conexion->prepare($sql);

            # establecemos  tipo fetch
            $pdost->setFetchMode(PDO::FETCH_OBJ);

            #  ejecutamos 
            $pdost->execute();

            # devuelvo objeto pdostatement
            return $pdost;
        } catch (PDOException $e) {

            include_once('template/partials/errorDB.php');
            exit();
        }
    }

    # Método getAlbum
    public function getAlbum($id)
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
                    num_fotos,
                    num_visitas,
                    carpeta
                FROM  
                    albumes  
                WHERE
                    id = :id";

            $conexion = $this->db->connect();
            $pdoSt = $conexion->prepare($sql);
            $pdoSt->bindParam(":id", $id, PDO::PARAM_INT);
            $pdoSt->setFetchMode(PDO::FETCH_OBJ);
            $pdoSt->execute();
            return $pdoSt->fetch();
        } catch (PDOException $e) {
            require_once("template/partials/errorDB.php");
            exit();
        }
    }



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
                            num_fotos,
                            num_visitas,
                            carpeta,
                            created_at
                        )
                        VALUES (
                            :titulo,
                            :descripcion,
                            :autor,
                            :fecha,
                            :lugar,
                            :categoria,
                            :etiquetas,
                            0,
                            0,
                            :carpeta,
                            NOW()
                        )
                ";

            // Conectar con la base de datos
            $conexion = $this->db->connect();

            // Preparamos la consulta
            $pdoSt = $conexion->prepare($sql);

            // Vinculación de los parámetros con los valores del objeto $album
            $pdoSt->bindParam(':titulo', $album->titulo, PDO::PARAM_STR, 100);
            $pdoSt->bindParam(':descripcion', $album->descripcion, PDO::PARAM_STR);
            $pdoSt->bindParam(':autor', $album->autor, PDO::PARAM_STR, 50);
            $pdoSt->bindParam(':fecha', $album->fecha, PDO::PARAM_STR);
            $pdoSt->bindParam(':lugar', $album->lugar, PDO::PARAM_STR, 50);
            $pdoSt->bindParam(':categoria', $album->categoria, PDO::PARAM_STR, 50);
            $pdoSt->bindParam(':etiquetas', $album->etiquetas, PDO::PARAM_STR, 250);
            $pdoSt->bindParam(':carpeta', $album->carpeta, PDO::PARAM_STR, 50);

            // Ejecutamos la consulta
            $pdoSt->execute();

            // Ahora crearemos la carpeta, teniendo en cuenta que vamos a usar la carpeta imagenes
            mkdir('imagenes/' . $album->carpeta);
        } catch (PDOException $e) {
            include_once('template/partials/errorDB.php');
            exit();
        }
    }

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
                        etiquetas = :etiquetas
                WHERE
                        id = :id
                LIMIT 1
                ";

            // Conectar con la base de datos
            $conexion = $this->db->connect();

            // Preparamos la consulta
            $pdoSt = $conexion->prepare($sql);

            // Vinculación de los parámetros con los valores del objeto $album
            $pdoSt->bindParam(':id', $id, PDO::PARAM_INT);

            $pdoSt->bindParam(':titulo', $album->titulo, PDO::PARAM_STR, 100);
            $pdoSt->bindParam(':descripcion', $album->descripcion, PDO::PARAM_STR);
            $pdoSt->bindParam(':autor', $album->autor, PDO::PARAM_STR, 50);
            $pdoSt->bindParam(':fecha', $album->fecha, PDO::PARAM_STR);
            $pdoSt->bindParam(':lugar', $album->lugar, PDO::PARAM_STR, 50);
            $pdoSt->bindParam(':categoria', $album->categoria, PDO::PARAM_STR, 50);
            $pdoSt->bindParam(':etiquetas', $album->etiquetas, PDO::PARAM_STR, 250);

            // Ejecutamos la consulta
            $pdoSt->execute();
        } catch (PDOException $e) {
            include_once('template/partials/errorDB.php');
            exit();
        }
    }

    /*
       Extrae los detalles  de los albumes
   */
    public function order(int $criterio)
    {

        try {

            # comando sql
            $sql = "
                SELECT 
                    id,
                    titulo,
                    descripcion,
                    autor,
                    fecha,
                    categoria,
                    etiquetas,
                    num_fotos,
                    num_visitas,
                    carpeta
                FROM
                    albumes
                ORDER BY 
                    :criterio
                ";

            # conectamos con la base de datos

            // $this->db es un objeto de la clase database
            // ejecuto el método connect de esa clase

            $conexion = $this->db->connect();

            # ejecutamos mediante prepare
            $pdostmt = $conexion->prepare($sql);

            $pdostmt->bindParam(':criterio', $criterio, PDO::PARAM_INT);

            # establecemos  tipo fetch
            $pdostmt->setFetchMode(PDO::FETCH_OBJ);

            #  ejecutamos 
            $pdostmt->execute();

            # devuelvo objeto pdostatement
            return $pdostmt;
        } catch (PDOException $e) {

            include_once('template/partials/errorDB.php');
            exit();
        }
    }

    public function filter($expresion)
    {
        try {
            $sql = "

                SELECT 
                id,
                titulo,
                descripcion,
                autor,
                fecha,
                categoria,
                etiquetas,
                num_fotos,
                num_visitas,
                carpeta
            FROM
                albumes
            WHERE
                    CONCAT_WS(  ', ', 
                    id,
                    titulo,
                    descripcion,
                    autor,
                    fecha,
                    categoria,
                    etiquetas,
                    num_fotos,
                    num_visitas,
                    carpeta) 
                    like :expresion

                ORDER BY 
                    albumes.id
                
                ";

            # Conectar con la base de datos
            $conexion = $this->db->connect();

            $pdost = $conexion->prepare($sql);

            $pdost->bindValue(':expresion', '%' . $expresion . '%', PDO::PARAM_STR);
            $pdost->setFetchMode(PDO::FETCH_OBJ);
            $pdost->execute();
            return $pdost;
        } catch (PDOException $e) {

            include_once('template/partials/errorDB.php');
            exit();
        }
    }

    public function obtenerCarpetaPorId($albumId)
    {
        try {
            $sql = "
                        SELECT 
                                carpeta
                        FROM 
                                albumes
                        WHERE
                                id = :id
                ";

            # Conectar con la base de datos
            $conexion = $this->db->connect();


            $pdoSt = $conexion->prepare($sql);

            $pdoSt->bindParam(':id', $albumId, PDO::PARAM_INT);
            $pdoSt->setFetchMode(PDO::FETCH_OBJ);
            $pdoSt->execute();

            return $pdoSt->fetch();
        } catch (PDOException $e) {
            include_once('template/partials/errorDB.php');
            exit();
        }
    }

    public function delete($id)
    {
        try {

            $sql = "DELETE FROM albumes WHERE id = :id limit 1";
            $conexion = $this->db->connect();
            $pdost = $conexion->prepare($sql);
            $pdost->bindParam(':id', $id, PDO::PARAM_INT);
            $pdost->execute();
        } catch (PDOException $e) {

            include_once('template/partials/errorDB.php');
            exit();
        }
    }

    public function validateFecha($fecha)
    {
        if (date('Y-m-d', strtotime($fecha)) == $fecha) {
            return true;
        } else {
            return false;
        }
    }


    public function numeroVisitas($id)
    {
        try {
            $sql = "UPDATE albumes SET num_visitas = num_visitas + 1 WHERE id = :id";
            $conexion = $this->db->connect();
            $pdost = $conexion->prepare($sql);
            $pdost->bindParam(':id', $id, PDO::PARAM_INT);
            $pdost->execute();
        } catch (PDOException $e) {
            include_once('template/partials/errorDB.php');
            exit();
        }
    }

    public function numeroFotos($idAlbum, $numFotos)
    {
        try {
            $sql = "UPDATE albumes SET num_fotos = :numFotos WHERE id = :idAlbum";
            $conexion = $this->db->connect();
            $pdost = $conexion->prepare($sql);
            $pdost->bindParam(':numFotos', $numFotos, PDO::PARAM_INT);
            $pdost->bindParam(':idAlbum', $idAlbum, PDO::PARAM_INT);
            $pdost->execute();
        } catch (PDOException $e) {
            include_once('template/partials/errorDB.php');
            exit();
        }
    }

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
                $tipos_permitidos = ['GIF', 'PNG','JPG', 'JPEG'];
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
}
