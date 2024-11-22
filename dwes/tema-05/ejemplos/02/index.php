<?php
/*
    Ejemplo sentencia preparada para añadir un alumno a la tabla alumnos
*/

//Configuración de la conexión
$server = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'fp';

//1. Conexión a la base de datos
// Creamos objeto mysqli
$db = new mysqli($server, $user, $pass, $dbname);

// Verificamos con éxito
if ($db->connect_errno) {
    die('ERROR de conexión' . $db->connect_error);
}

// 2. Preparar la sentencia
//Cada ? implica el dato que vamos a añadir
$sql = "
        INSERT INTO
            alumnos(
                    id,
                    nombre,
                    apellidos,
                    email,
                    telefono,
                    nacionalidad,
                    dni,
                    fechaNac,
                    id_curso
                    )
        VALUES      (null, ?, ?, ?, ?, ?, ?, ?, ?)
";

$stmt = $db->prepare($sql);

// 3. Verifico la sentencia
if ($stmt === false) {
    die("ERROR al preparar SQL" . $db->error);
}

// 4. Vinculamos los parámetros
$stmt->bind_param(
    "sssisssi",
    $nombre,
    $apellidos,
    $email,
    $telefono,
    $nacionalidad,
    $dni,
    $fechaNac,
    $id_curso
);

// 5. Asignamos los valores
$nombre = 'Juan';
$apellidos = 'Sánchez';
$email = 'juansanchezsf@gmail.com';
$telefono = 123456345;
$nacionalidad = 'España';
$dni = '12345550e';
$fechaNac = '2010/12/31';
$id_curso = 1;

$stmt->execute();


// 6. Mensaje
echo "Registro añadido correctamente";

// 7. Cerrar la sentencia y la conexión
$stmt->close();
$db->close();