<?php

require_once 'class/user.class.php';


class User extends Controller
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

        url: /user
    */
    public function render()
    {
        // inicio o continuo la sesión
        session_start();

        // Comprobar si hay un usuario logueado
        $this->checkLogin();

        // Comprobar si el usuario tiene permisos
        $this->checkPermissions($GLOBALS['user']['main']);

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
        $this->view->title = "Gestión de Usuarios";

        // Creo la propiedad usuarios para usar en la vista
        $this->view->users = $this->model->get();

        $this->view->render('user/main/index');
    }

    /*
        Método nuevo()

        Muestra el formulario que permite añadir nuevo user

        url asociada: /user/nuevo
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
        $this->checkPermissions($GLOBALS['user']['nuevo']);

        // Crear un objeto vacío de la clase user
        $this->view->user = new classUser();

        // Comrpuebo si hay errores en la validación
        if (isset($_SESSION['error'])) {

            // Creo la propiedad error en la vista
            $this->view->error = $_SESSION['error'];

            // Creo la propiedad user en la vista
            $this->view->user = $_SESSION['user'];

            // Creo la propiedad mensaje de error
            $this->view->mensaje_error = 'Error en el formulario';

            // Elimino la variable de sesión error
            unset($_SESSION['error']);

            // Elimino la variable de sesión user
            unset($_SESSION['user']);
        }

        // Creo la propiead título
        $this->view->title = "Añadir - Gestión de Usurios";

        // Creo la propiedad roles
        $this->view->roles = $this->model->getRoles();

        // Cargo la vista asociada a este método
        $this->view->render('user/nuevo/index');
    }

    /*
        Método create()

        Permite añadir nuevo user al formulario
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
        $this->checkPermissions($GLOBALS['user']['nuevo']);


        // Recogemos los detalles del formulario
        $name = filter_var($_POST['name'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_var($_POST['email'] ??= '', FILTER_SANITIZE_EMAIL);
        $password = filter_var($_POST['password'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $password_confirm = filter_var($_POST['password_confirm'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $rol = filter_var($_POST['rol'] ??= '', FILTER_SANITIZE_NUMBER_INT);

        // Creamos un objeto de la clase user
        $user = new classUser(
            null,
            $name,
            $email,
            $password
        );

        // Validación de los datos

        // Creo un array para almacenar los errores
        $error = [];

        // Validación name
        // Reglas: obligatorio, longitud mínima 5 caracteres, 
        // longitud máxima 20 caracteres, clave secundaria
        if (empty($name)) {
            $error['name'] = 'El nombre es obligatorio';
        } else if (strlen($name) < 5) {
            $error['name'] = 'El nombre debe tener al menos 5 caracteres';
        } else if (strlen($name) > 20) {
            $error['name'] = 'El nombre debe tener como máximo 20 caracteres';
        } else if (!$this->model->validateUniqueName($name)) {
            $error['name'] = 'Nombre existente';
        }

        // Validación email
        // Reglas: obligatorio, formato email, clave secundaria
        if (empty($email)) {
            $error['email'] = 'El email es obligatorio';
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error['email'] = 'El formato del email no es correcto';
        } else if (!$this->model->validateUniqueEmail($email)) {
            $error['email'] = 'El email ya existe';
        }

        //Validacion del rol
        if (empty($rol)) {
            $error['rol'] = 'El rol es obligatoria';
        } elseif (!filter_var($rol, FILTER_VALIDATE_INT)) {
            $error['rol'] = 'El formato del rol no es correcto';
        } elseif (!$this->model->validateRole($rol)) {
            $error['rol'] = 'El rol no existe';
        }

        // Validación password
        // Reglas: obligatorio, longitud mínima 7 caracteres, campos coincidentes
        if (empty($password)) {
            $error['password'] = 'La contraseña es obligatoria';
        } else if (strlen($password) < 7) {
            $error['password'] = 'La contraseña debe tener al menos 7 caracteres';
        } else if (strcmp($password, $password_confirm) !== 0) {
            $error['password'] = 'Las contraseñas no coinciden';
        }




        // Si hay errores
        if (!empty($error)) {

            // Creo la variable de sesión user
            $_SESSION['user'] = $user;

            // Creo la variable de sesión error
            $_SESSION['error'] = $error;

            // Redirecciono al formulario de nuevo user
            header('location:' . URL . 'user/nuevo');

            // Salgo de la función
            exit();
        }


        // Añadimos user a la tabla
        $id = $this->model->create($user);

        // Asigno el rol seleccionado al nuevo usuario
        $this->model->assignRole($id, $rol);

        // redireciona al main de user
        header('location:' . URL . 'user');
        exit();
    }

    /*
        Método editar()

        Muestra el formulario que permite editar los detalles de un user

        url asociada: /user/editar/id/csrf_token

        @param
            - int $id: id del user a editar
            - string $csrf_token: token CSRF

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
        $this->checkPermissions($GLOBALS['user']['editar']);


        $this->view->id = htmlspecialchars($param[0]);


        if (isset($_SESSION['error'])) {

            // Creo la propiedad error en la vista
            $this->view->error = $_SESSION['error'];

            // Creo la propiedad user en la vista
            $this->view->user = $_SESSION['user'];

            // Creo la propiedad mensaje de error
            $this->view->mensaje_error = 'Error en el formulario';

            // Elimino la variable de sesión error
            unset($_SESSION['error']);

            // Elimino la variable de sesión user
            unset($_SESSION['user']);
        }

        // Si el usuario a eliminar es el mismo que esta logueado, no permitir la eliminación
        if ($param[0] == $_SESSION['user_id']) {
            // Genero mensaje de error
            $_SESSION['error'] = 'No puedes editar tu propio usuario mientras estás logueado. Para editar tu usuario ve al perfil';

            // redireciona al main de user
            header('location:' . URL . 'user');
            exit();
        }

        // title
        $this->view->title = "Formulario Editar - Gestión de usuarios";

        // obtener objeto de la clase user con el id pasado
        // Necesito crear el método read en el modelo
        $this->view->user = $this->model->read($this->view->id);

        // Creo la propiedad roles
        $this->view->roles = $this->model->getRoles();

        // cargo la vista
        $this->view->render('user/editar/index');
    }

    /*
        Método update()

        Actualiza los detalles de un user
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
        $this->checkPermissions($GLOBALS['user']['editar']);

        // Obtengo el id del user
        $id = htmlspecialchars($param[0]);

        // Recogemos los detalles del formulario
        $name = filter_var($_POST['name'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_var($_POST['email'] ??= '', FILTER_SANITIZE_EMAIL);
        $password = filter_var($_POST['password'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $password_confirm = filter_var($_POST['password_confirm'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $rol = filter_var($_POST['rol'] ??= '', FILTER_SANITIZE_NUMBER_INT);

        // Creamos un objeto de la clase user
        $user_form = new classUser(
            null,
            $name,
            $email,
            $password
        );

        // Obtengo el user de la base de datos
        $user = $this->model->read($id);

        // Validación de los datos
        // Valido en caso de que haya sufrido modificaciones el campo correspondiente
        $error = [];

        $cambios = false;
        $cambioContrasena = false;

        // validación name
        // antes de validar compruebo se ha modificado
        if ($name != $user->name) {
            $cambios = true;
            if (empty($name)) {
                $error['name'] = 'El nombre es obligatorio';
            } else if (strlen($name) < 5) {
                $error['name'] = 'El nombre debe tener al menos 5 caracteres';
            } else if (strlen($name) > 20) {
                $error['name'] = 'El nombre debe tener como máximo 20 caracteres';
            } else if (!$this->model->validateUniqueName($name)) {
                $error['name'] = 'Nombre existente';
            }
        }

        // validación email
        // antes de validar compruebo se ha modificado
        if ($email != $user->email) {
            $cambios = true;
            if (empty($email)) {
                $error['email'] = 'El email es obligatorio';
            } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error['email'] = 'El email no es válido';
            } else if (!$this->model->validateUniqueEmail($email)) {
                $error['email'] = 'Email existente';
            }
        }

        //Validacion del rol
        if (strcmp($rol, $user->rol_id) != 0) {
            $cambios = true;
            if (empty($rol)) {
                $error['rol'] = 'El rol es obligatorio';
            } elseif (!filter_var($rol, FILTER_VALIDATE_INT)) {
                $error['rol'] = 'El formato del rol no es correcto';
            } elseif (!$this->model->validateRole($rol)) {
                $error['rol'] = 'El rol no existe';
            }
        }

        // Validación del password       
        if (!empty($password)) {
            $cambios = true;
            $cambioContrasena = true;
            if (strlen($password) < 7) {
                $error['password'] = 'La contraseña debe tener al menos 7 caracteres';
            } else if (strcmp($password, $password_confirm) !== 0) {
                $error['password'] = 'Las contraseñas no coinciden';
            }

        }


        // Si hay errores
        if (!empty($error)) {

            // Creo la variable de sesión USER
            $_SESSION['user'] = $user_form;

            // Creo la variable de sesión error
            $_SESSION['error'] = $error;

            // Redirecciono al formulario de nuevo user
            header('location:' . URL . 'user/editar/' . $id . '/' . $_SESSION['csrf_token']);

            // Salgo de la función
            exit();
        }

        // Compruebo si ha habido cambios
        if (!$cambios) {
            // Genero mensaje de éxito
            $_SESSION['mensaje'] = 'No se han realizado cambios';

            // redireciona al main de user
            header('location:' . URL . 'user');
            exit();
        }

        // Actualizo base  de datos
        // Necesito crear el método update en el modelo
        $this->model->update($user_form, $id, $cambioContrasena);

        if (strcmp($rol, $user->rol_id) != 0) {
            // Asigno el rol seleccionado al nuevo usuario
            $this->model->editRole($id, $rol);
        }

        // Genero mensaje de éxito
        $_SESSION['mensaje'] = 'Usuario actualizado con éxito';

        // Cargo el controlador principal de user
        header('location:' . URL . 'user');

        exit();
    }

    /*
        Método eliminar()

        Borra un user de la base de datos
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
        $this->checkPermissions($GLOBALS['user']['eliminar']);

        // Obtengo el id del user
        $id = htmlspecialchars($param[0]);

        // Validar el id del user
        if (!$this->model->validateIdUser($id)) {
            // Genero mensaje de error
            $_SESSION['error'] = 'El id del usuario no es correcto';

            // redireciona al main de user
            header('location:' . URL . 'user');
            exit();
        }

        // Si el usuario a eliminar es el mismo que esta logueado, no permitir la eliminación
        if ($id == $_SESSION['user_id']) {
            // Genero mensaje de error
            $_SESSION['error'] = 'No puedes eliminar tu propio usuario';

            // redireciona al main de user
            header('location:' . URL . 'user');
            exit();
        }

        // Elimino user de la base de datos
        // Necesito crear el método delete en el modelo
        $this->model->delete($id);

        // Genero mensaje de éxito
        $_SESSION['mensaje'] = 'Usuario eliminado con éxito';

        // Cargo el controlador principal de user
        header('location:' . URL . 'user');
    }

    /*
        Método mostrar()

        Muestra los detalles de un user
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
        $this->checkPermissions($GLOBALS['user']['mostrar']);

        // Obtengo el id del user
        $id = htmlspecialchars($param[0]);

        // Validar el id del user
        if (!$this->model->validateIdUser($id)) {
            // Genero mensaje de error
            $_SESSION['error'] = 'El id del usuario no es correcto';

            // redireciona al main de user
            header('location:' . URL . 'user');
            exit();
        }


        // Cargo el título
        $this->view->title = "Mostrar - Gestión de usuarios";

        // Obtengo los detalles del user mediante el método read del modelo
        $user = $this->model->read($id);

        $this->view->user = $user;

        // Creo la propiedad roles
        $this->view->roles = $this->model->getRoles();

        // Cargo la vista
        $this->view->render('user/mostrar/index');
    }

    /*
        Método filtrar()

        Busca un usuario en la base de datos
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
        $this->checkPermissions($GLOBALS['user']['filtrar']);

        # Obtengo la expresión de búsqueda
        $expresion = htmlspecialchars($_GET['expresion']);

        // Cargo el título
        $this->view->title = "Filtrar por: {$expresion} - Gestión de usuarios";

        // Creo la propiedad usuarios para usar en la vista
        $this->view->users = $this->model->filter($expresion);

        // Cargo la vista
        $this->view->render('user/main/index');
    }

    /*
        Método ordenar()

        Ordena los usuarios de la base de datos
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
        $this->checkPermissions($GLOBALS['user']['ordenar']);

        // Obtengo el id del user
        $id = (int) htmlspecialchars($param[0]);

        // Criterios de ordenación
        $criterios = [
            1 => 'Id',
            2 => 'Nombre',
            3 => 'Email'
        ];

        // Obtengo el id del campo por el que se ordenarán los usuarios
        $id = $param[0];


        // Cargo el título
        $this->view->title = "Ordenar por {$criterios[$id]} - Gestión de Usuarios";

        # Obtengo los usuarios ordenados por el campo id
        $this->view->users = $this->model->order($id);

        // Cargo la vista
        $this->view->render('user/main/index');
    }


}
