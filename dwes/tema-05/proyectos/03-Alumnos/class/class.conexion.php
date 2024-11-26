<?php

/**
 * Clase conexion mediante msqli
 */

class Class_conexion
{
        public $db;
    public function __construct(
    ) {
        try {
            // realizo la conexion
            $this->db = new mysqli(SERVER, USER, PASS, BD);
        } catch (mysqli_sql_exception $e) {
            include 'views/partials/errorDB.php';

            // Cierro conexión
            $this->db->close();
            
            exit();
        }
    }
}
