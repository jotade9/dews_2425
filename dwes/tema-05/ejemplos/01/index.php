<?php 
/**
 * Conexion a base de datos:
 *  -servidor: localhost
 *  -usuario: root
 *  -password:
 *  -base de datos: fp
 */

 # variables de conexion
 $ip = '127:0.0.1:3306';
 $server = 'localhost';
 $user = 'root';
 $pass = '';
 $bd = 'fp';

 # establecemos la conexion
 $conexion = new mysqli($server, $user, $pass, $bd);

 # Verificamos conexion
 if ($conexion->connect_errno){
    echo 'ERROR DE CONEXION Nº: '. $conexion->connect_errno;
    echo '<BR>';
    echo 'DESCRIPCION ERROR: '. $conexion->connect_error;
    exit();
 }
 echo "conexion establecida con éxito";
 echo "<BR>";

 # ejecuto sql
 $sql = 'select * from alumnos order by id';

 $result = $conexion->query($sql);

 # Manejo de resultado
 // $result objeto de class mysqli_result

 # Muestro el resultado
 while ($alumno = $result->fetch_assoc()){
    echo 'id: ' . $alumno['id'];
    echo '<BR>';
    echo 'nombre: ' . $alumno['nombre'];
    echo '<BR>';
    echo 'poblacion: ' . $alumno['poblacion'];
    echo '<BR>';
 }
 # libero memoria y cierro conexion
 $result->free();
 $conexion->close();