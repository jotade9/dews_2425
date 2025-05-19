<?php

class Libro extends Controller
{

    function __construct()
    {

        parent::__construct();
    }


    /*
        Método checkLogin()

        Permite checkear si el usuario está logueado, si no está logueado 
        redirecciona a la página de login

    */
    public function checkLogin()
    {

        // Comprobar si hay un usuario logueado
        if (!isset($_SESSION['user_id'])) {
            // Genero mensaje error
            $_SESSION['mensaje_error'] = 'Acceso denegado';
            header('location:' . URL . 'auth/login');
            exit();
        }
    }

    /*
        Método checkPermissions()

        Permite checkear si el usuario tiene permisos suficientes para acceder a una página

        @param
            - array $roles: roles permitidos
    */
    public function checkPermissions($priviliges)
    {

        // Comprobar si el usuario tiene permisos
        if (!in_array($_SESSION['role_id'], $priviliges)) {
            // Genero mensaje error
            $_SESSION['mensaje_error'] = 'Acceso denegado. No tiene permisos suficientes';
            header('location:' . URL . 'libro');
            exit();
        }
    }

    /*
        Método checkTokenCsrf()

        Permite checkear si el token CSRF es válido

        @param
            - string $csrf_token: token CSRF
    */
    public function checkTokenCsrf($csrf_token)
    {

        // Validación CSRF
        if (!hash_equals($_SESSION['csrf_token'], $csrf_token)) {
            require_once 'controllers/error.php';
            $controller = new Errores('Petición no válida');
            exit();
        }
    }

