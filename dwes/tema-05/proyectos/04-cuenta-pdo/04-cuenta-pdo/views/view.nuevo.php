<!DOCTYPE html>
<html lang="es">

<head>
    <?php include 'views/layouts/layout.head.html'; ?>
    <title>Nueva Cuenta - GESBANK</title>
</head>

<body>
    <!-- Capa Principal -->
    <div class="container">

        <!-- Encabezado proyecto -->
        <?php include 'views/partials/partial.header.php'; ?>

        <legend>Formulario Nueva Cuenta</legend>

        <!-- Formulario Nueva Cuenta -->

        <form action="create.php" method="POST">

            <!-- Número de Cuenta -->
            <div class="mb-3">
                <label for="num_cuenta" class="form-label">Número de Cuenta</label>
                <input type="text" class="form-control" name="num_cuenta">
            </div>

            <!-- ID Cliente -->
            <div class="mb-3">
                <label for="id_cliente" class="form-label">ID Cliente</label>
                <input type="number" class="form-control" name="id_cliente">
            </div>

            <!-- Fecha de Alta -->
            <div class="mb-3">
                <label for="fecha_alta" class="form-label">Fecha de Alta</label>
                <input type="date" class="form-control" name="fecha_alta">
            </div>

            <!-- Fecha Último Movimiento -->
            <div class="mb-3">
                <label for="fecha_ul_mov" class="form-label">Fecha Último Movimiento</label>
                <input type="date" class="form-control" name="fecha_ul_mov">
            </div>

            <!-- Número de Movimientos -->
            <div class="mb-3">
                <label for="num_movtos" class="form-label">Número de Movimientos</label>
                <input type="number" class="form-control" name="num_movtos">
            </div>

            <!-- Saldo -->
            <div class="mb-3">
                <label for="saldo" class="form-label">Saldo</label>
                <input type="number" step="0.01" class="form-control" name="saldo">
            </div>
            
            <!-- Botones de acción -->
            <a class="btn btn-secondary" href="index.php" role="button">Cancelar</a>
            <button type="reset" class="btn btn-danger">Borrar</button>
            <button type="submit" class="btn btn-primary">Enviar</button>

        </form>
        <!-- Fin formulario nueva cuenta -->
    </div>
    <br><br><br>

    <!-- Pie del documento -->
    <?php include 'views/partials/partial.footer.php'; ?>

    <!-- Bootstrap Javascript y popper -->
    <?php include 'views/layouts/layout.javascript.html'; ?>

</body>

</html>
