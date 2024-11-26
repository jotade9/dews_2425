<?php

/*
    clase: class.tabla_clientes.php
    descripcion: define la clase que va a contener el array de objetos de la clase clientes.
*/

class Class_tabla_clientes extends Class_conexion
{


    /*
        método: getclientes()
        descripcion: devuelve un array de objetos
    */

    public function getClientes()
    {
        $sql = "
            SELECT
                *
            FROM 
                clientes
        ";

        // ejecuto comando sql
        $result = $this->db->query($sql);

        // obtengo un objeto de la clase mysqli_result
        // deuelvo dicho objeto
        return $result;
    }

    /*
        método: create()
        descripcion: permite añadir un objeto de la clase cliente a la tabla
        
        parámetros:

            - $cliente - objeto de la clase cliente

    */
    public function create(Class_cliente $cliente)
    {
        // Crear la sentencia preparada
        $sql = "
        INSERT INTO 
            clientes( 
                    apellidos,
                    nombre,
                    telefono,
                    ciudad,
                    dni,
                    email, 
                    create_at,
                    update_at
                   )
        VALUES    (?, ?, ?, ?, ?, ?, ?, ?)                            
        ";

        // ejecuto la sentenecia preprada
        $stmt = $this->db->prepare($sql);

        // verifico
        if (!$stmt) {
            die("Error al preparar sql " . $this->db->error);
        }

        // vinculación de parámetros
        $stmt->bind_param(
            'sssissss',
            $apellidos,
            $nombre,
            $telefono,
            $ciudad,
            $dni,
            $email,
            $create_at,
            $update_at
        );

        // asignar valores
        $apellidos = $cliente->apellidos;
        $nombre = $cliente->nombre;
        $telefono = $cliente->telefono;
        $ciudad = $cliente->ciudad;
        $dni = $cliente->dni;
        $email = $cliente->email;
        $create_at = $cliente->create_at;
        $update_at = $cliente->update_at;

        // ejecutamos
        $stmt->execute();

    }


}
