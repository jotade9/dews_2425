<?php

class Libro extends Controller
{

    function __construct()
    {

        parent::__construct();
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

        // Creo un token CSRF
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));

        // Compruebo si hay mensaje de éxito
        if (isset($_SESSION['mensaje'])) {

            // Creo la propiedad mensaje en la vista
            $this->view->mensaje = $_SESSION['mensaje'];

            // Elimino la variable de sesión mensaje
            unset($_SESSION['mensaje']);
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

        // Creo un token CSRF
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));

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

        // Validación CSRF
        if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
            die('Petición no válida');
        }

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

        # asigno id a una propiedad de la vista
        $this->view->id = htmlspecialchars($param[0]);

        # obtengo el token CSRF
        $this->view->csrf_token = $param[1];

        // Validación CSRF
        if (!hash_equals($_SESSION['csrf_token'], $this->view->csrf_token)) {
            require_once 'controllers/error.php';
            $controller = new Errores('Petición no válida');
            exit();
        }

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

        // obtengo el id del libro que voy a editar
        $id = htmlspecialchars($param[0]);

        // obtengo el token CSRF
        $csrf_token = $param[1];

        // Validación CSRF
        if (!hash_equals($_SESSION['csrf_token'], $csrf_token)) {
            require_once 'controllers/error.php';
            $controller = new Errores('Petición no válida');
            exit();
        }

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
                    $error['fechaNac'] = 'El formato de la fecha de edición no es correcto';
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
            header('location:' . URL . 'libro/editar/' . $id . '/' . $csrf_token);
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

        // obtengo el id del libro que voy a eliminar
        $id = htmlspecialchars($param[0]);

        // obtengo el token CSRF
        $csrf_token = $param[1];

        // Validación CSRF
        if (!hash_equals($_SESSION['csrf_token'], $csrf_token)) {
            require_once 'controllers/error.php';
            $controller = new Errores('Petición no válida');
            exit();
        }

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

        // obtengo el id del libro que voy a eliminar
        $id = htmlspecialchars($param[0]);

        // obtengo el token CSRF
        $csrf_token = $param[1];

        // Validación CSRF
        if (!hash_equals($_SESSION['csrf_token'], $csrf_token)) {
            require_once 'controllers/error.php';
            $controller = new Errores('Petición no válida');
            exit();
        }

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
}
