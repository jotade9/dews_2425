<?php

/*
    clase: class.tabla_cuentas.php
    descripcion: define la clase que va a contener el array de objetos de la clase cuentas.
*/

class Class_tabla_cuentas extends Class_conexion
{


    /*
        método: getcuentas()
        descripcion: devuelve un objeto pdostatement con los detalles de los cuentas
    */

    public function getCuentas()
    {
        try {

            // sentencia sql
            $sql = "
            SELECT 
                cuentas.id AS id_cuenta,
                cuentas.num_cuenta,
                CONCAT(clientes.apellidos, ', ', clientes.nombre) AS cliente,
                cuentas.fecha_alta,
                cuentas.fecha_ul_mov,
                cuentas.num_movtos,
                cuentas.saldo
            FROM 
                cuentas
            LEFT JOIN 
                clientes ON cuentas.id_cliente = clientes.id
            ORDER BY 
                cuentas.id;

            ";

            // sentencia preparada
            // obtengo objeto clase pdostatement
            $stmt = $this->pdo->prepare($sql);

            // establezco tipo de fetch
            $stmt->setFetchMode(PDO::FETCH_OBJ);

            // ejectuto
            $stmt->execute();

            // devuelvo objeto clase pdostatement
            return $stmt;
        } catch (PDOException $e) {

            // error de  base dedatos
            include 'views/partials/errorDB.php';

            // libero pdostatement
            $stmt = null;

            // cierro conexión
            $this->pdo = null;

            // cancelo ejecución programa
            exit();
        }
    }


    /*
        método: create()
        descripcion: permite añadir un objeto de la clase cliente a la tabla
        
        parámetros:

            - $cliente - objeto de la clase cliente

    */
    public function create(Class_cliente $cliente)
    {
        try {

            // Crear la sentencia preparada
            $sql = "
        INSERT INTO 
            cuentas (
                num_cuenta,
                id_cliente,
                fecha_alta,
                fecha_ul_mov,
                num_movtos,
                saldo
            )
        VALUES (
            :num_cuenta,
            :id_cliente,
            :fecha_alta,
            :fecha_ul_mov,
            :num_movtos,
            :saldo
        )";

            // ejecuto la sentenecia preprada
            $stmt = $this->pdo->prepare($sql);
            
            // Objeto de la clase pdostatemen

            // Vincular los parámetros con las propiedades del objeto
            $stmt->bindParam(':num_cuenta', $cliente->num_cuenta, PDO::PARAM_STR);
            $stmt->bindParam(':id_cliente', $cliente->id_cliente, PDO::PARAM_INT);
            $stmt->bindParam(':fecha_alta', $cliente->fecha_alta, PDO::PARAM_STR);
            $stmt->bindParam(':fecha_ul_mov', $cliente->fecha_ul_mov, PDO::PARAM_STR);
            $stmt->bindParam(':num_movtos', $cliente->num_movtos, PDO::PARAM_INT);
            $stmt->bindParam(':saldo', $cliente->saldo, PDO::PARAM_STR);

            // ejecutamos
            $stmt->execute();

        } catch (PDOException $e) {

            // error de  base dedatos
            include 'views/partials/errorDB.php';

            // libero sentencia preprada
            $stmt->close();

            // cierro conexión
            $this->pdo->close();

            // cancelo ejecución programa
            exit();
        }
    }

    /*
        método: read()
        descripcion: permite obtener el objeto de la clase cliente a partir del id del cliente 

        parámetros:

            - $id - id del cliente
    */
    public function read($id)
    {
        try {

            // Crear la sentencia SQL
        $sql = "SELECT 
                id, num_cuenta, id_cliente, fecha_alta, fecha_ul_mov, num_movtos, saldo
            FROM cuentas 
            WHERE id = :id LIMIT 1";

        // Preparar la sentencia
        $stmt = $this->pdo->prepare($sql);

        // Vincular parámetros
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        // Ejecutar la consulta
        $stmt->execute();

        // Devolver un objeto con los datos
        return $stmt->fetch(PDO::FETCH_OBJ);

        } catch (PDOException $e) {

            // error de  base dedatos
            include 'views/partials/errorDB.php';

            // libero sentencia preprada
            $stmt->close();

            // cierro conexión
            $this->pdo->close();

            // cancelo ejecución programa
            exit();
        }
    }

