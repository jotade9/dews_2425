<?php

class album extends Controller
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
        $this->view->title = "Gestión de albumes";

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


        // Cargo la lista de categorias
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
        $id_categoria = filter_var($_POST['id_categoria'] ??= '', FILTER_SANITIZE_NUMBER_INT);
        $etiquetas = filter_var($_POST['etiquetas'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $carpeta = filter_var($_POST['carpeta'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);

        // Creamos un objeto de la clase album con los detalles del formulario
        $album_form = new classAlbum(
            null,
            $titulo,
            $descripcion,
            $autor,
            $fecha,
            $lugar,
            $id_categoria,
            $etiquetas,
            $carpeta
        );

        // Validación de los datos
        // Creo un array para almacenar los errores
        $error = [];


        // Validacion del título
        // Reglas: obligatorio y menor que 100
        if (empty($titulo)) {
            $error['titulo'] = 'El título es obligatorio';
        } else if (strlen($titulo) > 100) {
            $error['titulo'] = 'El título no puede superar los 100 caracteres';
        }

        // Validacion de la descripcion
        // Reglas: obligatorio
        if (empty($descripcion)) {
            $error['descripcion'] = 'La descripcion es obligatoria';
        }

        // Validacion del autor
        // Reglas: obligatorio 
        if (empty($autor)) {
            $error['autor'] = 'El autor es obligatorio';
        }

        // Validacion de fecha
        // Reglas: obligatorio , formato fecha 
        if (empty($fecha)) {
            $error['fecha'] = 'La fecha es obligatoria';
        } else {
            $fechaFormat = DateTime::createFromFormat('Y-m-d', $fecha);
            if (!$fechaFormat) {
                $error['fecha'] = 'El formato de la fecha no es correcto';
            }
        }

        // Validacion del lugar 
        // Reglas: obligatorio
        if (empty($lugar)) {
            $error['lugar'] = 'El lugar es obligatorio';
        }


        // Validacion de categoría 
        // Reglas: obligatorio         
        if (empty($id_categoria)) {
            $error['id_categoria'] = 'La categoria es obligatoria';
        } else if (!$this->model->validateForeignKeyCategoria($id_categoria)) {
            $error['id_categoria'] = 'La categoria no existe';
        }


        // Validacion de etiquetas 
        // Reglas: 


        // Validacion de carpeta 
        // Reglas: obligatorio, sin espacios, unica
        if (empty($carpeta)) {
            $error['carpeta'] = 'La carpeta es obligatoria';
        } else if (strpos($carpeta, ' ') !== false) {
            $error['carpeta'] = 'La carpeta no puede contener espacios';
        } else if (!$this->model->validateUniqueCarpeta($carpeta)) {
            $error['carpeta'] = 'La carpeta ya existe';
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
            header('location:' . URL . 'album/nuevo');
            exit();
        }

        // Añadimos album a la tabla
        $this->model->create($album_form);

        // Genero mensaje de éxito
        $_SESSION['mensaje'] = 'Album añadido con éxito';

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

        // obtengo el id del album que voy a editar
        // album/edit/4
        $this->view->id = htmlspecialchars($param[0]);

        // obtengo el token CSRF
        $this->view->csrf_token = $param[1];

        // Validación CSRF
        if (!hash_equals($_SESSION['csrf_token'], $this->view->csrf_token)) {
            require_once 'controllers/error.php';
            $controller = new Errores('Petición no válida');
            exit();
        }

        // obtener objeto de la clase album con el id asociado
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

        // title
        $this->view->title = "Formulario Editar Album";

        // Cargo la lista de categorias
        $this->view->categorias = $this->model->get_categorias();

        // cargo la vista
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
        $id_categoria = filter_var($_POST['id_categoria'] ??= '', FILTER_SANITIZE_NUMBER_INT);
        $etiquetas = filter_var($_POST['etiquetas'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);

        // Creamos un objeto de la clase album con los detalles del formulario
        $album_form = new classAlbum(
            null,
            $titulo,
            $descripcion,
            $autor,
            $fecha,
            $lugar,
            $id_categoria,
            $etiquetas,
            null
        );

        // Obtengo los detalles del album de la base de datos
        $album = $this->model->read($id);

        // Control de cambios en los campos
        $cambios = false;

        // Validación de los datos
        // Valido en caso de que haya sufrido modificaciones el campo correspondiente
        $error = [];


        // Validacion del título
        // Reglas: obligatorio y menor que 100
        if (strcmp($titulo, $album->titulo) != 0) {
            $cambios = true;
            if (empty($titulo)) {
                $error['titulo'] = 'El título es obligatorio';
            } else if (strlen($titulo) > 100) {
                $error['titulo'] = 'El título no puede superar los 100 caracteres';
            }
        }

        // Validacion de la descripcion
        // Reglas: obligatorio
        if (strcmp($descripcion, $album->descripcion) != 0) {
            $cambios = true;
            if (empty($descripcion)) {
                $error['descripcion'] = 'La descripcion es obligatoria';
            }
        }

        // Validacion del autor
        // Reglas: obligatorio 
        if (strcmp($autor, $album->autor) != 0) {
            $cambios = true;
            if (empty($autor)) {
                $error['autor'] = 'El autor es obligatorio';
            }
        }

        // Validacion de fecha
        // Reglas: obligatorio , formato fecha 
        if (strcmp($fecha, $album->fecha) != 0) {
            $cambios = true;
            if (empty($fecha)) {
                $error['fecha'] = 'La fecha es obligatoria';
            } else {
                $fechaFormat = DateTime::createFromFormat('Y-m-d', $fecha);
                if (!$fechaFormat) {
                    $error['fecha'] = 'El formato de la fecha no es correcto';
                }
            }
        }

        // Validacion del lugar 
        // Reglas: obligatorio
        if (strcmp($lugar, $album->lugar) != 0) {
            $cambios = true;
            if (empty($lugar)) {
                $error['lugar'] = 'El lugar es obligatorio';
            }
        }


        // Validacion de categoría 
        // Reglas: obligatorio     
        if (strcmp($id_categoria, $album->id_categoria) != 0) {
            $cambios = true;
            if (empty($categoria)) {
                $error['id_categoria'] = 'La categoria es obligatoria';
            } else if (!$this->model->validateForeignKeyCategoria($id_categoria)) {
                $error['id_categoria'] = 'La categoria no existe';
            }
        }


        // Validacion de etiquetas 
        // Reglas: 
        if (strcmp($etiquetas, $album->etiquetas) != 0) {
            $cambios = true;
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
        $_SESSION['mensaje'] = 'Album actualizado con éxito';

        // Cargo el controlador principal de album
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

        // obtengo la carpeta
        $carpeta = $param[2];

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

        // Id ha sido validado
        // Elimino al album de la base de datos
        $this->model->delete($id, $carpeta);

        // Genero mensaje de éxito
        $_SESSION['mensaje'] = 'Album eliminado con éxito';

        // Cargo el controlador principal de album
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
        // validateIdalbum($id) si existe devuelve TRUE
        if (!$this->model->validateIdAlbum($id)) {
            // Genero mensaje de error
            $_SESSION['error'] = 'ID no válido';

            // redireciona al main de album
            header('location:' . URL . 'album');
            exit();
        }

        // Cargo el título
        $this->view->title = "Mostrar - Gestión de álbumes";

        // Obtengo los detalles del album mediante el método read del modelo
        $this->view->album = $this->model->read($id);

        // Cargo la lista de categorias
        $this->view->categorias = $this->model->get_categorias();

        $this->view->album->num_visitas++;

        //Actualizo el numero de visitas
        $this->model->update_visitas($id, $this->view->album->num_visitas);

        // Cargo la vista
        $this->view->render('album/mostrar/index');
    }

    /*
        Método filtrar()

        Busca un album en la base de datos

        url asociada: /album/filtrar/expresion

        GET: 
            - expresion de búsqueda

        DEVUELVE:
            - PDOStatement con los albumes que coinciden con la expresión de búsqueda
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

        // Obtengo la expresión de búsqueda
        $expresion = htmlspecialchars($_GET['expresion']);

        // obtengo el token CSRF
        $csrf_token = htmlspecialchars($_GET['csrf_token']);

        // Validación CSRF
        if (!hash_equals($_SESSION['csrf_token'], $csrf_token)) {
            require_once 'controllers/error.php';
            $controller = new Errores('Petición no válida');
            exit();
        }

        // Cargo el título
        $this->view->title = "Filtrar por: {$expresion} - Gestión de álbumes";

        // Obtengo los albumes que coinciden con la expresión de búsqueda
        $this->view->albumes = $this->model->filter($expresion);

        // Cargo la lista de categorias
        $this->view->categorias = $this->model->get_categorias();

        // Cargo la vista
        $this->view->render('album/main/index');
    }

    /*
        Método ordenar()

        Ordena los albumes de la base de datos

        url asociada: /album/ordenar/id

        @param
            :int $id: id del campo por el que se ordenarán los albumes
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

        // Criterios de ordenación
        $criterios = [
            1 => 'ID',
            2 => 'Título',
            3 => 'Lugar',
            4 => 'Categoria',
            5 => 'Etiquetas',
            6 => 'Nº fotos',
            7 => 'Nº visitas'
        ];

        // Cargo el título
        $this->view->title = "Ordenar por {$criterios[$id]} - Gestión de albumes";

        // Obtengo los albumes ordenados por el campo id
        $this->view->albumes = $this->model->order($id);

        // Cargo la lista de categorias
        $this->view->categorias = $this->model->get_categorias();

        // Cargo la vista
        $this->view->render('album/main/index');
    }


    /*
        Método agregar()

        Descripcion: Agrega una imagen al album

    */
    function agregar($param = [])
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
        
        
        } else {

            # mensaje de error
            if (isset($_SESSION['error'])) {

                $this->view->error = $_SESSION['error'];
                $this->view->errores = $_SESSION['errores'];

                unset($_SESSION['error']);
                unset($_SESSION['errores']);
            }

            //Obtnego objeto de la clase album
            $album = $this->model->read($param[0]);

            $this->model->subirArchivo($_FILES['archivos'], $album->carpeta);

            $numFotos = count(glob("images/" . $album->carpeta . "/*"));

            $this->model->numeroFotos($album->id, $numFotos);

            header("location:" . URL . "album");
        }
    }
}
