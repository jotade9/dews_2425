<?php

class Auth extends Controller
{

    function __construct()
    {

        parent::__construct();
    }

    /*
        Método principal

        Carga el formulario de autenticación
        url: /auth

        Detalles:

            - email
            - password   

    */
    public function login()
    {
        // inicio o continuo la sesión
        session_start();

        // Creo un token CSRF
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));

        // Inicializo los campos del formulario
        $this->view->email = null;
        $this->view->password = null;

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
            $this->view->mensaje_error ='Error en el formulario de autenticación';

            // Creo la propiedad error en la vista
            $this->view->error = $_SESSION['error'];

            // Retroalimento los campos del  formulario
            $this->view->email = $_SESSION['email'];
            $this->view->password = $_SESSION['password'];

            // Elimino la variable de sesión error
            unset($_SESSION['error']);

            // Elimino la variable de sesión email
            unset($_SESSION['email']);
            unset($_SESSION['password']);
        }

        // Creo la propiedad title de la vista
        $this->view->title = "Autenticación de Usuarios";

        // Cargo la vista login
        $this->view->render('auth/login/index');
    }

    /*
        Método register()

        Autoregistro de un usuario

            - name
            - email
            - password

        url asociada: /auth/register
    */
    public function register()
    {
        // inicio o continuo la sesión
        session_start();

        // Creo un token CSRF
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));

        // Inicializo los campos del formulario
        $this->view->name = null;
        $this->view->email = null;
        $this->view->password = null;

        // Comrpuebo si hay errores en la validación
        if (isset($_SESSION['error'])) {

            // Creo la propiedad error en la vista
            $this->view->error = $_SESSION['error'];

            // Retroalimento los campos del  formulario
            $this->view->name = $_SESSION['name'];
            $this->view->email = $_SESSION['email'];
            $this->view->password = $_SESSION['password'];

            // Creo la propiedad mensaje de error
            $this->view->mensaje_error = 'Error en el registro de usuario';

            // Elimino la variable de sesión error
            unset($_SESSION['error']);

            // Elimino la variable de sesión alumno
            unset($_SESSION['name']);
            unset($_SESSION['email']);
            unset($_SESSION['password']);
        }

        // Creo la propiead título
        $this->view->title = "Registro de Usuarios";

        // Cargo la vista Registro de usuarios
        $this->view->render('auth/register/index');
    }

    /*
        Método validate_regiser()

        Permite:
            - Validar nuevo usuario
            - En caso de error de validación. Retroalimenta el formulario y muestra errores
            - En caso de validación. Añade usuario con perfil de registrado

        url asociada: /auth/validate_register()
        
        POST: detalles del nuevo usuario

            - name
            - email
            - password
            - password-confirm
    */
    public function validate_register()
    {

        // inicio o continuo la sesión
        session_start();

        // Validación toekn CSRF
        if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
            // require_once 'controllers/error.php';
            // $controller = new Errores('Petición no válida');
            // exit();
            header('location:' . URL . 'errores');
            exit();
        }

        // Recogemos los detalles del formulario saneados
        // Prevenir ataques XSS
        $name = filter_var($_POST['name'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_var($_POST['email'] ??= '', FILTER_SANITIZE_EMAIL);
        $password = filter_var($_POST['password'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $password_confirm = filter_var($_POST['password_confirm'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);

        // Validación del formulario de registro

        // Creo un array para almacenar los errores
        $error = [];

        // Validación name
        // Reglas: obligatorio, longitud mínima 5 caracteres, longitud máxima 20 caracteres, clave secundaria
        if (empty($name)) {
            $error['name'] = 'El nombre es obligatorio';
        }else if (strlen($name) < 5) {
            $error['name'] = 'El nombre debe tener al menos 5 caracteres';
        } else if (strlen($name) > 20) {
            $error['name'] = 'El nombre no puede tener más de 20 caracteres';
        }else if (!$this->model->validateUniqueName($name)){
            $error['name'] = 'El nombre ya existe';
        }

        // Validación del email
        // Reglas: obligatorio, formato email y clave secundaria        
        if (empty($email)) {
            $error['email'] = 'El email es obligatorio';
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error['email'] = 'El formato del email no es correcto';
        } else if (!$this->model->validateUniqueEmail($email))
        {
            $error['email'] = 'El email ya existe';
        }

        // Validación de la contraseña
        // Reglas: obligatorio, longitud mínima 7 caracteres, campos coincidentes
        if (empty($password)) {
            $error['password'] = 'La contraseña es obligatoria';
        } else if (strlen($password) < 7) {
            $error['password'] = 'La contraseña debe tener al menos 7 caracteres';
        } else if (strcmp($password , $password_confirm) !== 0) {
            $error['password'] = 'Las contraseñas no coinciden';
        }

        // Si hay errores
        if (!empty($error)) {
            
            // Formulario no ha sido validado
            // Tengo que redireccionar al formulario de nuevo

            // Creo la variable de sessión name con los datos del formulario
            $_SESSION['name'] = $name;

            // Creo la variable de sessión email con los datos del formulario
            $_SESSION['email'] = $email;

            // Creo la variable de sessión password con los datos del formulario
            $_SESSION['password'] = $password;

            // Creo la variable de sessión error con los errores
            $_SESSION['error'] = $error;

            // redireciona al formulario de nuevo
            header('location:' . URL . 'auth/register');
            exit();
        }

        // Formulario validado
        // Creo un objeto de la clase User con los detalles del formulario
        $id = $this->model->create($name, $email, $password);

        // Asigno el perfil de registrado al usuario
        $this->model->assignRole($id, 3);

        // Genero mensaje de éxito
        $_SESSION['mensaje'] = 'Usuario registrado con éxito';

        // redireciona al formulario de login
        header('location:' . URL . 'auth/login');
        exit();
    }


    /*
        Método validate_login()

        Permite:
            - Validar usuario
            - En caso de error de validación. Retroalimenta el formulario y muestra errores
            - En caso de validación. Inicia sesión

        url asociada: /auth/validate()
        
        POST: detalles del usuario

            - email
            - password
    */
    public function validate_login()
    {

        // inicio o continuo la sesión
        session_start();

        // Validación toekn CSRF
        if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
            // require_once 'controllers/error.php';
            // $controller = new Errores('Petición no válida');
            // exit();
            header('location:' . URL . 'errores');
            exit();
        }

        // Recogemos los detalles del formulario saneados
        // Prevenir ataques XSS
        $email = filter_var($_POST['email'] ??= '', FILTER_SANITIZE_EMAIL);
        $password = filter_var($_POST['password'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);

        // Validación del formulario de login

        // Creo un array para almacenar los errores
        $error = [];

        // Validación del email
        // Reglas: obligatorio, formato email y clave secundaria        
        if (empty($email)) {
            $error['email'] = 'El email es obligatorio';
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error['email'] = 'El formato del email no es correcto';
        }

        //Obtengo el usuario
        $user = $this->model->getUserEmail($email);

        // Si el usuario no existe
        if (!$user) {
            $error['email'] = 'El email no existe';
        }

        // Validación de la contraseña
        // Reglas: obligatorio, longitud mínima 7 caracteres
        if (empty($password)) {
            $error['password'] = 'La contraseña es obligatoria';
        } else if (strlen($password) < 7) {
            $error['password'] = 'La contraseña debe tener al menos 7 caracteres';
        } else if (!password_verify($password, $user->password)) {
            $error['password'] = 'La contraseña no es correcta';
        }

        // Si hay errores
        if (!empty($error)) {
            
            // Formulario no ha sido validado
            // Tengo que redireccionar al formulario de nuevo

            // Creo la variable de sessión email con los datos del formulario
            $_SESSION['email'] = $email;

            // Creo la variable de sessión password con los datos del formulario
            $_SESSION['password'] = $password;

            // Creo la variable de sessión error con los errores
            $_SESSION['error'] = $error;

            // redireciona al formulario de nuevo
            header('location:' . URL . 'auth/login');
            exit();
        }

        // Formulario validado

        // Creo la variable de sessión user con los datos del usuario
        $_SESSION['id'] = $user->id;
        $_SESSION['name'] = $user->name;

        // Datos del rol del usuario
        $_SESSION['rol_id'] = $this->model->getIdPerfilUser($user->id);
        $_SESSION['name_rol'] = $this->model->getNamePerfil($_SESSION['role_id']);


        // Genero mensaje de inicio de sesión
        $_SESSION['mensaje'] = 'Usuario '.$user->name.' ha iniciado sesión';

        //Redirreccion al panel de control
        header('location:' . URL . 'alumno');
        exit();
    }



}
