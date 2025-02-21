<?php
class Contactar extends Controller
{   
    function __construct()
    {
        parent::__construct();
    }
    /**
     * muestra el formulario de contacto
     */
    function render()
    {
        // Crear token CSRF
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));

        // Initializar variables para los campos del formulario
        $this->view->name = '';
        $this->view->email = '';
        $this->view->subject = '';
        $this->view->message = '';


        // Cargar la vista
        $this->view->render('contactar/index');
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
    /**
     * Valida los datos del formulario de contacto
     */
    function validar()
    {   
        // Compruebo si el token CSRF es válido
        $this->checkTokenCsrf($_POST['csrf_token']);

        // Recuperar los datos del formulario
        $name = filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $subject = filter_var($_POST['subject'], FILTER_SANITIZE_SPECIAL_CHARS);
        $message = filter_var($_POST['message'], FILTER_SANITIZE_SPECIAL_CHARS);


        // Validar los datos
        $error = [];

        // Compobamos que el nombre no esté vacío
        if (empty($name)) {
            $error['name'] = 'El nombre es obligatorio';
        }
        // Comprobar que el email no esté vacío
        if (empty($email)) {
            $error['email'] = 'El email es obligatorio';
        }
        // Comprobamos que el email sea válido
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error['email'] = 'El email no es válido';
        }
        // Comprobamos que el asunto no esté vacío
        if (empty($subject)) {
            $error['subject'] = 'El asunto es obligatorio';
        }
        // Comprobamos que el mensaje no esté vacío
        if (empty($message)) {
            $error['message'] = 'El mensaje es obligatorio';
        }
        // Si hay errores, los muestro
        if (!empty($error)) {
            $this->view->error = $error;
            $this->view->name = $name;
            $this->view->email = $email;
            $this->view->subject = $subject;
            $this->view->message = $message;
            $this->view->render('contactar/index');
            exit();
        }

    }
    
}
