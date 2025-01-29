<?php

/*
    auth.model.php

    Modelo del controlador auth

    Métodos:

        - validateName
*/

class authModel extends Model
{

    /*
        método: validateUniqueName()

        Valida el name de usuario
    */
    public function validateUniqueName($name)
    {
        try {

            // sentencia sql
            $sql = "SELECT 
                name
            FROM 
                users 
            WHERE
                name = :name;";

            // conectamos con la base de datos
            $conexion = $this->db->connect();

            // ejecuto prepare
            $stmt = $conexion->prepare($sql);

            // bindeo parámetros
            $stmt->bindParam(':name', $name, PDO::PARAM_STR, 30);

            // ejecutamos
            $stmt->execute();

            // si existe el name devuelvo FALSE
            if ($stmt->rowCount() > 0) {
                return FALSE;
            }
            return TRUE;

        } catch (PDOException $e) {

            // error base de datos
            require 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
        }
    }

    /*
        método: validateUniqueEmail

        descripción: valida el email. Que no exista en la base de datos

        @param: 
            - email del usuario

    */
    public function validateUniqueEmail($email){

        try {

            // sentencia sql
            $sql = "SELECT 
                email
            FROM 
                users 
            WHERE
                email = :email;";

            // conectamos con la base de datos
            $conexion = $this->db->connect();

            // ejecuto prepare
            $stmt = $conexion->prepare($sql);

            // bindeo parámetros
            $stmt->bindParam(':email', $email, PDO::PARAM_STR, 100);

            // ejecutamos
            $stmt->execute();

            // si existe el email devuelvo FALSE
            if ($stmt->rowCount() > 0) {
                return FALSE;
            }
            return TRUE;

        } catch (PDOException $e) {

            // error base de datos
            require 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
        }
    }

    /* 
        método: create();

        descripción: crea un nuevo usuario en la base de datos
        
        @param:
            - name
            - email
            - password
    */

    public function create($name, $email, $password)
    {
        try {

            // encripto la contraseña
            $password = password_hash($password, PASSWORD_DEFAULT);

            // sentencia sql
            $sql = "INSERT INTO 
                users (name, email, password) 
            VALUES 
                (:name, :email, :password);";

            // conectamos con la base de datos
            $conexion = $this->db->connect();

            // ejecuto prepare
            $stmt = $conexion->prepare($sql);

            // bindeo parámetros
            $stmt->bindParam(':name', $name, PDO::PARAM_STR, 50);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR, 50);
            $stmt->bindParam(':password', $password, PDO::PARAM_STR, 255);

            // ejecutamos
            $stmt->execute();

            // devuelo el id asignado
            $id = $conexion->lastInsertId();

            // si se ha insertado correctamente devuelvo TRUE
            if ($stmt->rowCount() > 0) {
                return TRUE;
            }
            return FALSE;

        } catch (PDOException $e) {

            // error base de datos
            require 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
        }
    }

    /*
        metodo: assignRole

        descripción: asigna un rol a un usuario

        @param:
            - id del usuario
            - id del rol
    */
    public function assignRole($id, $role)
    {
        try {

            // sentencia sql
            $sql = "INSERT INTO 
                roles_users (user_id, role_id) 
            VALUES 
                (:user_id, :role_id);";

            // conectamos con la base de datos
            $conexion = $this->db->connect();

            // ejecuto prepare
            $stmt = $conexion->prepare($sql);

            // bindeo parámetros
            $stmt->bindParam(':user_id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':role_id', $role, PDO::PARAM_INT);

            // ejecutamos
            $stmt->execute();

            // si se ha insertado correctamente devuelvo TRUE
            if ($stmt->rowCount() > 0) {
                return TRUE;
            }
            return FALSE;

        } catch (PDOException $e) {

            // error base de datos
            require 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
        }
    }


    /*
        método: getUserEmail

        descripción: obtiene el email del usuario

        @param:
            - email del usuario
    */

    public function getUserEmail($email)
    {
        try {

            // sentencia sql
            $sql = "SELECT 
                id, name, email, password
            FROM 
                users 
            WHERE
                email = :email;";

            // conectamos con la base de datos
            $conexion = $this->db->connect();

            // ejecuto prepare
            $stmt = $conexion->prepare($sql);

            // Tipo de fetch
            $stmt->setFetchMode(PDO::FETCH_OBJ);

            // bindeo parámetros
            $stmt->bindParam(':email', $email, PDO::PARAM_STR, 50);

            // ejecutamos
            $stmt->execute();

            // devuelvo el resultado
            return $stmt->fetch();

        } catch (PDOException $e) {

            // error base de datos
            require 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
        }
    }

}