    /*
        método: update()
        descripcion: permite actualizar los detalles de un libro en la tabla

        parámetros:

            - $cliente - objeto de Class_cliente
            - $id - id del cliente
    */
    public function update(Class_cliente $cliente, $id)
    {
        try {

            // Crear la sentencia SQL
        $sql = "
        UPDATE cuentas SET 
            num_cuenta = :num_cuenta,
            id_cliente = :id_cliente,
            fecha_alta = :fecha_alta,
            fecha_ul_mov = :fecha_ul_mov,
            num_movtos = :num_movtos,
            saldo = :saldo,
            update_at = CURRENT_TIMESTAMP
        WHERE id = :id
        LIMIT 1";

    // Preparar la sentencia
    $stmt = $this->pdo->prepare($sql);

    // Vincular parámetros
    $stmt->bindParam(':num_cuenta', $cliente->num_cuenta, PDO::PARAM_STR);
    $stmt->bindParam(':id_cliente', $cliente->id_cliente, PDO::PARAM_INT);
    $stmt->bindParam(':fecha_alta', $cliente->fecha_alta, PDO::PARAM_STR);
    $stmt->bindParam(':fecha_ul_mov', $cliente->fecha_ul_mov, PDO::PARAM_STR);
    $stmt->bindParam(':num_movtos', $cliente->num_movtos, PDO::PARAM_INT);
    $stmt->bindParam(':saldo', $cliente->saldo, PDO::PARAM_STR);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    // Ejecutar la consulta
    $stmt->execute();

        } catch (PDOException $e) {

            // error de  base dedatos
            include 'views/partials/errorDB.php';

            // libero result
            $stmt->close();

            // cierro conexión
            $this->pdo->close();

            // cancelo ejecución programa
            exit();
        }
    }

    /*
        método: order()
        descripcion: devuelve un objeto de la clase mysqli_result con los 
        detalles de los cuentas  ordenados por un criterio.

        Parámetros:

            - criterio: posición de la columna en la tabla cuentas
                        por la que quiero ordenar
    */

    public function order(int $criterio)
    {
        try {

            // Validar el criterio para evitar inyecciones SQL
        $criterioValido = in_array($criterio, ['id', 'fecha_alta', 'saldo', 'num_movtos']);
        if (!$criterioValido) {
            throw new InvalidArgumentException("Criterio de ordenación no válido.");
        }

        // Crear la sentencia SQL
        $sql = "SELECT 
                    id, num_cuenta, id_cliente, fecha_alta, fecha_ul_mov, num_movtos, saldo
                FROM cuentas
                ORDER BY $criterio";

        // Preparar la sentencia
        $stmt = $this->pdo->prepare($sql);

        // Ejecutar la consulta
        $stmt->execute();

        // Retornar resultados como objetos
        return $stmt->fetchAll(PDO::FETCH_OBJ);

        } catch (PDOException $e) {

            // error de  base dedatos
            include 'views/partials/errorDB.php';

            // libero stmt
            $stmt->close();

            // cierro conexión
            $this->pdo->close();

            // cancelo ejecución programa
            exit();
        }
    }

    /*
        método: filter()
        descripcion: devuelve los registros de cuentas que contengan la expresion
        de busqueda

        Parámetros:

            - expresion: posición de la columna en la tabla cuentas
                        por la que quiero ordenar
    */

    public function filter($expresion)
    {
        try {

             // Crear la sentencia SQL
        $sql = "
            SELECT 
                id, num_cuenta, id_cliente, fecha_alta, fecha_ul_mov, num_movtos, saldo
            FROM cuentas
            WHERE CONCAT_WS(' ', id, num_cuenta, id_cliente, fecha_alta, fecha_ul_mov, num_movtos, saldo) 
            LIKE :expresion";

        // Preparar la sentencia
        $stmt = $this->pdo->prepare($sql);

        // Preparar la expresión para LIKE
        $expresion = '%' . $expresion . '%';

        // Vincular parámetros
        $stmt->bindParam(':expresion', $expresion, PDO::PARAM_STR);

        // Ejecutar la consulta
        $stmt->execute();

        // Retornar resultados
        return $stmt->fetchAll(PDO::FETCH_OBJ);

        } catch (PDOException $e) {

            // error de  base dedatos
            include 'views/partials/errorDB.php';

            // libero stmt
            $stmt->null;

            // cierro conexión
            $this->pdo->null;

            // cancelo ejecución programa
            exit();
        }
    }

    /*
        método: delete()
        descripcion: devuelve un objeto de la clase mysqli_result con los 
        detalles de los cuentas  ordenados por un criterio.

        Parámetros:

            - criterio: posición de la columna en la tabla cuentas
                        por la que quiero ordenar
    */

    public function delete(int $id)
    {
        try {
        // Crear la sentencia SQL
        $sql = "DELETE FROM cuentas WHERE id = :id LIMIT 1";

        // Preparar la sentencia
        $stmt = $this->pdo->prepare($sql);

        // Vincular parámetros
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        // Ejecutar la consulta
        $stmt->execute();
        
        } catch (PDOException $e) {

            // error de  base dedatos
            include 'views/partials/errorDB.php';

            // libero stmt
            $stmt->close();

            // libero result
            $result->close();

            // cierro conexión
            $this->pdo->close();

            // cancelo ejecución programa
            exit();
        }
    }
}
