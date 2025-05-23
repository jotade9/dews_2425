<?php
class Contactar extends Controller
{

    function __construct()
    {

        parent::__construct();
    }

    /*
        Muestra el formulario de contacto
    */
    function render()
    {
        // Continua o inicia sesión
        session_start();

        // Crear token csrf
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));

        // Inicializo las variables para los campos del formulario
        $this->view->name = '';
        $this->view->email = '';
        $this->view->subject = '';
        $this->view->message = '';

        // Compruebo si hay errores de una no validación anterior
        if (isset($_SESSION['error'])) {

            // Muestro los errores
            $this->view->error = $_SESSION['error'];

            // Retroalimento el formulario
            $this->view->name = $_SESSION['name'];
            $this->view->email = $_SESSION['email'];
            $this->view->subject = $_SESSION['subject'];
            $this->view->message = $_SESSION['message'];

            // Elimino la variable de sesión
            unset($_SESSION['error']);

            // Elimino la variable de sesión del formulario
            unset($_SESSION['name']);
            unset($_SESSION['email']);
            unset($_SESSION['subject']);
            unset($_SESSION['message']);
        }


        // Cargar la vista
        $this->view->render('contactar/form/index');
    }

    /*
        Valida los datos del formulario de contacto
    */
    function validar()
    {
        // Continua o inicia sesión
        session_start();

        // Compruebo si el token csrf es válido
        $this->checkTokenCsrf($_POST['csrf_token']);

        // Recuperar los datos del formulario
        $name = filter_var($_POST['name'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_var($_POST['email'] ??= '', FILTER_SANITIZE_EMAIL);
        $subject = filter_var($_POST['subject'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $message = filter_var($_POST['message'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);

        // Validar los datos
        $error = [];


        // Comprobar que el nombre no está vacío
        if (empty($name)) {
            $error['name'] = 'El nombre es obligatorio';
        }

        // Comprobar que el email no está vacío
        if (empty($email)) {
            $error['email'] = 'El email es obligatorio';
        }
        // Comprobar que el email es válido
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error['email'] = 'El email no es válido';
        }

        // Comprobar que el asunto no está vacío
        if (empty($subject)) {
            $error['subject'] = 'El asunto es obligatorio';
        }

        // Comprobar que el mensaje no está vacío
        if (empty($message)) {
            $error['message'] = 'El mensaje es obligatorio';
        }

        // Si hay errores, los muestro
        if (!empty($error)) {

            // Guardo el error en variable de sesión
            $_SESSION['error'] = $error;

            // Guardo los datos en variables de sesión
            $_SESSION['name'] = $name;
            $_SESSION['email'] = $email;
            $_SESSION['subject'] = $subject;
            $_SESSION['message'] = $message;


            // redireciona al formulario de nuevo
            header('location:' . URL . 'contactar');
            exit();
        }

        $cuerpo_mensaje = "Nombre: $name\n";
        $cuerpo_mensaje .= "Email: $email\n";
        $cuerpo_mensaje .= "Asunto: $subject\n";
        $cuerpo_mensaje .= "Mensaje: $message\n";

        // Si no hay errores, envío el email
        $this->enviarEmail($name, $email, $subject, $cuerpo_mensaje);

        // Muestro la vista de confirmación
        $this->view->mensaje = 'Mensaje enviado correctamente';
        $this->view->render('contactar/confirm/index');
    }

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
        Envía un email
    */
    function enviarEmail($name, $email, $subject, $message)
    {
        // Configuración de la cuenta de correo
        require_once 'config/smtp_brevo.php';

        // Cargar la librería PHPMailer
        require_once 'extensions/PHPMailer/src/PHPMailer.php';
        require_once 'extensions/PHPMailer/src/SMTP.php';
        require_once 'extensions/PHPMailer/src/Exception.php';

        // Crear una nueva instancia de PHPMailer
        $mail = new PHPMailer\PHPMailer\PHPMailer(true);

        try {

            // Configuración juego caracteres
            $mail->CharSet = "UTF-8";
            $mail->Encoding = "quoted-printable";

            // Servidor SMTP
            $mail->isSMTP();
            $mail->Host = SMTP_HOST;
            $mail->SMTPAuth = true;
            $mail->Username = SMTP_USER;
            $mail->Password = SMTP_PASS;
            $mail->Port = SMTP_PORT;
            $mail->SMTPSecure = 'tls';

            // Configurar el email
            $mail->setFrom($email, $name);
            $mail->addAddress('jjuandi8@gmail.com');
            $mail->Subject = $subject;
            $mail->Body = $message;

            // Configurar el email
            $mail->send();
        } catch (Exception $e) {
            $this->view->mensaje_error = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            $this->view->render('contactar/confirm/index');
            exit();
        }
    }

    function enviarEmailRegistro($name, $email, $password)
    {
        // Configuración de la cuenta de correo
        require_once 'config/smtp_brevo.php';

        // Cargar la librería PHPMailer
        require_once 'extensions/PHPMailer/src/PHPMailer.php';
        require_once 'extensions/PHPMailer/src/SMTP.php';
        require_once 'extensions/PHPMailer/src/Exception.php';

        // Crear una nueva instancia de PHPMailer
        $mail = new PHPMailer\PHPMailer\PHPMailer(true);

        try {
            // Configuración de caracteres
            $mail->CharSet = "UTF-8";
            $mail->Encoding = "quoted-printable";

            // Servidor SMTP
            $mail->isSMTP();
            $mail->Host = SMTP_HOST;
            $mail->SMTPAuth = true;
            $mail->Username = SMTP_USER;
            $mail->Password = SMTP_PASS;
            $mail->Port = SMTP_PORT;
            $mail->SMTPSecure = 'tls';

            // Configurar el email
            $mail->setFrom(SMTP_USER, 'Soporte - GesLibros Javier Rodríguez Torres');
            $mail->addAddress($email, $name);
            $mail->Subject = 'Bienvenido a nuestra web';

            // Contenido del correo
            $mensaje = "<h2>Estimado/a $name,</h2>";
            $mensaje .= "<p>Le damos una cordial bienvenida a nuestra comunidad. Nos complace contar con su participación y queremos asegurarnos de que tenga una excelente experiencia con nosotros.</p>";
            $mensaje .= "<p>A continuación, encontrará sus credenciales de acceso:</p>";
            $mensaje .= "<p><strong>Nombre:</strong> $name</p>";
            $mensaje .= "<p><strong>Correo electrónico:</strong> $email</p>";
            $mensaje .= "<p><strong>Contraseña:</strong> $password</p>";
            $mensaje .= "<p>Por razones de seguridad, le recomendamos cambiar su contraseña después de su primer inicio de sesión y mantener esta información en un lugar seguro.</p>";
            $mensaje .= "<p>Si tiene alguna consulta o necesita asistencia, no dude en ponerse en contacto con nuestro equipo de soporte.</p>";
            $mensaje .= "<p>Atentamente,<br>El equipo de Juan Diego</p>";
            


            $mail->isHTML(true);
            $mail->Body = $mensaje;

            // Enviar el email
            $mail->send();
        } catch (Exception $e) {
            $_SESSION['mensaje_error'] = "Error al enviar el correo de registro: " . $mail->ErrorInfo;
        }
    }

    function enviarEmailModificacionPerfil($name, $email)
    {
        require_once 'config/smtp_brevo.php';
        require_once 'extensions/PHPMailer/src/PHPMailer.php';
        require_once 'extensions/PHPMailer/src/SMTP.php';
        require_once 'extensions/PHPMailer/src/Exception.php';

        $mail = new PHPMailer\PHPMailer\PHPMailer(true);

        try {
            $mail->CharSet = "UTF-8";
            $mail->Encoding = "quoted-printable";
            $mail->isSMTP();
            $mail->Host = SMTP_HOST;
            $mail->SMTPAuth = true;
            $mail->Username = SMTP_USER;
            $mail->Password = SMTP_PASS;
            $mail->Port = SMTP_PORT;
            $mail->SMTPSecure = 'tls';

            $mail->setFrom(SMTP_USER, 'Soporte - GesLibros Javier Rodríguez Torres');
            $mail->addAddress($email, $name);
            $mail->Subject = 'Actualización de perfil';

            $mensaje = "<h2>Estimado/a $name,</h2>";
            $mensaje .= "<p>Le informamos que los cambios en su perfil se han guardado correctamente.</p>";
            $mensaje .= "<p>Si usted no ha realizado esta modificación, le recomendamos que se comunique con nuestro equipo de soporte de inmediato para garantizar la seguridad de su cuenta.</p>";
            $mensaje .= "<p>Agradecemos su confianza en nuestros servicios.</p>";
            $mensaje .= "<p>Atentamente,<br>El equipo de Juan Diego</p>";
            

            $mail->isHTML(true);
            $mail->Body = $mensaje;

            $mail->send();
        } catch (Exception $e) {
            $_SESSION['mensaje_error'] = "Error al enviar el correo de modificación: " . $mail->ErrorInfo;
        }
    }

    function enviarEmailCambioPassword($name, $email)
    {
        require_once 'config/smtp_brevo.php';
        require_once 'extensions/PHPMailer/src/PHPMailer.php';
        require_once 'extensions/PHPMailer/src/SMTP.php';
        require_once 'extensions/PHPMailer/src/Exception.php';

        $mail = new PHPMailer\PHPMailer\PHPMailer(true);

        try {
            $mail->CharSet = "UTF-8";
            $mail->Encoding = "quoted-printable";
            $mail->isSMTP();
            $mail->Host = SMTP_HOST;
            $mail->SMTPAuth = true;
            $mail->Username = SMTP_USER;
            $mail->Password = SMTP_PASS;
            $mail->Port = SMTP_PORT;
            $mail->SMTPSecure = 'tls';

            $mail->setFrom(SMTP_USER, 'Soporte - GesLibros Javier Rodríguez Torres');
            $mail->addAddress($email, $name);
            $mail->Subject = 'Cambio de contraseña';

            $mensaje = "<h2>Estimado/a $name,</h2>";
            $mensaje .= "<p>Le informamos que su contraseña ha sido cambiada exitosamente.</p>";
            $mensaje .= "<p>Si usted no realizó este cambio, le recomendamos que se comunique de inmediato con nuestro equipo de soporte para proteger la seguridad de su cuenta.</p>";
            $mensaje .= "<p>Agradecemos su confianza en nuestra plataforma.</p>";
            $mensaje .= "<p>Atentamente,<br>El equipo de Juan Diego</p>";
            


            $mail->isHTML(true);
            $mail->Body = $mensaje;

            $mail->send();
        } catch (Exception $e) {
            $_SESSION['mensaje_error'] = "Error al enviar el correo de cambio de contraseña: " . $mail->ErrorInfo;
        }
    }

    function enviarEmailEliminacionPerfil($name, $email)
    {
        require_once 'config/smtp_brevo.php';
        require_once 'extensions/PHPMailer/src/PHPMailer.php';
        require_once 'extensions/PHPMailer/src/SMTP.php';
        require_once 'extensions/PHPMailer/src/Exception.php';

        $mail = new PHPMailer\PHPMailer\PHPMailer(true);

        try {
            $mail->CharSet = "UTF-8";
            $mail->Encoding = "quoted-printable";
            $mail->isSMTP();
            $mail->Host = SMTP_HOST;
            $mail->SMTPAuth = true;
            $mail->Username = SMTP_USER;
            $mail->Password = SMTP_PASS;
            $mail->Port = SMTP_PORT;
            $mail->SMTPSecure = 'tls';

            $mail->setFrom(SMTP_USER, 'Soporte - GesLibros Javier Rodríguez Torres');
            $mail->addAddress($email, $name);
            $mail->Subject = 'Eliminación de perfil';

            $mensaje = "<h2>Estimado/a $name,</h2>";
            $mensaje .= "<p>Le informamos que su cuenta ha sido eliminada exitosamente de nuestra plataforma.</p>";
            $mensaje .= "<p>Si usted no solicitó esta acción, le recomendamos que se comunique de inmediato con nuestro equipo de soporte para asistirle en la recuperación de su cuenta.</p>";
            $mensaje .= "<p>Atentamente,<br>El equipo de Juan Diego</p>";
            


            $mail->isHTML(true);
            $mail->Body = $mensaje;

            $mail->send();
        } catch (Exception $e) {
            $_SESSION['mensaje_error'] = "Error al enviar el correo de eliminación: " . $mail->ErrorInfo;
        }
    }

}
