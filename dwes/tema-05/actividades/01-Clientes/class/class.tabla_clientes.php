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
}