    /*
        Método principal

        Se  carga siempre que la url contenga sólo el primer parámetro

        url: /libro
    */
    public function render()
    {
        // inicio o continuo la sesión
        session_start();

        // Comprobar si hay un usuario logueado
        $this->checkLogin();

        // Comprobar si el usuario tiene permisos
        $this->checkPermissions($GLOBALS['libro']['main']);

        // Creo un token CSRF
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));

        // Compruebo si hay mensaje de éxito
        if (isset($_SESSION['mensaje'])) {

            // Creo la propiedad mensaje en la vista
            $this->view->mensaje = $_SESSION['mensaje'];

            // Elimino la variable de sesión mensaje
            unset($_SESSION['mensaje']);
        }

        // Compruebo si hay mensaje_error 
        if (isset($_SESSION['mensaje_error'])) {

            // Creo la propiedad mensaje_error en la vista
            $this->view->mensaje_error = $_SESSION['mensaje_error'];

            // Elimino la variable de sesión mensaje_error
            unset($_SESSION['mensaje_error']);
        }

        // Compruebo mensaje error
        if (isset($_SESSION['error'])) {

            // Creo la propiedad mensaje_error en la vista
            $this->view->mensaje_error = $_SESSION['error'];

            // Elimino la variable de sesión error
            unset($_SESSION['error']);
        }

        // Creo la propiedad title de la vista
        $this->view->title = "Gestión de libros";

        //Asigno el valor a una variable
        $this->view->libros = $this->model->get();

        $this->view->render('libro/main/index');
    }

    /*
        Método nuevo()

        Muestra el formulario que permite añadir nuevo libro

        url asociada: /libro/nuevo
    */
    public function nuevo()
    {
        // inicio o continuo la sesión
        session_start();

        // Validar token
        $this->checkTokenCsrf($_SESSION['csrf_token']);

        // Comprobar si hay un usuario logueado
        $this->checkLogin();

        // Comprobar si el usuario tiene permisos
        $this->checkPermissions($GLOBALS['libro']['nuevo']);

        // Creo un token CSRF
        // $_SESSION['csrf_token'] = bin2hex(random_bytes(32));

        // Crear un objeto de la clase libro
        $this->view->libro = new classLibro();

        // Comrpuebo si hay errores en la validación
        if (isset($_SESSION['error'])) {

            // Creo la propiedad error en la vista
            $this->view->error = $_SESSION['error'];

            // Creo la propiedad libro en la vista
            $this->view->libro = $_SESSION['libro'];

            // Creo la propiedad mensaje de error
            $this->view->mensaje_error = 'Error en el formulario';

            // Elimino la variable de sesión error
            unset($_SESSION['error']);

            // Elimino la variable de sesión libro
            unset($_SESSION['libro']);
        }

        // Creo la propiead título
        $this->view->title = "Añadir - Gestión de libros";

        // Creo la propiedad autores en la vista
        $this->view->autores = $this->model->get_autores();

        // Creo la propiedad editoriales en la vista
        $this->view->editoriales = $this->model->get_editoriales();

        // Creo la propiedad generos en la vista
        $this->view->generos = $this->model->get_generos();

        // Cargo la vista asociada a este método
        $this->view->render('libro/nuevo/index');
    }

    /*
        Método create()

        Permite añadir nuevo libro al formulario

        url asociada: /libro/create
        POST: detalles del libro
    */
    public function create()
    {
        // inicio o continuo la sesión
        session_start();

        // Validar token
        $this->checkTokenCsrf($_SESSION['csrf_token']);

        // Comprobar si hay un usuario logueado
        $this->checkLogin();

        // Comprobar si el usuario tiene permisos
        $this->checkPermissions($GLOBALS['libro']['nuevo']);

        // Recogemos los detalles del formulario
        $titulo = filter_var($_POST['titulo'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $autor = filter_var($_POST['autor'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $editorial = filter_var($_POST['editorial'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $precio = filter_var($_POST['precio'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $unidades = filter_var($_POST['unidades'] ??= '', FILTER_SANITIZE_NUMBER_INT);
        $fecha_edicion = filter_var($_POST['fecha_edicion'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $isbn = filter_var($_POST['isbn'] ??= '', FILTER_SANITIZE_NUMBER_INT);
        $generos = $_POST['generos'];

        // Creamos un objeto de la clase libro
        $libro = new classLibro(
            null,
            $titulo,
            $autor,
            $editorial,
            $precio,
            $unidades,
            $fecha_edicion,
            $isbn,
            $generos
        );

        // Validación de los datos

        //Validacion del titulo
        //Reglas: Obligatorio
        if (empty($titulo)) {
            $error['titulo'] = 'El título es obligatorio';
        }

        //Validacion del autor
        //Reglas: Validación Clave Ajena: Obligatorio, Numérico, id de autor existe en la tabla autores.
        if (empty($autor)) {
            $error['autor'] = 'El autor es obligatorio';
        } elseif (!$this->model->validateForeignKeyAutor($autor)) {
            $error['autor'] = 'El autor no existe';
        }

        //Validacion del editorial
        //Reglas: Validación Clave Ajena. Idem
        if (empty($editorial)) {
            $error['editorial'] = 'La editorial es obligatoria';
        } elseif (!filter_var($editorial, FILTER_VALIDATE_INT)) {
            $error['editorial'] = 'El formato de la editorial no es correcto';
        } elseif (!$this->model->validateForeignKeyEditorial($editorial)) {
            $error['editorial'] = 'La editorial no existe';
        }


        //Validacion del precio
        //Reglas: Valor obligatorio.
        if (empty($precio)) {
            $error['precio'] = 'El precio es obligatorio';
        } elseif (!is_numeric($precio)) {
            $error['precio'] = 'El precio debe ser un número';
        }

        //Validacion de las unidades
        //Reglas: Opcional
        if (!empty($unidades) && !is_numeric($unidades)) {
            $error['unidades'] = 'Las unidades deben ser un número';
        }

        //Validacion de la fecha de edición
        //Reglas: Obligatorio, Formato de fecha
        if (empty($fecha_edicion)) {
            $error['fecha_edicion'] = 'La fecha de edición es obligatoria';
        } else {
            $fecha = DateTime::createFromFormat('Y-m-d', $fecha_edicion);
            if (!$fecha) {
                $error['fechaNac'] = 'El formato de la fecha de edición no es correcto';
            }
        }

        //Validacion del ISBN
        //Reglas: Obligatorio, formato isbn (13 dígitos numéricos), Valor único

        $options = [
            'options' => [
                'regexp' => '/^\d{13}$/'
            ]
        ];

        if (empty($isbn)) {
            $error['isbn'] = 'El isbn es obligatorio';

        } elseif (!filter_var($isbn, FILTER_VALIDATE_REGEXP, $options)) {
            $error['isbn'] = 'El ISBN debe tener exactamente 13 dígitos';

        } elseif (!$this->model->validateUniqueISBN($isbn)) {
            $error['isbn'] = 'El ISBN ya existe';

        }


        //Validacion de los géneros
        //Reglas: Obligatorio (tengo que elegir al menos 1), valores numéricos, valores existentes en la tabla géneros.
        if (empty($generos)) {
            $error['generos'] = 'El género es obligatorio';
        } else if (!is_array($generos)) {
            $error['generos'] = 'El género no tiene el formato correcto';
        } else if (count($generos) < 1) {
            $error['generos'] = 'Tienes que elegir al menos un género';
        } else {
            foreach ($generos as $genero) {
                if (!filter_var($genero, FILTER_VALIDATE_INT)) {
                    $error['generos'] = 'El género no tiene el formato correcto';
                } else if (!$this->model->validateForeignKeyGenero($genero)) {
                    $error['generos'] = 'El género no existe';
                }
            }
        }

        // Si hay errores
        if (!empty($error)) {

            // Formulario no ha sido validado
            // Tengo que redireccionar al formulario de nuevo

            // Creo la variable de sessión libro con los datos del formulario
            $_SESSION['libro'] = $libro;

            // Creo la variable de sessión error con los errores
            $_SESSION['error'] = $error;

            // redireciona al formulario de nuevo
            header('location:' . URL . 'libro/nuevo');
            exit();
        }



        // Añadimos libro a la tabla
        $this->model->create($libro);

        // Genero mensaje de éxito
        $_SESSION['mensaje'] = 'Libro añadido con éxito';

        // redireciona al main de libro
        header('location:' . URL . 'libro');
        exit();
    }

    /*
        Método editar()

        Muestra el formulario que permite editar los detalles de un libro

        url asociada: /libro/editar/id

        @param int $id: id del libro a editar

    */
    function editar($param = [])
    {
        // inicio o continuo la sesión
        session_start();

        // Validar token
        $this->checkTokenCsrf($param[1]);

        // Comprobar si hay un usuario logueado
        $this->checkLogin();

        // Comprobar si el usuario tiene permisos
        $this->checkPermissions($GLOBALS['libro']['editar']);

        # asigno id a una propiedad de la vista
        $this->view->id = htmlspecialchars($param[0]);

        // Comrpuebo si hay errores en la validación
        if (isset($_SESSION['error'])) {

            // Creo la propiedad error en la vista
            $this->view->error = $_SESSION['error'];

            // Creo la propiedad libro en la vista
            $this->view->libro = $_SESSION['libro'];

            // Creo la propiedad mensaje de error
            $this->view->mensaje_error = 'Error en el formulario';

            // Elimino la variable de sesión error
            unset($_SESSION['error']);

            // Elimino la variable de sesión libro
            unset($_SESSION['libro']);
        }

        # title
        $this->view->title = "Formulario Editar - Gestión de libros";

        # obtener objeto de la clase libro con el id pasado
        // Necesito crear el método read en el modelo
        $this->view->libro = $this->model->read($this->view->id);

        // Creo la propiedad autores en la vista
        $this->view->autores = $this->model->get_autores();

        // Creo la propiedad editoriales en la vista
        $this->view->editoriales = $this->model->get_editoriales();

        // Creo la propiedad generos en la vista
        $this->view->generos = $this->model->get_generos();

        # cargo la vista
        $this->view->render('libro/editar/index');
    }

    /*
        Método update()

        Actualiza los detalles de un libro

        url asociada: /libro/update/id

        POST: detalles del libro

        @param int $id: id del libro a editar
    */
    public function update($param = [])
    {

        // inicio o continuo la sesión
        session_start();

        // Validar token
        $this->checkTokenCsrf($_SESSION['csrf_token']);

        // Comprobar si hay un usuario logueado
        $this->checkLogin();

        // Comprobar si el usuario tiene permisos
        $this->checkPermissions($GLOBALS['libro']['editar']);

        // obtengo el id del libro que voy a editar
        $id = htmlspecialchars($param[0]);

        // Recogemos los detalles del formulario
        $titulo = filter_var($_POST['titulo'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $autor = filter_var($_POST['autor'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $editorial = filter_var($_POST['editorial'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $precio = filter_var($_POST['precio'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $unidades = filter_var($_POST['unidades'] ??= '', FILTER_SANITIZE_NUMBER_INT);
        $fecha_edicion = filter_var($_POST['fecha_edicion'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $isbn = filter_var($_POST['isbn'] ??= '', FILTER_SANITIZE_NUMBER_INT);
        $generos = $_POST['generos'];

        # Con los detalles formulario creo objeto libro

        $libro_form = new classLibro(
            null,
            $titulo,
            $autor,
            $editorial,
            $precio,
            $unidades,
            $fecha_edicion,
            $isbn,
            $generos
        );

        // Obtengo los detalles del libro de la base de datos
        $libro = $this->model->read($id);

        // Control de cambios en los campos
        $cambios = false;
        $cambio = "";

        // Validación de los datos

        //Validacion del titulo
        //Reglas: Obligatorio
        if (strcmp($titulo, $libro->titulo) != 0) {
            $cambios = true;
            if (empty($titulo)) {
                $error['titulo'] = 'El título es obligatorio';
            }
        }

        //Validacion del autor
        //Reglas: Validación Clave Ajena: Obligatorio, Numérico, id de autor existe en la tabla autores.
        if (strcmp($autor, $libro->autor_id) != 0) {
            $cambios = true;
            if (empty($autor)) {
                $error['autor'] = 'El autor es obligatorio';
            } elseif (!$this->model->validateForeignKeyAutor($autor)) {
                $error['autor'] = 'El autor no existe';
            }
        }

        //Validacion del editorial
        //Reglas: Validación Clave Ajena. Idem
        if (strcmp($editorial, $libro->editorial_id) != 0) {
            $cambios = true;
            if (empty($editorial)) {
                $error['editorial'] = 'La editorial es obligatoria';
            } elseif (!filter_var($editorial, FILTER_VALIDATE_INT)) {
                $error['editorial'] = 'El formato de la editorial no es correcto';
            } elseif (!$this->model->validateForeignKeyEditorial($editorial)) {
                $error['editorial'] = 'La editorial no existe';
            }
        }


        //Validacion del precio
        //Reglas: Valor obligatorio.
        if (strcmp($precio, $libro->precio) != 0) {
            $cambios = true;
            if (empty($precio)) {
                $error['precio'] = 'El precio es obligatorio';
            } elseif (!is_numeric($precio)) {
                $error['precio'] = 'El precio debe ser un número';
            }
        }

        //Validacion de las unidades
        //Reglas: Opcional
        if (strcmp($unidades, $libro->stock) != 0) {
            $cambios = true;
            if (!empty($unidades) && !is_numeric($unidades)) {
                $error['unidades'] = 'Las unidades deben ser un número';
            }
        }

        //Validacion de la fecha de edición
        //Reglas: Obligatorio, Formato de fecha
        if (strcmp($fecha_edicion, $libro->fecha_edicion) != 0) {
            $cambios = true;
            if (empty($fecha_edicion)) {
                $error['fecha_edicion'] = 'La fecha de edición es obligatoria';
            } else {
                $fecha = DateTime::createFromFormat('Y-m-d', $fecha_edicion);
                if (!$fecha) {
                    $error['fecha_edicion'] = 'El formato de la fecha de edición no es correcto';
                }
            }
        }

        //Validacion del ISBN
        //Reglas: Obligatorio, formato isbn (13 dígitos numéricos), Valor único

        $options = [
            'options' => [
                'regexp' => '/^\d{13}$/'
            ]
        ];

        if (strcmp($isbn, $libro->isbn) != 0) {
            $cambios = true;
            if (empty($isbn)) {
                $error['isbn'] = 'El isbn es obligatorio';

            } elseif (!filter_var($isbn, FILTER_VALIDATE_REGEXP, $options)) {
                $error['isbn'] = 'El ISBN debe tener exactamente 13 dígitos';

            } elseif (!$this->model->validateUniqueISBN($isbn)) {
                $error['isbn'] = 'El ISBN ya existe';

            }
        }


        //Validacion de los géneros
        //Reglas: Obligatorio (tengo que elegir al menos 1), valores numéricos, valores existentes en la tabla géneros.

        $generos_str = implode(',', $generos);

        if (strcmp($generos_str, $libro->generos_id) != 0) {
            $cambios = true;
            if (empty($generos)) {
                $error['generos'] = 'El género es obligatorio';
            } else if (!is_array($generos)) {
                $error['generos'] = 'El género no tiene el formato correcto';
            } else if (count($generos) < 1) {
                $error['generos'] = 'Tienes que elegir al menos un género';
            } else {
                foreach ($generos as $genero) {
                    if (!filter_var($genero, FILTER_VALIDATE_INT)) {
                        $error['generos'] = 'El género no tiene el formato correcto';
                    } else if (!$this->model->validateForeignKeyGenero($genero)) {
                        $error['generos'] = 'El género no existe';
                    }
                }
            }
        }

        // Si hay errores
        if (!empty($error)) {

            // Formulario no ha sido validado
            // Tengo que redireccionar al formulario de nuevo

            // Creo la variable de sessión libro con los datos del formulario
            $_SESSION['libro'] = $libro;

            // Creo la variable de sessión error con los errores
            $_SESSION['error'] = $error;

            // redireciona al formulario de nuevo
            header('location:' . URL . 'libro/editar/' . $id . '/' . $_SESSION['csrf_token']);
            exit();
        }

        // Compruebo si ha habido cambios
        if (!$cambios) {
            // Genero mensaje de éxito
            $_SESSION['mensaje'] = 'No se han realizado cambios';

            // redireciona al main de libro
            header('location:' . URL . 'libro');
            exit();
        }

        # Actualizo base  de datos
        // Necesito crear el método update en el modelo
        $this->model->update($libro_form, $id);

        // Genero mensaje de éxito
        $_SESSION['mensaje'] = 'Libro actualizado con éxito';

        # Cargo el controlador principal de libro
        header('location:' . URL . 'libro');
    }

    /*
        Método eliminar()

        Borra un libro de la base de datos

        url asociada: /libro/eliminar/id

        @param
            :int $id: id del libro a eliminar
    */
    public function eliminar($param = [])
    {

        // inicio o continuo la sesión
        session_start();

        // Validar token
        $this->checkTokenCsrf($param[1]);

        // Comprobar si hay un usuario logueado
        $this->checkLogin();

        // Comprobar si el usuario tiene permisos
        $this->checkPermissions($GLOBALS['libro']['eliminar']);

        // obtengo el id del libro que voy a eliminar
        $id = htmlspecialchars($param[0]);

        // Validar id del libro
        // validateIdLibro($id) si existe devuelve TRUE
        if (!$this->model->validateIdLibro($id)) {
            // Genero mensaje de error
            $_SESSION['error'] = 'ID no válido';

            //Genero mensaje de exito
            $_SESSION['mensaje'] = 'Libro eliminado con éxito';

            // redireciona al main de libro
            header('location:' . URL . 'libro');
            exit();
        }

        # Elimino libro de la base de datos
        // Necesito crear el método delete en el modelo
        $this->model->delete($id);

        // Genero mensaje de éxito
        $_SESSION['mensaje'] = 'Libro eliminado con éxito';

        # Cargo el controlador principal de libro
        header('location:' . URL . 'libro');
    }

    /*
        Método mostrar()

        Muestra los detalles de un libro

        url asociada: /libro/mostrar/id

        @param
            :int $id: id del libro a mostrar
    */
    public function mostrar($param = [])
    {

        // inicio o continuo la sesión
        session_start();

        // Validar token
        $this->checkTokenCsrf($param[1]);

        // Comprobar si hay un usuario logueado
        $this->checkLogin();

        // Comprobar si el usuario tiene permisos
        $this->checkPermissions($GLOBALS['libro']['mostrar']);

        // obtengo el id del libro que voy a eliminar
        $id = htmlspecialchars($param[0]);


        // Validar id del libro
        // validateIdLibro($id) si existe devuelve TRUE
        if (!$this->model->validateIdLibro($id)) {
            // Genero mensaje de error
            $_SESSION['error'] = 'ID no válido';

            // redireciona al main de libro
            header('location:' . URL . 'libro');
            exit();
        }


        # Cargo el título
        $this->view->title = "Mostrar - Gestión de libros";

        # Obtengo los detalles del libro mediante el método read del modelo
        $this->view->libro = $this->model->read($id);

        # Cargo la vista
        $this->view->render('libro/mostrar/index');
    }

    /*
        Método filtrar()

        Busca un libro en la base de datos

        url asociada: /libro/filtrar/expresion

        GET: 
            - expresion de búsqueda

        DEVUELVE:
            - PDOStatement con los libros que coinciden con la expresión de búsqueda
    */
    public function filtrar()
    {

        // inicio o continuo la sesión
        session_start();

        // Validar token
        $this->checkTokenCsrf($_SESSION['csrf_token']);

        // Comprobar si hay un usuario logueado
        $this->checkLogin();

        // Comprobar si el usuario tiene permisos
        $this->checkPermissions($GLOBALS['libro']['filtrar']);


        # Obtengo la expresión de búsqueda
        $expresion = htmlspecialchars($_GET['expresion']);

        # Cargo el título
        $this->view->title = "Filtrar por: {$expresion} - Gestión de libros";

        //Asigno el valor a una variable
        $this->view->libros = $this->model->filter($expresion);

        # Cargo la vista
        $this->view->render('libro/main/index');
    }

    /*
        Método ordenar()

        Ordena los libros de la base de datos

        url asociada: /libro/ordenar/id

        @param
            :int $id: id del campo por el que se ordenarán los libros
    */
    public function ordenar($param = [])
    {

        // inicio o continuo la sesión
        session_start();

        // Validar token
        $this->checkTokenCsrf($param[1]);

        // Comprobar si hay un usuario logueado
        $this->checkLogin();

        // Comprobar si el usuario tiene permisos
        $this->checkPermissions($GLOBALS['libro']['ordenar']);

        // Obtener criterio
        $id = (int) htmlspecialchars($param[0]);

        # Criterios de ordenación
        $criterios = [
            1 => 'Id',
            2 => 'Título',
            3 => 'Autor',
            4 => 'Editorial',
            5 => 'Generos',
            6 => 'Stock',
            7 => 'Precio'
        ];

        # Cargo el título
        $this->view->title = "Ordenar por {$criterios[$id]} - Gestión de libros";

        //Asigno el valor a una variable
        $this->view->libros = $this->model->order($id);

        # Cargo la vista
        $this->view->render('libro/main/index');
    }


    /*
        Método exportar()

        Permite exportar los libros a un archivo CSV

        url asociada: /libro/exportar/csv

        @param
            :string $format: formato de exportación
    */
    public function exportar($param = [])
    {
        // inicio o continuo la sesión
        session_start();

        // Validar token
        $this->checkTokenCsrf($param[1]);

        // Comprobar si hay un usuario logueado
        $this->checkLogin();

        // Comprobar si el usuario tiene permisos
        $this->checkPermissions($GLOBALS['libro']['exportar']);

        // Obtener formato
        // en nuestro caso no haría falta puesto que solo tenemos disponible csv
        $formato = $param[0];

        // Obtener libros
        $libros = $this->model->get_csv();

        // Crear archivo CSV
        $file = 'libros.csv';

        // Limpiar buffer antes de enviar headers
        if (ob_get_length())
            ob_clean();

        // Enviamos las cabeceras al navegador para empezar a descargar el archivo
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=' . $file);
        header('Pragma: no-cache');
        header('Expires: 0');

        // Abrimos el archivo csv, con permisos de escritura
        $fichero = fopen('php://output', 'w');

        // Escribir BOM UTF-8 para compatibilidad con Excel
        fprintf($fichero, chr(0xEF) . chr(0xBB) . chr(0xBF));

        // Escribimos los datos del fichero csv
        foreach ($libros as $libro) {
            fputcsv($fichero, $libro, ';');
        }
        // Cerramos el fichero
        fclose($fichero);

        // Cerramos el buffer de salida y enviamos al cliente el archivo csv
        ob_end_flush();
        exit;
    }

    /*
        Método importar()

        Permite importar los libros desde un archivo CSV

        url asociada: /libro/importar/csv

        @param
            :string $format: formato de importación
    */
    public function importar($param = [])
    {
        // inicio o continuo la sesión
        session_start();

        // Validar token
        $this->checkTokenCsrf($param[1]);

        // Comprobar si hay un usuario logueado
        $this->checkLogin();

        // Comprobar si el usuario tiene permisos
        $this->checkPermissions($GLOBALS['libro']['importar']);

        // Comrpuebo si hay errores en la validación
        if (isset($_SESSION['mensaje_error'])) {

            // Creo la propiedad mensaje de error
            $this->view->mensaje_error = $_SESSION['mensaje_error'];

            // Elimino la variable de sesión error
            unset($_SESSION['mensaje_error']);
        }

        // Generar propiedad title
        $this->view->title = "Importar libros desde fichero CSV";

        // Cargar la vista
        $this->view->render('libro/importar/index');
    }

    public function validar($param = [])
    {
        // inicio o continuo la sesión
        session_start();

        // Validar token
        $this->checkTokenCsrf($_POST['csrf_token']);

        // Comprobar si hay un usuario logueado
        $this->checkLogin();

        // Comprobar si el usuario tiene permisos
        $this->checkPermissions($GLOBALS['libro']['importar']);

        // Comprobar si se ha subido un archivo
        if (!isset($_FILES['file'])) {
            $_SESSION['mensaje_error'] = 'No se ha subido ningún archivo';
            header('location:' . URL . 'libro/importar/csv/' . $_POST['csrf_token']);
            exit();
        }

        // Comprobar si el archivo se ha subido correctamente
        if ($_FILES['file']['error'] !== UPLOAD_ERR_OK) {
            $_SESSION['mensaje_error'] = 'Error al subir el archivo';
            header('location:' . URL . 'libro/importar/csv/' . $_POST['csrf_token']);
            exit();
        }

        // Verificar la extensión del archivo
        $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        if ($extension !== 'csv') {
            $_SESSION['mensaje_error'] = "El archivo debe tener extensión .csv";
            header('location:' . URL . 'libro/importar/csv/' . $_POST['csrf_token']);
            exit;
        }

        // Comprobar si el archivo es válido
        $file = $_FILES['file']['tmp_name'];

        // Abrir el archivo
        $fichero = fopen($file, 'r');

        // Leer el archivo
        $libros = [];

        // Contador de lineas
        $contador_linea = 1;

        while (($linea = fgetcsv($fichero, 0, ';')) !== FALSE) {
            $libros[] = $linea;

            #1: Título</p>
            #2: Precio</p>
            #3: Stock</p>
            #4: Fecha de edición</p>
            #5: ISBN</p>
            #6: Id del autor</p>
            #7: Id de la editorial</p>
            #8: Id géneros</p>

            // Validar titulo
            if (empty($linea[0])) {
                $_SESSION['mensaje_error'] = 'Línea ' . $contador_linea . ': El título no puede ser nulo';
                header('location:' . URL . 'libro/importar/csv/' . $_POST['csrf_token']);
                exit();
            }

            // Validar isbn
            $options = [
                'options' => [
                    'regexp' => '/^\d{13}$/'
                ]
            ];

            if (empty($linea[4])) {
                $_SESSION['mensaje_error'] = 'Línea ' . $contador_linea . ': El isbn no puede ser nulo';
                header('location:' . URL . 'libro/importar/csv/' . $_POST['csrf_token']);
                exit();
            } elseif (!filter_var($linea[4], FILTER_VALIDATE_REGEXP, $options)) {
                $_SESSION['mensaje_error'] = 'Línea ' . $contador_linea . ': El ISBN debe tener exactamente 13 dígitos';
                header('location:' . URL . 'libro/importar/csv/' . $_POST['csrf_token']);
                exit();

            } elseif (!$this->model->validateUniqueISBN($linea[4])) {
                $_SESSION['mensaje_error'] = 'Línea ' . $contador_linea . ': El ISBN ya existe';
                header('location:' . URL . 'libro/importar/csv/' . $_POST['csrf_token']);
                exit();

            }

            // Validar autor_id
            if (empty($linea[5])) {
                $_SESSION['mensaje_error'] = 'Línea ' . $contador_linea . ': El id del autor no puede ser nulo';
                header('location:' . URL . 'libro/importar/csv/' . $_POST['csrf_token']);
                exit();
            } elseif (!$this->model->validateForeignKeyAutor($linea[5])) {
                $_SESSION['mensaje_error'] = 'Línea ' . $contador_linea . ': El id del autor no existe';
                header('location:' . URL . 'libro/importar/csv/' . $_POST['csrf_token']);
                exit();
            }

            // Validar editorial_id
            if (empty($linea[6])) {
                $_SESSION['mensaje_error'] = 'Línea ' . $contador_linea . ': El id de la editorial no puede ser nulo';
                header('location:' . URL . 'libro/importar/csv/' . $_POST['csrf_token']);
                exit();
            }elseif (!$this->model->validateForeignKeyEditorial($linea[6])) {
                $_SESSION['mensaje_error'] = 'Línea ' . $contador_linea . ': El id de la editorial no existe';
                header('location:' . URL . 'libro/importar/csv/' . $_POST['csrf_token']);
                exit();
            }

            // Validar generos_id
            if (empty($linea[7])) {
                $_SESSION['mensaje_error'] = 'Línea ' . $contador_linea . ': El id_generos no puede ser nulo';
                header('location:' . URL . 'libro/importar/csv/' . $_POST['csrf_token']);
                exit();
            }else{
                $generos = explode(',', $linea[7]);
                foreach ($generos as $genero) {
                    if (!$this->model->validateForeignKeyGenero($genero)) {
                        $_SESSION['mensaje_error'] = 'Línea ' . $contador_linea . ': El id_generos '. $genero .' no existe';
                        header('location:' . URL . 'libro/importar/csv/' . $_POST['csrf_token']);
                        exit();
                    }
                }
            }

        }

        // Cerrar el archivo
        fclose($fichero);

        // Importar los libros
        $count = $this->model->import($libros);

        // Genero mensaje de éxito
        $_SESSION['mensaje'] = $count . ' libros importados con éxito';

        // redireciona al main de libro
        header('location:' . URL . 'libro');
        exit();
    }

    /*
        Método pdf()

        Permite exportar los libros a un archivo PDF

        url asociada: /libro/pdf

        @param
            :string $format: formato de exportación
    */

    public function pdf($param = [])
    {
        // Incluimos la librería fpdf
        require('extensions/fpdf186/fpdf_utf8.php');
        // Incluimos la clase pdf_alumnos
        require('class/pdf_libros.php');

        // inicio o continuo la sesión
        session_start();

        // Validar token
        $this->checkTokenCsrf($param[0]);

        // Comprobar si hay un usuario logueado
        $this->checkLogin();

        // Comprobar si el usuario tiene permisos
        $this->checkPermissions($GLOBALS['libro']['pdf']);

        // creo objeto pdf_libros
        $pdf = new Pdf_libros('P', 'mm', 'A4');

        // Imprimir nombre de página actual
        $pdf->AliasNbPages();

        // Añadir página
        $pdf->AddPage();

        // Añadimo el titulo
        $pdf->titulo();

        // cabecera del listado
        $pdf->cabecera();

        // Cuerpo del listado
        $pdf->SetFont('Courier', '', 8);

        // Fondo pautado para las líneas pares
        $pdf->SetFillColor(245, 222, 179);

        $fondo = false;

        // Obtener libros
        $libros = $this->model->get();

        // escribimo los datos de los libros
        foreach ($libros as $libro) {
            $pdf->Cell(10, 10, mb_convert_encoding($libro->id, 'ISO-8859-1', 'UTF-8'), 'B,T', 0, 'C', $fondo);
            $pdf->Cell(57, 10, mb_convert_encoding($libro->titulo, 'ISO-8859-1', 'UTF-8'), 'B,T', 0, 'L', $fondo);
            $pdf->Cell(45, 10, mb_convert_encoding($libro->autor, 'ISO-8859-1', 'UTF-8'), 'B,T', 0, 'L', $fondo);
            $pdf->Cell(52, 10, mb_convert_encoding($libro->editorial, 'ISO-8859-1', 'UTF-8'), 'B,T', 0, 'L', $fondo);
            $pdf->Cell(12, 10, mb_convert_encoding($libro->stock, 'ISO-8859-1', 'UTF-8'), 'B,T', 0, 'C', $fondo);
            $pdf->Cell(14, 10, mb_convert_encoding(number_format($libro->precio, 2, ',', '.'), 'ISO-8859-1', 'UTF-8'), 'B,T', 1, 'R', $fondo);
            $fondo = !$fondo;
        }

        // Cerramos pdf
        $pdf->Output('I', 'libros.pdf', true);
    }
}




