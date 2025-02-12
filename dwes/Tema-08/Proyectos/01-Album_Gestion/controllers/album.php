<?php

class Album extends Controller
{

    function __construct()
    {

        parent::__construct();
    }

    # Método render
    function render()
    {

        # Iniciamos sesión
        session_start();

        # Comprobamos si el usuario está autentificado
        if (!isset($_SESSION['id'])) {
            $_SESSION['notify'] = "Usuario debe autentificarse";
            header("location:" . URL . "login");
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['album']['main']))) {
            $_SESSION['mensaje'] = "Ha intentado realizar operación sin privilegios";
            header('location:' . URL . 'index');
        } else {
            # Si existe un mensaje
            if (isset($_SESSION['mensaje'])) {
                $this->view->mensaje = $_SESSION['mensaje'];
                unset($_SESSION['mensaje']);
            }


            $this->view->title = "Home - Panel Control Albumes";
            $this->view->albumes = $this->model->get();
            $this->view->render('album/main/index');
        }
    }

    # Método show
    public function show($param = [])
    {

        # Iniciamos sesión
        session_start();

        # Comprobamos si el usuario está autentificado
        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";
            header("location:" . URL . "login");
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['album']['show']))) {
            $_SESSION['mensaje'] = "No tienes privilegios para realizar dicha operación";
            header('location:' . URL . 'album');
        } else {

            $id = $param[0];

            $this->model->numeroVisitas($id);

            $this->view->title = "Formulario Álbum Mostar";
            $this->view->album = $this->model->getAlbum($id);
            $this->view->render("album/mostrar/index");
        }
    }

    function create($param = [])
    {
        # Iniciamos sesión
        session_start();

        # Comprobamos si el usuario está autentificado
        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";
            header("location:" . URL . "login");
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['album']['new']))) {
            $_SESSION['mensaje'] = "No tienes privilegios para realizar dicha operación";
            header('location:' . URL . 'album');
        } else {
            # datos del formulario
            $titulo = filter_var($_POST['titulo'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
            $descripcion = filter_var($_POST['descripcion'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
            $autor = filter_var($_POST['autor'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
            $fecha = filter_var($_POST['fecha'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
            $lugar = filter_var($_POST['lugar'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
            $categoria = filter_var($_POST['categoria'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
            $etiquetas = filter_var($_POST['etiquetas'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
            $carpeta = filter_var($_POST['carpeta'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);

            # Cargamos los datos del formulario
            $album = new classAlbum(
                null,
                $titulo,
                $descripcion,
                $autor,
                $fecha,
                $lugar,
                $categoria,
                $etiquetas,
                null,
                null,
                $carpeta
            );

            # validación
            $errores = [];

            if (empty($titulo)) {
                $errores['titulo'] = 'Título es obligatorio';
            } else if (mb_strlen($titulo) > 100) {
                $errores['titulo'] = 'Este campo no puede superar 100 caracteres';
            }

            if (empty($descripcion)) {
                $errores['descripcion'] = 'Descripción es obligatorio';
            }

            if (empty($autor)) {
                $errores['autor'] = 'Autor es obligatorio';
            }

            if (empty($fecha)) {
                $errores['fecha'] = 'Fecha es obligatorio';
            }

            if (empty($lugar)) {
                $errores['lugar'] = 'Lugar es obligatorio';
            }

            if (empty($categoria)) {
                $errores['categoria'] = 'Categoría es obligatorio';
            }

            if (empty($carpeta)) {
                $errores['carpeta'] = 'Carpeta es obligatorio';
            } else if (strpos($carpeta, ' ') !== false) {
                $errores['carpeta'] = 'Incluya un nombre sin espacios';
            }

            # Comprobar validación
            if (!empty($errores)) {
                # Errores de validación
                $_SESSION['album'] = serialize($album);
                $_SESSION['error'] = 'Formulario no ha sido validado';
                $_SESSION['errores'] = $errores;
                header('location:' . URL . 'album/nuevo');
            } else {
                # Añadir registro a la tabla
                $this->model->create($album);

                #Crear carpeta en images
                $carpeta = $album->carpeta;
                $rutaCarpeta = "images/$carpeta";
                if (!file_exists($rutaCarpeta)) {
                    mkdir($rutaCarpeta, 0777, true);
                }
                $_SESSION['mensaje'] = "Álbum creado correctamente";
                header('location:' . URL . 'album');
            }
        }
    }
    function new()
    {

        # Iniciamos sesión
        session_start();

        # Comprobamos si el usuario está autentificado
        if (!isset($_SESSION['id'])) {
            $_SESSION['notify'] = "Usuario debe autentificarse";

            header("location:" . URL . "login");
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['album']['new']))) {
            $_SESSION['mensaje'] = "No tienes privilegios para realizar dicha operación";
            header('location:' . URL . 'album');
        } else {

            # Crear un objeto album vacio
            $this->view->album = new classAlbum();

            # Comprobamos si existen errores
            if (isset($_SESSION['error'])) {
                $this->view->error = $_SESSION['error'];
                $this->view->album = unserialize($_SESSION['album']);
                $this->view->errores = $_SESSION['errores'];

                unset($_SESSION['error']);
                unset($_SESSION['album']);
                unset($_SESSION['errores']);
            }

            $this->view->title = "Añadir - Gestión Album";
            $this->view->render('album/nuevo/index');
        }
    }

   

    function edit($param = [])
    {

        # Iniciamos sesión
        session_start();

        # Comprobamos si el usuario está autentificado        
        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";

            header("location:" . URL . "login");
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['album']['edit']))) {
            $_SESSION['mensaje'] = "No tienes privilegios para realizar dicha operación";
            header('location:' . URL . 'album');
        } else {

            $id = $param[0];

            # asigno id a una propiedad de la vista
            $this->view->id = $id;

            # title
            $this->view->title = "Editar - Panel de control Albumes";

            # obtener objeto de la clase album
            $this->view->album = $this->model->getAlbum($id);

            # Comprobar si el formulario viene de una no validación
            if (isset($_SESSION['error'])) {

                $this->view->error = $_SESSION['error'];
                $this->view->album = unserialize($_SESSION['album']);
                $this->view->errores = $_SESSION['errores'];

                # Elimino las variables de sesión
                unset($_SESSION['error']);
                unset($_SESSION['album']);
                unset($_SESSION['errores']);
            }

            # cargo la vista
            $this->view->render('album/edit/index');
        }
    }

    function update($param = [])
    {

        # Iniciamos sesión
        session_start();

        # Comprobamos si el usuario está autentificado        
        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";

            header("location:" . URL . "login");
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['album']['edit']))) {
            $_SESSION['mensaje'] = "No tienes privilegios para realizar dicha operación";
            header('location:' . URL . 'album');
        } else {

            # datos del formulario
            $titulo = filter_var($_POST['titulo'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
            $descripcion = filter_var($_POST['descripcion'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
            $autor = filter_var($_POST['autor'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
            $fecha = filter_var($_POST['fecha'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
            $lugar = filter_var($_POST['lugar'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
            $categoria = filter_var($_POST['categoria'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
            $etiquetas = filter_var($_POST['etiquetas'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
            $num_fotos = filter_var($_POST['num_fotos'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
            $num_visitas = filter_var($_POST['num_visitas'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
            $carpeta = filter_var($_POST['carpeta'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);

        # Cargamos los datos del formulario
            $album = new classAlbum(
                null,
                $titulo,
                $descripcion,
                $autor,
                $fecha,
                $lugar,
                $categoria,
                $etiquetas,
                $num_fotos,
                $num_visitas,
                $carpeta
            );

            # Cargo id del album que voya a actualizar
            $id = $param[0];

            # Obtengo el  objeto album original
            $album_orig = $this->model->getAlbum($id);

            // Obtener la ruta de la carpeta original
            $rutaCarpetaOriginal = "images/" . $album_orig->carpeta;

            // Obtener la ruta de la nueva carpeta (si se especifica)
            $rutaNuevaCarpeta = "images/" . $carpeta;

            # Validación
            $errores = [];

            if (empty($titulo)) {
                $errores['titulo'] = 'Título es obligatorio';
            } else if (mb_strlen($titulo) > 100) {
                $errores['titulo'] = 'Este campo no puede superar 100 caracteres';
            }

            if (empty($descripcion)) {
                $errores['descripcion'] = 'Descripción es obligatorio';
            }

            if (empty($autor)) {
                $errores['autor'] = 'Autor es obligatorio';
            }

            if (empty($fecha)) {
                $errores['fecha'] = 'Fecha es obligatorio';
            } else if (!$this->model->validateFecha($fecha)) {
                $errores['fecha'] = 'Fecha no es válida';
            }

            if (empty($lugar)) {
                $errores['lugar'] = 'Lugar es obligatorio';
            }

            if (empty($categoria)) {
                $errores['categoria'] = 'Categoría es obligatorio';
            }

            # comprobar validación
            if (!empty($errores)) {
                # Errores de validación
                $_SESSION['album'] = serialize($album);
                $_SESSION['error'] = 'Formulario no ha sido validado';
                $_SESSION['errores'] = $errores;
                header('location:' . URL . 'album/edit/' . $id);
            } else {

                # Actualizar registro
                $this->model->update($album, $id);

                # Mensaje
                $_SESSION['mensaje'] = "Álbum actualizado correctamente";

                # Redirigimos a la vista principal de álbumes
                header('location:' . URL . 'album');
            }
        }
    }

    function order($param = [])
    {

        # Iniciamos sesión
        session_start();

        # Comprobamos si el usuario está autentificado        
        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";

            header("location:" . URL . "login");
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['album']['order']))) {
            $_SESSION['mensaje'] = "No tienes privilegios para realizar dicha operación";
            header('location:' . URL . 'album');
        } else {

            # Obtengo criterio de ordenación
            $criterio = $param[0];


            $this->view->title = "Ordenar - Panel Control Album";
            $this->view->albumes = $this->model->order($criterio);
            $this->view->render('album/main/index');
        }
    }

    function filter($param = [])
    {

        # Iniciamos sesión
        session_start();

        # Comprobamos si el usuario está autentificado        
        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";
            header("location:" . URL . "login");
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['album']['filter']))) {
            $_SESSION['mensaje'] = "No tienes privilegios para realizar dicha operación";
            header('location:' . URL . 'album');
        } else {

            # Obtengo expresión de búsqueda
            $expresion = $_GET['expresion'];

            $this->view->title = "Buscar - Panel de Albumes";
            $this->view->albumes = $this->model->filter($expresion);
            $this->view->render('album/main/index');
        }
    }

    function add($param = [])
    {

        # Iniciamos sesión
        session_start();

        # Comprobamos si el usuario está autentificado
        if (!isset($_SESSION['id'])) {
            $_SESSION['notify'] = "Usuario debe autentificarse";

            header("location:" . URL . "login");
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['album']['add']))) {
            $_SESSION['mensaje'] = "No tienes privilegios para realizar dicha operación";
            header('location:' . URL . 'album');
        } else {

            # mensaje de error
            if (isset($_SESSION['error'])) {

                $this->view->error = $_SESSION['error'];
                $this->view->errores = $_SESSION['errores'];

                unset($_SESSION['error']);
                unset($_SESSION['errores']);
            }

            //Obtnego objeto de la clase album
            $album = $this->model->getAlbum($param[0]);

            $this->model->subirArchivo($_FILES['archivos'], $album->carpeta);

            $numFotos = count(glob("images/" . $album->carpeta . "/*"));

            $this->model->numeroFotos($album->id, $numFotos);

            header("location:" . URL . "album");
        }
    }

    function delete($param = [])
    {

        # Iniciamos sesión
        session_start();

        # Comprobamos si el usuario está autentificado        
        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";

            header("location:" . URL . "login");
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['album']['delete']))) {
            $_SESSION['mensaje'] = "No tienes privilegios para realizar dicha operación";
            header('location:' . URL . 'album');
        } else {

            # obtenemos id del  album
            $id = $param[0];

            # borrar la carpeta del album
            $album = $this->model->getAlbum($id);
            $carpeta = $album->carpeta;
            $rutaCarpeta = "images/$carpeta";

            # eliminar carpeta si existe
            if (file_exists($rutaCarpeta)) {
                $this->deleteCarpeta($rutaCarpeta);
            }

            # eliminar album
            $this->model->delete($id);

            # generar mensaje
            $_SESSION['mensaje'] = 'album eliminado correctamente';

            # redirecciono al main de albumes
            header('location:' . URL . 'album');
        }
    }
    function deleteCarpeta($directorio)
    {
        $ficheros = array_diff(scandir($directorio), array('.', '..'));
        foreach ($ficheros as $fichero) {
            (is_dir("$directorio/$fichero")) ? $this->deleteCarpeta("$directorio/$fichero") : unlink("$directorio/$fichero");
        }
        return rmdir($directorio);
    }
}
