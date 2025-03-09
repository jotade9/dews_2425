<?php
class autor extends controllers
{
    function __construct()
    {
        parent::__construct();
    }
    /**
     * Método checkLogin()
     * 
     * Permite checkear si el usuario está logueado, si no está logueado redirecciona al login
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
            header('location:' . URL . 'autor');
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

        url: /autor
    */
    function render()
    {
        // inicio o continuo la sesión
        session_start();


        // Comprobar si hay un usuario logueado
        $this->checkLogin();

        // Comprobar si el usuario tiene permisos
        $this->checkPermissions($GLOBALS['autor']['main']);

        // Comprobar si hay un usuario logueado
        if (!isset($_SESSION['user_id'])) {

            // Genero mensaje de error
            $_SESSION['mensaje'] = 'Acceso denegado';

            // redireciona al login
            header('location:' . URL . 'auth/login');
            exit();
        } // Comprobar si el usario tiene permisos
        else if (!in_array($_SESSION['role_id'], $GLOBALS['autor']['main'])) {

            // Genero mensaje de error
            $_SESSION['mensaje'] = 'Acceso denegado. No tiene permisos suficientes.';

            // redireciona al login
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

        // Compruebo mensaje error
        if (isset($_SESSION['error'])) {

            // Creo la propiedad mensaje_error en la vista
            $this->view->mensaje_error = $_SESSION['error'];

            // Elimino la variable de sesión error
            unset($_SESSION['error']);
        }

        // Creo la propiedad title de la vista
        $this->view->title = "Gestión de autores";

        //Asigno el valor a una variable
        $this->view->autores = $this->model->get();

        $this->view->render('autor/main/index');
    }
    /**
     * Método nuevo()
     * Muestra el formulario que permite añadir nuevo autor
     * 
     * url asociada: /autor/nuevo
     */
    public function nuevo(){
        // inicio o continuo la sesión
        session_start();

        // Comprobar si hay un usuario logueado
        $this->checkLogin();

        // Comprobar si el usuario tiene permisos
        $this->checkPermissions($GLOBALS['autor']['nuevo']);

        // Comprobar si hay un usuario logueado
        if (!isset($_SESSION['user_id'])) {

            // Genero mensaje de error
            $_SESSION['mensaje'] = 'Acceso denegado';

            // redireciona al login
            header('location:' . URL . 'auth/login');
            exit();
        } // Comprobar si el usario tiene permisos
        else if (!in_array($_SESSION['role_id'], $GLOBALS['autor']['nuevo'])) {

            // Genero mensaje de error
            $_SESSION['mensaje'] = 'Acceso denegado. No tiene permisos suficientes.';

            // redireciona al login
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

        // Crear un objeto de la clase autor
        $this->view->autor = new classAutor();

        // Comrpuebo si hay errores en la validación
        if (isset($_SESSION['error'])) {

            // Creo la propiedad error en la vista
            $this->view->error = $_SESSION['error'];

            // Creo la propiedad autor en la vista
            $this->view->autor = $_SESSION['autor'];

            // Creo la propiedad mensaje de error
            $this->view->mensaje_error = 'Error en el formulario';

            // Elimino la variable de sesión error
            unset($_SESSION['error']);

            // Elimino la variable de sesión autor
            unset($_SESSION['autor']);
        }

        // Creo la propiedad title de la vista
        $this->view->title = "Añadir - Gestion de autores";

        //Asigno el valor a una variable
        $this->view->autores = $this->model->get();

        $this->view->render('autor/nuevo/index');

    }

    /*
        Método create()

        Permite añadir nuevo autor al formulario

        url: /autor/create
    */
    

}