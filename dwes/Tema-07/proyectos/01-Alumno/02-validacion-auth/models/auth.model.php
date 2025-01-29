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
        método: validateName()

        Valida el name de usuario, devuelve verdadero siu el nombre no existe en la base de datos
    */
    public function validateUniqueName()
    {

        try {

            // sentencia sql
            $sql = "SELECT * FROM users WHERE name = :name";

            // conectamos con la base de datos
            $conexion = $this->db->connect();

            // ejecuto prepare
            $stmt = $conexion->prepare($sql);

            // vinculamos parámetros
            $stmt->bindParam(':name', $this->name, PDO::PARAM_STR, 50);

            // ejecutamos
            $stmt->execute();

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
       método: get_cursos()

       Extre los detalles de los cursos para generar lista desplegable 
       dinámica
   */
    public function get_cursos()
    {

        try {

            // sentencia sql
            $sql = "SELECT 
                        id,
                        nombre as curso
                    FROM 
                        cursos
                    ORDER BY
                        2
            ";

            // conectamos con la base de datos
            $conexion = $this->db->connect();

            // ejecuto prepare
            $stmt = $conexion->prepare($sql);

            // establezco tipo fetch
            $stmt->setFetchMode(PDO::FETCH_KEY_PAIR);

            // ejecutamos
            $stmt->execute();

            // devuelvo objeto stmtatement
            return $stmt->fetchAll();
        } catch (PDOException $e) {

            // error base de datos
            require 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
        }
    }

    /*
        método: validateUniqueEmail()

        descripción: comprueba si un email ya existe en la base de datos,
        devuelve verdadero si es un valor unico

        @param: 
            - email del alumno

    */
    public function validateUniqueEmail()
    {

        try {

            // sentencia sql
            $sql = "SELECT * FROM users WHERE email = :email";

            // conectamos con la base de datos
            $conexion = $this->db->connect();

            // ejecuto prepare
            $stmt = $conexion->prepare($sql);

            // vinculamos parámetros
            $stmt->bindParam(':email', $this->email, PDO::PARAM_STR, 50);

            // ejecutamos
            $stmt->execute();

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
    /**
     * metodo: getUsesEmail()
     * descripcion: obtiene un usuario por email
     * @param: email del usuario
     */
    public function getUserByEmail($email) {

        try {

            // sentencia sql
            $sql = "SELECT * FROM users WHERE email = :email";

            // conectamos con la base de datos
            $conexion = $this->db->connect();

            // ejecuto prepare
            $stmt = $conexion->prepare($sql);

            // establezco tipo fetch
            $stmt->setFetchMode(PDO::FETCH_OBJ);

            // vinculamos parámetros
            $stmt->bindParam(':email', $email, PDO::PARAM_STR, 50);

            // ejecutamos
            $stmt->execute();

            // devuelvo objeto usuario  
            return $stmt->fetch();
        } catch (PDOException $e) {

            // error base de datos
            require 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
        }
    }


