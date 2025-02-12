<?php

class Album extends Controller
{

    function __construct()
    {

        parent::__construct();
    }

    /*
        Método principal

        Se  carga siempre que la url contenga sólo el primer parámetro

        url: /album
    */
    public function render()
    {
        // inicio o continuo la sesión
        session_start();

        // Comprobar si hay un usuario logueado
        if (!isset($_SESSION['user_id'])) {
            // Genero mensaje de error
            $_SESSION['mensaje_error'] = 'Acceso denegado';
            header('location:' . URL . 'auth/login');
            exit();
        } // Comprobar si el usuario tiene permisos

        else if (!in_array($_SESSION['role_id'], $GLOBALS['album']['main'])) {

            $_SESSION['mensaje_error'] = 'Acceso denegado. No tiene permisos suficientes';
            header('location:' . URL . 'auth/login');
            exit();
        }

        // Creo un token CSRF
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));

        // Compruebo si hay mensaje de éxito
        if (isset($_SESSION['mensaje'])) {

            // Creo la propiedad mensaje en la vista
            $this->view->mensaje = $_SESSION['mensaje'];

            // Elimino la variable de sesión mensaje
            unset($_SESSION['mensaje']);
        }

        // Compruebo si hay mensaje de error
        if (isset($_SESSION['mensaje_error'])) {

            // Creo la propiedad mensaje en la vista
            $this->view->mensaje_error = $_SESSION['mensaje_error'];

            // Elimino la variable de sesión mensaje
            unset($_SESSION['mensaje_error']);
        }


        // Compruebo validación errónea de formulario
        if (isset($_SESSION['error'])) {

            // Creo la propiedad mensaje_error en la vista
            $this->view->mensaje_error = $_SESSION['error'];

            // Elimino la variable de sesión error
            unset($_SESSION['error']);
        }

        // Creo la propiedad title de la vista
        $this->view->title = "Gestión de Albumes";

        // Creo la propiedad albumes para usar en la vista
        $this->view->albumes = $this->model->get();

        $this->view->render('album/main/index');
    }

    /*
        Método nuevo()

        Muestra el formulario que permite añadir nuevo album

        url asociada: /album/nuevo
    */
    public function nuevo()
    {
        // inicio o continuo la sesión
        session_start();

        // Comprobar si hay un usuario logueado
        if (!isset($_SESSION['user_id'])) {
            // Genero mensaje error
            $_SESSION['mensaje_error'] = 'Acceso denegado';
            header('location:' . URL . 'auth/login');
            exit();
        }
        // Comprobar si el usuario tiene permisos
        else if (!in_array($_SESSION['role_id'], $GLOBALS['album']['nuevo'])) {
            // Genero mensaje error
            $_SESSION['mensaje_error'] = 'Acceso denegado. No tiene permisos suficientes';
            header('location:' . URL . 'album');
            exit();
        }

        // Creo un token CSRF
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));

        // Crear un objeto vacío de la clase album
        $this->view->album = new classAlbum();

        // Comrpuebo si hay errores en la validación
        if (isset($_SESSION['error'])) {

            // Creo la propiedad error en la vista
            $this->view->error = $_SESSION['error'];

            // Creo la propiedad album en la vista
            $this->view->album = $_SESSION['album'];

            // Creo la propiedad mensaje de error
            $this->view->mensaje_error = 'Error en el formulario';

            // Elimino la variable de sesión error
            unset($_SESSION['error']);

            // Elimino la variable de sesión album
            unset($_SESSION['album']);
        }

        // Creo la propiead título
        $this->view->title = "Añadir - Gestión de albumes";

        // Creo la propiedad categorias en la vista
        $this->view->categorias = $this->model->get_categorias();

        // Cargo la vista asociada a este método
        $this->view->render('album/nuevo/index');
    }

    /*
        Método create()

        Permite añadir nuevo album al formulario

        url asociada: /album/create
        POST: detalles del album
    */
    public function create()
    {

        // inicio o continuo la sesión
        session_start();

        // Comprobar si hay un usuario logueado
        if (!isset($_SESSION['user_id'])) {
            // Genero mensaje error
            $_SESSION['mensaje_error'] = 'Acceso denegado';
            header('location:' . URL . 'auth/login');
            exit();
        }
        // Comprobar si el usuario tiene permisos
        else if (!in_array($_SESSION['role_id'], $GLOBALS['album']['nuevo'])) {
            // Genero mensaje error
            $_SESSION['mensaje_error'] = 'Acceso denegado. No tiene permisos suficientes';
            header('location:' . URL . 'album');
            exit();
        }

        // Validación CSRF
        if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
            // require_once 'controllers/error.php';
            // $controller = new Errores('Petición no válida');
            // exit();
            header('location:' . URL . 'errores');
            exit();
        }

        // Recogemos los detalles del formulario saneados
        // Prevenir ataques XSS
        $titulo = filter_var($_POST['titulo'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $descripcion = filter_var($_POST['descripcion'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $autor = filter_var($_POST['autor'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $fecha = filter_var($_POST['fecha'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $lugar = filter_var($_POST['lugar'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $etiquetas = filter_var($_POST['etiquetas'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $carpeta = filter_var($_POST['carpeta'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $categoria_id = filter_var($_POST['categoria_id'] ??= '', FILTER_SANITIZE_NUMBER_INT);

        // Creamos un objeto de la clase album con los detalles del formulario
        $album = new classAlbum(
            null,
            $titulo,
            $descripcion,
            $autor,
            $fecha,
            $lugar,
            $etiquetas,
            null,
            null,
            $carpeta,
            $categoria_id
        );

        // Validación de los datos

        // Creo un array para almacenar los errores
        $error = [];

        // Validación del titulo
        // Reglas: obligatorio y menor que 100
        if (empty($titulo)) {
            $error['titulo'] = 'El titulo es obligatorio';
        } else if (strlen($titulo) > 100) {
            $error['titulo'] = 'El titulo no puede tener más de 100 caracteres';
        }

        //validacion de la descripcion
        // Reglas: obligatorio
        if (empty($descripcion)) {
            $error['descripcion'] = 'La descripcion es obligatoria';
        }
        // validacion del autor
        // Reglas: obligatorio
        if (empty($autor)) {
            $error['autor'] = 'El autor es obligatorio';
        }

        // Validación de la fecha
        // Reglas: obligatorio, formato fecha
        if (empty($fecha)) {
            $error['fecha'] = 'La fecha es obligatoria';
        } else {
            $fecha = DateTime::createFromFormat('Y-m-d', $fecha);
            if (!$fecha) {
                $error['fecha'] = 'El formato de la fecha no es correcto';
            }
        }

        // Validación de los lugar
        // Reglas: obligatorio
        if (empty($lugar)) {
            $error['lugar'] = 'Los lugar son obligatorios';
        }
        // Validación de etiquetas
        // Reglas: no obligatorio

        // Validacion de carpeta
        // Reglas: obligatorio (sin espacios)
        if (empty($carpeta)) {
            $error['carpeta'] = 'La carpeta es obligatoria';
        } else if (strpos($carpeta, ' ') !== false) {
            $error['carpeta'] = 'La carpeta no puede contener espacios';
        }
        // Validacion de categoria_id
        // Reglas: obligatorio, entero, clave ajena
        if (empty($categoria_id)) {
            $error['categoria_id'] = 'La categoria es obligatoria';
        } else if (!is_numeric($categoria_id)) {
            $error['categoria_id'] = 'El formato de categoria no es correcto';
        } else if (!$this->model->validateForeignKeyCategoria($categoria_id)) {
            $error['categoria_id'] = 'La categoria no existe';
        }

        // Si hay errores
        if (!empty($error)) {

            // Formulario no ha sido validado
            // Tengo que redireccionar al formulario de nuevo

            // Creo la variable de sessión album con los datos del formulario
            $_SESSION['album'] = $album;

            // Creo la variable de sessión error con los errores
            $_SESSION['error'] = $error;

            // redireciona al formulario de nuevo
            header('location:' . URL . 'album/nuevo');
            exit();
        }

        // Añadimos album a la tabla
        $this->model->create($album);

        // Genero mensaje de éxito
        $_SESSION['mensaje'] = 'album añadido con éxito';

        // redireciona al main de album
        header('location:' . URL . 'album');
        exit();
    }

    /*
        Método editar()

        Muestra el formulario que permite editar los detalles de un album

        url asociada: /album/editar/id/csrf_token

        @param
            - int $id: id del album a editar
            - string $csrf_token: token CSRF

    */
    function editar($param = [])
    {
        // inicio o continuo la sesión
        session_start();

        // Comprobar si hay un usuario logueado
        if (!isset($_SESSION['user_id'])) {
            // Genero mensaje error
            $_SESSION['mensaje_error'] = 'Acceso denegado';
            header('location:' . URL . 'auth/login');
            exit();
        }
        // Comprobar si el usuario tiene permisos
        else if (!in_array($_SESSION['role_id'], $GLOBALS['album']['editar'])) {
            // Genero mensaje error
            $_SESSION['mensaje_error'] = 'Acceso denegado. No tiene permisos suficientes';
            header('location:' . URL . 'album');
            exit();
        }

        # obtengo el id del album que voy a editar
        // album/edit/4
        $this->view->id = htmlspecialchars($param[0]);

        # obtengo el token CSRF
        $this->view->csrf_token = $param[1];

        // Validación CSRF
        if (!hash_equals($_SESSION['csrf_token'], $this->view->csrf_token)) {
            require_once 'controllers/error.php';
            $controller = new Errores('Petición no válida');
            exit();
        }

        # obtener objeto de la clase album con el id asociado
        $this->view->album = $this->model->read($this->view->id);

        // Comrpuebo si hay errores en la validación
        if (isset($_SESSION['error'])) {

            // Creo la propiedad error en la vista
            $this->view->error = $_SESSION['error'];

            // Creo la propiedad album en la vista
            $this->view->album = $_SESSION['album'];

            // Creo la propiedad mensaje de error
            $this->view->mensaje_error = 'Error en el formulario';

            // Elimino la variable de sesión error
            unset($_SESSION['error']);

            // Elimino la variable de sesión album
            unset($_SESSION['album']);
        }

        # obtener categorias
        $this->view->categorias = $this->model->get_categorias();

        # title
        $this->view->title = "Formulario Editar album";

        # cargo la vista
        $this->view->render('album/editar/index');
    }

    /*
        Método update()

        Actualiza los detalles de un album

        url asociada: /album/update/id

        POST: detalles del album

        @param int $id: id del album a editar
    */
    public function update($param = [])
    {
        // inicio o continuo la sesión
        session_start();

        // Comprobar si hay un usuario logueado
        if (!isset($_SESSION['user_id'])) {
            // Genero mensaje error
            $_SESSION['mensaje_error'] = 'Acceso denegado';
            header('location:' . URL . 'auth/login');
            exit();
        }
        // Comprobar si el usuario tiene permisos
        else if (!in_array($_SESSION['role_id'], $GLOBALS['album']['editar'])) {
            // Genero mensaje error
            $_SESSION['mensaje_error'] = 'Acceso denegado. No tiene permisos suficientes';
            header('location:' . URL . 'album');
            exit();
        }

        // obtengo el id del album que voy a editar
        $id = htmlspecialchars($param[0]);

        // obtengo el token CSRF
        $csrf_token = $param[1];

        // Validación CSRF
        if (!hash_equals($_SESSION['csrf_token'], $csrf_token)) {
            require_once 'controllers/error.php';
            $controller = new Errores('Petición no válida');
            exit();
        }

        // Recogemos los detalles del formulario saneados
        // Prevenir ataques XSS
        $titulo = filter_var($_POST['titulo'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $descripcion = filter_var($_POST['descripcion'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $autor = filter_var($_POST['autor'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $fecha = filter_var($_POST['fecha'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $lugar = filter_var($_POST['lugar'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $etiquetas = filter_var($_POST['etiquetas'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $carpeta = filter_var($_POST['carpeta'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $categoria_id = filter_var($_POST['categoria_id'] ??= '', FILTER_SANITIZE_NUMBER_INT);

        // Creo un objeto de la clase album con los detalles del formulario
        // Actualizo los detalles del album
        $album_form = new classAlbum(
            null,
            $titulo,
            $descripcion,
            $autor,
            $fecha,
            $lugar,
            $etiquetas,
            null,
            null,
            $carpeta,
            $categoria_id
        );

        // Obtengo los detalles del album de la base de datos
        $album = $this->model->read($id);

        // Validación de los datos
        // Valido en caso de que haya sufrido modificaciones el campo correspondiente
        $error = [];

        // Control de cambios en los campos
        $cambios = false;

        // Validación del titulo
        // Reglas: obligatorio
        if (strcmp($titulo, $album->titulo) != 0) {
            $cambios = true;
            if (empty($titulo)) {
                $error['titulo'] = 'El titulo es obligatorio';
            }
        }

        //validacion de la descripcion
        // Reglas: obligatorio
        if (strcmp($descripcion, $album->descripcion) != 0) {
            $cambios = true;
            if (empty($descripcion)) {
                $error['descripcion'] = 'La descripcion es obligatoria';
            }
        }
        // validacion del autor
        // Reglas: obligatorio
        if (strcmp($autor, $album->autor) != 0) {
            $cambios = true;
            if (empty($autor)) {
                $error['autor'] = 'El autor es obligatorio';
            }
        }

        // Validación de la fecha
        // Reglas: obligatorio, formato fecha
        if (strcmp($fecha, $album->fecha) != 0) {
            $cambios = true;
            if (empty($fecha)) {
                $error['fecha'] = 'La fecha es obligatoria';
            } else {
                $fecha = DateTime::createFromFormat('Y-m-d', $fecha);
                if (!$fecha) {
                    $error['fecha'] = 'El formato de la fecha no es correcto';
                }
            }
        }

        // Validación del lugar
        // Reglas: obligatorio
        if (strcmp($lugar, $album->lugar) != 0) {
            $cambios = true;
            if (empty($lugar)) {
                $error['lugar'] = 'El lugar es obligatorios';
            }
        }

        // Validación de etiquetas
        // Reglas: no obligatorio
        if (strcmp($etiquetas, $album->etiquetas) != 0) {
            $cambios = true;
        }

        // Validacion de carpeta
        // Reglas: obligatorio (sin espacios)
        if (strcmp($carpeta, $album->carpeta) != 0) {
            $cambios = true;
            if (empty($carpeta)) {
                $error['carpeta'] = 'La carpeta es obligatoria';
            } else if (strpos($carpeta, ' ') !== false) {
                $error['carpeta'] = 'La carpeta no puede contener espacios';
            }
        }

        // Validacion de categoria_id
        // Reglas: obligatorio, entero, clave ajena
        if (strcmp($categoria_id, $album->categoria_id) != 0) {
            $cambios = true;
            if (empty($categoria_id)) {
                $error['categoria_id'] = 'La categoria es obligatoria';
            } else if (!is_numeric($categoria_id)) {
                $error['categoria_id'] = 'El formato de categoria no es correcto';
            } else if (!$this->model->validateForeignKeyCategoria($categoria_id)) {
                $error['categoria_id'] = 'La categoria no existe';
            }
        }

        // Si hay errores
        if (!empty($error)) {

            // Formulario no ha sido validado
            // Tengo que redireccionar al formulario de nuevo

            // Creo la variable de sessión album con los datos del formulario
            $_SESSION['album'] = $album_form;

            // Creo la variable de sessión error con los errores
            $_SESSION['error'] = $error;

            // redireciona al formulario de nuevo
            header('location:' . URL . 'album/editar/' . $id . '/' . $csrf_token);
            exit();
        }

        // Compruebo si ha habido cambios
        if (!$cambios) {
            // Genero mensaje de éxito
            $_SESSION['mensaje'] = 'No se han realizado cambios';

            // redireciona al main de album
            header('location:' . URL . 'album');
            exit();
        }
        // Necesito crear el método update en el modelo
        $this->model->update($album_form, $id);

        // Genero mensaje de éxito
        $_SESSION['mensaje'] = 'album actualizado con éxito';

        # Cargo el controlador principal de album
        header('location:' . URL . 'album');
        exit();
    }

    /*
        Método eliminar()

        Borra un album de la base de datos

        url asociada: /album/eliminar/id

        @param
            :int $id: id del album a eliminar
    */
    public function eliminar($param = [])
    {

        // inicio o continuo la sesión
        session_start();

        // Comprobar si hay un usuario logueado
        if (!isset($_SESSION['user_id'])) {
            // Genero mensaje error
            $_SESSION['mensaje_error'] = 'Acceso denegado';
            header('location:' . URL . 'auth/login');
            exit();
        }
        // Comprobar si el usuario tiene permisos
        else if (!in_array($_SESSION['role_id'], $GLOBALS['album']['eliminar'])) {
            // Genero mensaje error
            $_SESSION['mensaje_error'] = 'Acceso denegado. No tiene permisos suficientes';
            header('location:' . URL . 'album');
            exit();
        }

        // obtengo el id del album que voy a eliminar
        $id = htmlspecialchars($param[0]);

        // obtengo el token CSRF
        $csrf_token = $param[1];

        // Validación CSRF
        if (!hash_equals($_SESSION['csrf_token'], $csrf_token)) {
            require_once 'controllers/error.php';
            $controller = new Errores('Petición no válida');
            exit();
        }

        // Validar id del album
        // validateIdalbum($id) si existe devuelve TRUE
        if (!$this->model->validateIdAlbum($id)) {
            // Genero mensaje de error
            $_SESSION['error'] = 'ID no válido';

            // redireciona al main de album
            header('location:' . URL . 'album');
            exit();
        }

        // Id ha sido validado
        // Elimino al album de la base de datos
        $this->model->delete($id);

        // Genero mensaje de éxito
        $_SESSION['mensaje'] = 'album eliminado con éxito';

        # Cargo el controlador principal de album
        header('location:' . URL . 'album');
    }

    /*
        Método mostrar()

        Muestra los detalles de un album

        url asociada: /album/mostrar/id

        @param
            :int $id: id del album a mostrar
    */
    public function mostrar($param = [])
    {
        // inicio o continuo la sesión
        session_start();

        // Comprobar si hay un usuario logueado
        if (!isset($_SESSION['user_id'])) {
            // Genero mensaje error
            $_SESSION['mensaje_error'] = 'Acceso denegado';
            header('location:' . URL . 'auth/login');
            exit();
        }
        // Comprobar si el usuario tiene permisos
        else if (!in_array($_SESSION['role_id'], $GLOBALS['album']['mostrar'])) {
            // Genero mensaje error
            $_SESSION['mensaje_error'] = 'Acceso denegado. No tiene permisos suficientes';
            header('location:' . URL . 'album');
            exit();
        }

        // obtengo el id del album que voy a eliminar
        $id = htmlspecialchars($param[0]);

        // obtengo el token CSRF
        $csrf_token = $param[1];

        // Validación CSRF
        if (!hash_equals($_SESSION['csrf_token'], $csrf_token)) {
            require_once 'controllers/error.php';
            $controller = new Errores('Petición no válida');
            exit();
        }

        // Validar id del album
        // validateIdAlbum($id) si existe devuelve TRUE
        if (!$this->model->validateIdAlbum($id)) {
            // Genero mensaje de error
            $_SESSION['error'] = 'ID no válido';

            // redireciona al main de album
            header('location:' . URL . 'album');
            exit();
        }

        # Util numeroVisitas() para incrementar el número de visitas
        $this->model->numeroVisitas($id);

        # Cargo el título
        $this->view->title = "Mostrar - Gestión de albumes";

        # Obtengo los detalles del album mediante el método read del modelo
        $this->view->album = $this->model->read($id);

        # Obtengo las categorias
        $this->view->categorias = $this->model->get_categorias();

        # Cargo la vista
        $this->view->render('album/mostrar/index');
    }

    /*
        Método filtrar()

        Busca un album en la base de datos

        url asociada: /album/filtrar/expresion

        GET: 
            - expresion de búsqueda

        DEVUELVE:
            - PDOStatement con los albums que coinciden con la expresión de búsqueda
    */
    public function filtrar()
    {
        // inicio o continuo la sesión
        session_start();

        // Comprobar si hay un usuario logueado
        if (!isset($_SESSION['user_id'])) {
            // Genero mensaje error
            $_SESSION['mensaje_error'] = 'Acceso denegado';
            header('location:' . URL . 'auth/login');
            exit();
        }
        // Comprobar si el usuario tiene permisos
        else if (!in_array($_SESSION['role_id'], $GLOBALS['album']['filtrar'])) {
            // Genero mensaje error
            $_SESSION['mensaje_error'] = 'Acceso denegado. No tiene permisos suficientes';
            header('location:' . URL . 'album');
            exit();
        }

        # Obtengo la expresión de búsqueda
        $expresion = htmlspecialchars($_GET['expresion']);

        // obtengo el token CSRF
        $csrf_token = htmlspecialchars($_GET['csrf_token']);

        // Validación CSRF
        if (!hash_equals($_SESSION['csrf_token'], $csrf_token)) {
            require_once 'controllers/error.php';
            $controller = new Errores('Petición no válida');
            exit();
        }

        # Cargo el título
        $this->view->title = "Filtrar por: {$expresion} - Gestión de albumes";

        # Obtengo los albumes que coinciden con la expresión de búsqueda
        $this->view->albumes = $this->model->filter($expresion);

        # Cargo la vista
        $this->view->render('album/main/index');
    }

    /*
        Método ordenar()

        Ordena los albums de la base de datos

        url asociada: /album/ordenar/id

        @param
            :int $id: id del campo por el que se ordenarán los albums
    */
    public function ordenar($param = [])
    {
        // inicio o continuo la sesión
        session_start();

        // Comprobar si hay un usuario logueado
        if (!isset($_SESSION['user_id'])) {
            // Genero mensaje error
            $_SESSION['mensaje_error'] = 'Acceso denegado';
            header('location:' . URL . 'auth/login');
            exit();
        }
        // Comprobar si el usuario tiene permisos
        else if (!in_array($_SESSION['role_id'], $GLOBALS['album']['ordenar'])) {
            // Genero mensaje error
            $_SESSION['mensaje_error'] = 'Acceso denegado. No tiene permisos suficientes';
            header('location:' . URL . 'album');
            exit();
        }

        // Obtener criterio
        $id = (int) htmlspecialchars($param[0]);

        // Obtener csrf_token
        $csrf_token = $param[1];

        // Validación CSRF
        if (!hash_equals($_SESSION['csrf_token'], $csrf_token)) {
            require_once 'controllers/error.php';
            $controller = new Errores('Petición no válida');
            exit();
        }

        # Criterios de ordenación
        $criterios = [
            1 => 'ID',
            2 => 'titulo',
            3 => 'autor',
            4 => 'fecha',
            5 => 'lugar',
            6 => 'etiquetas',
            7 => 'carpeta',
            8 => 'categoria'
        ];

        # Cargo el título
        $this->view->title = "Ordenar por {$criterios[$id]} - Gestión de albumes";

        # Obtengo los albums ordenados por el campo id
        $this->view->albumes = $this->model->order($id);

        # Cargo la vista
        $this->view->render('album/main/index');
    }

    
    /**
 * Método agregar
 * 
 * Descripción: Agrega una foto al álbum con validaciones de seguridad
 * @param array $param
 */
public function agregar($param = [])
{
    session_start();

    // Verificar autenticación
    if (!isset($_SESSION['user_id'])) {
        $_SESSION['mensaje_error'] = 'Acceso denegado';
        header('location:' . URL . 'auth/login');
        exit();
    }

    // Verificar permisos
    if (!in_array($_SESSION['role_id'], $GLOBALS['album']['agregar'])) {
        $_SESSION['mensaje_error'] = 'No tiene permisos suficientes';
        header('location:' . URL . 'album');
        exit();
    }

    // Validar ID del álbum
    $id = htmlspecialchars($param[0]);
    $csrf_token = $param[1];

    // Validación CSRF
    if (!hash_equals($_SESSION['csrf_token'], $csrf_token)) {
        $_SESSION['mensaje_error'] = 'Petición no válida';
        header('location:' . URL . 'album');
        exit();
    }

    // Validar si el álbum existe
    if (!$this->model->validateIdAlbum($id)) {
        $_SESSION['mensaje_error'] = 'ID no válido';
        header('location:' . URL . 'album');
        exit();
    }

    // Obtener detalles del álbum
    $album = $this->model->read($id);

    // Subir imagen al álbum
    if (isset($_FILES['archivo']) && $_FILES['archivo']['error'][0] !== UPLOAD_ERR_NO_FILE) {
        $this->model->subirArchivo($_FILES['archivo'], $album->carpeta);
    } else {
        $_SESSION['mensaje_error'] = "No se seleccionó ningún archivo.";
    }

    header('location:' . URL . 'album');
    exit();
}

/**
 * Método crearCarpeta
 * 
 * Descripción: Crea una carpeta para un álbum
 * @param array $param
 */
public function crearCarpeta($param = [])
{
    // Iniciar sesión
    session_start();

    // Comprobar si hay un usuario autenticado
    if (!isset($_SESSION['user_id'])) {
        $_SESSION['mensaje_error'] = 'Acceso denegado';
        header('location:' . URL . 'auth/login');
        exit();
    }

    // Comprobar si el usuario tiene permisos
    if (!in_array($_SESSION['role_id'], $GLOBALS['album']['crearCarpeta'])) {
        $_SESSION['mensaje_error'] = 'Acceso denegado. No tiene permisos suficientes';
        header('location:' . URL . 'album');
        exit();
    }

    // Validar parámetros recibidos
    if (empty($param) || count($param) < 2) {
        $_SESSION['mensaje_error'] = 'Parámetros insuficientes';
        header('location:' . URL . 'album');
        exit();
    }

    // Obtener el ID del álbum
    $id = htmlspecialchars($param[0]);

    // Obtener y validar el token CSRF
    $csrf_token = $param[1];
    if (!hash_equals($_SESSION['csrf_token'], $csrf_token)) {
        require_once 'controllers/error.php';
        new Errores('Petición no válida');
        exit();
    }

    // Validar el ID del álbum
    if (!$this->model->validateIdAlbum($id)) {
        $_SESSION['mensaje_error'] = 'ID de álbum no válido';
        header('location:' . URL . 'album');
        exit();
    }

    // Obtener detalles del álbum
    $album = $this->model->getAlbum($id);
    if (!$album) {
        $_SESSION['mensaje_error'] = 'El álbum no existe';
        header('location:' . URL . 'album');
        exit();
    }

    // Crear una carpeta para el álbum
    $resultado = $this->model->crearCarpeta($album->carpeta);
    if (!$resultado) {
        $_SESSION['mensaje_error'] = 'Error al crear la carpeta';
        header('location:' . URL . 'album');
        exit();
    }

    // Redirigir a la página del álbum con éxito
    $_SESSION['mensaje_exito'] = 'Carpeta creada correctamente';
    header("location:" . URL . "album");
    exit();
}

/**
 * Método eliminarCarpeta
 * 
 * Descripción: Elimina una carpeta con todas las fotos de un álbum
 * @param array $param
 */
public function eliminarCarpeta($param = [])
{
    // Iniciar sesión
    session_start();

    // Comprobar si hay un usuario autenticado
    if (!isset($_SESSION['user_id'])) {
        $_SESSION['mensaje_error'] = 'Acceso denegado';
        header('location:' . URL . 'auth/login');
        exit();
    }

    // Comprobar si el usuario tiene permisos
    if (!in_array($_SESSION['role_id'], $GLOBALS['album']['eliminar'])) {
        $_SESSION['mensaje_error'] = 'Acceso denegado. No tiene permisos suficientes';
        header('location:' . URL . 'album');
        exit();
    }

    // Validar parámetros recibidos
    if (empty($param) || count($param) < 2) {
        $_SESSION['mensaje_error'] = 'Parámetros insuficientes';
        header('location:' . URL . 'album');
        exit();
    }

    // Obtener el ID del álbum
    $id = htmlspecialchars($param[0]);

    // Obtener y validar el token CSRF
    $csrf_token = $param[1];
    if (!hash_equals($_SESSION['csrf_token'], $csrf_token)) {
        require_once 'controllers/error.php';
        new Errores('Petición no válida');
        exit();
    }

    // Validar el ID del álbum
    if (!$this->model->validateIdAlbum($id)) {
        $_SESSION['mensaje_error'] = 'ID de álbum no válido';
        header('location:' . URL . 'album');
        exit();
    }

    // Obtener detalles del álbum
    $album = $this->model->getAlbum($id);
    if (!$album) {
        $_SESSION['mensaje_error'] = 'El álbum no existe';
        header('location:' . URL . 'album');
        exit();
    }

    // Eliminar la carpeta con todas las fotos
    $resultado = $this->model->eliminarCarpeta($album->carpeta);
    if (!$resultado) {
        $_SESSION['mensaje_error'] = 'Error al eliminar la carpeta';
        header('location:' . URL . 'album');
        exit();
    }

    // Redirigir a la página del álbum con éxito
    $_SESSION['mensaje_exito'] = 'Carpeta eliminada correctamente';
    header("location:" . URL . "album");
    exit();

}

    
}
