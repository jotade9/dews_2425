<?php
class Perfil extends Controller
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

        // generar token crsf
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));

        // Comprobar si hay un usuario logueado
        if (!isset($_SESSION['user_id'])) {
            // Genero mensaje de error
            $_SESSION['mensaje_error'] = 'Acceso denegado';
            header('location:' . URL . 'auth/login');
            exit();
        }

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


        # Obtenemos los detalles completos del usuario
        $this->view->perfil = $this->model->getUserId($_SESSION['user_id']);

        // Creo la propiedad title de la vista
        $this->view->title = "Mi perfil " . $_SESSION['user_name'];

        $this->view->render('perfil/main/index');
    }

    /*
        Método para actualizar los datos del usuario. 
        Muestra en la vista el formulario con los datos del usuario en modo edición. 

        url: /perfil/editar

        @param $id int : id del usuario

    */
    public function editar()
    {
        // inicio o continuo la sesión
        session_start();

        // Comprobar si hay un usuario logueado
        if (!isset($_SESSION['user_id'])) {
            // Genero mensaje de error
            $_SESSION['mensaje_error'] = 'Acceso denegado';
            header('location:' . URL . 'auth/login');
            exit();
        }

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

        // Obtenemos el id del usuario
        $id = $_SESSION['user_id'];

        // Obtenemos los detalles completos del usuario
        $this->view->perfil = $this->model->getUserId($id);

        // Capa no validación del formulario
        if (isset($_SESSION['error'])) {

            // Creo la propiedad error en la vista
            $this->view->error = $_SESSION['error'];

            // Elimino la variable de sesión error
            unset($_SESSION['error']);

            // Asigno a perfil los detalles del formulario
            $this->view->perfil = $_SESSION['perfil'];

            // Elimino la variable de sesión perfil
            unset($_SESSION['perfil']);

            // Creo la propiedad mensaje error
            $this->view->mensaje_error = 'Hay errores en el formulario';
        }

        // Creo la propiedad title de la vista
        $this->view->title = "Editar perfil " . $_SESSION['user_name'];

        $this->view->render('perfil/editar/index');
    }

    /*
        Método para actualizar los datos del usuario. 
        Actualiza los datos del usuario name y email. 

        Incluye:
         - validación token crsf.
         - validación de los datos del formulario.
         - prevención ataques csrf.

        url: /perfil/update

    */
    public function update()
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
        
        // Comprobar si hay un usuario logueado
        if (!isset($_SESSION['user_id'])) {
            // Genero mensaje de error
            $_SESSION['mensaje_error'] = 'Acceso denegado';
            header('location:' . URL . 'auth/login');
            exit();
        }

        // Saneamos los detalles del formulario
        $name = filter_var($_POST['name'] ??= null, FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_var($_POST['email'] ??= null, FILTER_SANITIZE_EMAIL);

        // Obtengo los detalles del usuario
        $user = $this->model->getUserId($_SESSION['user_id']);

        // validación de los datos del formulario
        $error = [];

        // validación name
        // antes de validar compruebo se ha modificado
        if ($name != $user->name) {
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
            if (empty($email)) {
                $error['email'] = 'El email es obligatorio';
            } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error['email'] = 'El email no es válido';
            } else if (!$this->model->validateUniqueEmail($email)) {
                $error['email'] = 'Email existente';
            }
        }

        // Si hay errores
        if (!empty($error)) {
            // Creo la variable de sesión error
            $_SESSION['error'] = $error;

            // Creo la variable de sesión perfil
            $_SESSION['perfil'] = (object) [
                'name' => $name,
                'email' => $email
            ];

            // Redirecciono al formulario de edición
            header('location:' . URL . 'perfil/editar');
            exit();
        }

        // Actualizo los datos del usuario
        $this->model->update($name, $email, $_SESSION['user_id']);

        // Actualizo el posible nuevo nombre del usuario
        $_SESSION['user_name'] = $name;

        // Genero mensaje de éxito
        $_SESSION['mensaje'] = 'Perfil actualizado correctamente';

        $this->enviarEmail($user->name, $user->email, "nombre");

        // Redirecciono a la vista principal de perfil
        header('location:' . URL . 'perfil');
    }

    /*
        Método para cambiar la contraseña del usuario. 
        Muestra en la vista el formulario para cambiar la contraseña. 

        url: /perfil/pass

    */
    public function pass()
    {
        // inicio o continuo la sesión
        session_start();

        // generar token crsf
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));

        // Comprobar si hay un usuario logueado
        if (!isset($_SESSION['user_id'])) {
            // Genero mensaje de error
            $_SESSION['mensaje_error'] = 'Acceso denegado';
            header('location:' . URL . 'auth/login');
            exit();
        }

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

        // Capa no validación del formulario
        if (isset($_SESSION['error'])) {

            // Creo la propiedad error en la vista
            $this->view->error = $_SESSION['error'];

            // Elimino la variable de sesión error
            unset($_SESSION['error']);

            // Creo la propiedad mensaje error
            $this->view->mensaje_error = 'Errores de validación';
        }

        // Creo la propiedad title de la vista
        $this->view->title = "Cambiar contraseña " . $_SESSION['user_name'];

        $this->view->render('perfil/pass/index');
    }

    /*
        Método para actualizar la contraseña del usuario. 
        Actualiza la contraseña del usuario. 

        Incluye:
         - validación token crsf.
         - validación de los datos del formulario.
         - prevención ataques csrf.

        url: /perfil/update_pass

    */
    public function update_pass()
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

        // Comprobar si hay un usuario logueado
        if (!isset($_SESSION['user_id'])) {
            // Genero mensaje de error
            $_SESSION['mensaje_error'] = 'Acceso denegado';
            header('location:' . URL . 'auth/login');
            exit();
        }

        // Saneamos los detalles del formulario
        $password = filter_var($_POST['password'] ??= null, FILTER_SANITIZE_SPECIAL_CHARS);
        $new_password = filter_var($_POST['new_password'] ??= null, FILTER_SANITIZE_SPECIAL_CHARS);
        $confirm_password = filter_var($_POST['confirm_password'] ??= null, FILTER_SANITIZE_SPECIAL_CHARS);

        // Obtengo los detalles del usuario
        $user = $this->model->getUserId($_SESSION['user_id']);

        // validación de los datos del formulario
        $error = [];

        // validación password
        if (empty($password)) {
            $error['password'] = 'El password actual es obligatorio';
        } else if (!password_verify($password, $user->password)) {
            $error['password'] = 'El password actual no es correcto';
        }

        // validación new_password
        if (empty($new_password)) {
            $error['new_password'] = 'El nuevo password es obligatorio';
        } else if (strlen($new_password) < 7) {
            $error['new_password'] = 'El nuevo password debe tener al menos 7 caracteres';
        } else if (strcmp($new_password, $confirm_password) !== 0) {
            $error['new_password'] = 'Los passwords no son coincidentes';
        }

        // Si hay errores
        if (!empty($error)) {
            // Creo la variable de sesión error
            $_SESSION['error'] = $error;

            // Redirecciono al formulario de edición
            header('location:' . URL . 'perfil/pass');
            exit();
        }

        // Actualizo password del usuario
        $this->model->updatePass($new_password, $_SESSION['user_id']);


        // Genero mensaje de éxito
        $_SESSION['mensaje'] = 'Contraseña actualizada correctamente';

        $this->enviarEmail($user->name, $user->email, "update");

        // Redirecciono a la vista principal de perfil
        header('location:' . URL . 'perfil');
        exit();
    }

    /*
        delete($id)

        Método para eliminar el usuario. 
        Elimina el usuario de la base de datos. 

        url: /perfil/delete

        @param $id int : id del usuario

    */
    public function delete($param = [])
    {
        // inicio o continuo la sesión
        session_start();

        // Recojo el token crsf enviado en la URL
        $csrf_token = htmlspecialchars($param[0]);

        // Validación toekn CSRF
        if (!hash_equals($_SESSION['csrf_token'], $csrf_token)) {
            require_once 'controllers/error.php';
            $controller = new Errores('Petición no válida');
            exit();
        
        }

        // Comprobar si hay un usuario logueado
        if (!isset($_SESSION['user_id'])) {
            // Genero mensaje de error
            $_SESSION['mensaje_error'] = 'Acceso denegado';
            header('location:' . URL . 'auth/login');
            exit();
        }

        // Elimino el usuario
        $this->model->delete($_SESSION['user_id']);

        // Obtengo los detalles del usuario
        $user = $this->model->getUserId($_SESSION['user_id']);


        $this->enviarEmail($user->name, $user->email, "delete");

        // Cierro la sesión
        session_destroy();

        // Elimino la cookie de sesión
        setcookie(session_name(), '', time() - 3600);

        // vuelvo a abrir sesión
        session_start();

        // Genero mensaje de éxito
        $_SESSION['mensaje'] = 'Usuario eliminado correctamente';

        // Redirecciono a la vista principal de perfil
        header('location:' . URL . 'auth/login');
    }

    /*
        Envía un email
    */
    function enviarEmail($name, $email, $tipo)
    {
        // Configuración de la cuenta de correo
        require_once 'config/smtp_gmail.php';

        // Cargar la librería PHPMailer
        require_once 'extensions/PHPMailer/src/PHPMailer.php';
        require_once 'extensions/PHPMailer/src/SMTP.php';
        require_once 'extensions/PHPMailer/src/Exception.php';

        // Crear una nueva instancia de PHPMailer
        $mail = new PHPMailer\PHPMailer\PHPMailer(true);

        switch ($tipo) {
            case 'delete':
                $subject = 'Cuenta eliminada';
                $message = "Hola $name, tu cuenta ha sido eliminada correctamente";
                break;
            case 'update':
                $subject = 'Perfil actualizado';
                $message = "Hola $name, tu contraseña ha sido actualizado correctamente";
                break;
            case 'nombre':
                $subject = 'Nombre actualizado';
                $message = "Hola $name, tu nombre ha sido actualizado correctamente";
                break;
        }
        
        try {

            // Configuración juego caracteres
            $mail->CharSet = "UTF-8";
            $mail->Encoding = "quoted-printable";

            // Servidor SMTP
            $mail->isSMTP();
            $mail->Host = SMTP_HOST;
            $mail->SMTPAuth = true;
            $mail->Username = SMTP_USER;
            $mail->Password = 'incorrect_password';
            $mail->Port = SMTP_PORT;
            $mail->SMTPSecure = 'tls';

            // Configurar el email
            $mail->setFrom($email, $name);
            $mail->addAddress($email);
            $mail->Subject = $subject;
            $mail->Body = $message;

            // Configurar el email
            $mail->send();

        } catch (Exception $e) {
            $_SESSION['mensaje_error'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

    }
}
