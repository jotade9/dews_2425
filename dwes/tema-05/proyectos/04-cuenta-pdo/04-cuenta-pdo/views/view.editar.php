<!DOCTYPE html>
<html lang="es">

<head>
    <?php include 'views/layouts/layout.head.html'; ?>
    <title>Editar Cuenta - GESBANK</title>
</head>

<body>
    <!-- Capa Principal -->
    <div class="container">

        <!-- Encabezado proyecto -->
        <?php include 'views/partials/partial.header.php'; ?>

        <legend>Formulario Edición Cuenta</legend>

        <!-- Formulario Edición Cuenta -->

        <form action="update.php?id=<?=$id?>" method="POST">

            <!-- Número de Cuenta -->
            <div class="mb-3">
                <label for="num_cuenta" class="form-label">Número de Cuenta</label>
                <input type="text" class="form-control" name="num_cuenta" value="<?= $cuenta->num_cuenta ?>">
            </div>

            <!-- ID Cliente -->
            <div class="mb-3">
                <label for="id_cliente" class="form-label">ID Cliente</label>
                <input type="number" class="form-control" name="id_cliente" value="<?= $cuenta->id_cliente ?>">
            </div>

            <!-- Fecha de Alta -->
            <div class="mb-3">
                <label for="fecha_alta" class="form-label">Fecha de Alta</label>
                <input type="date" class="form-control" name="fecha_alta" value="<?= $cuenta->fecha_alta ?>">
            </div>

            <!-- Fecha Último Movimiento -->
            <div class="mb-3">
                <label for="fecha_ul_mov" class="form-label">Fecha Último Movimiento</label>
                <input type="date" class="form-control" name="fecha_ul_mov" value="<?= $cuenta->fecha_ul_mov ?>">
            </div>

            <!-- Número de Movimientos -->
            <div class="mb-3">
                <label for="num_movtos" class="form-label">Número de Movimientos</label>
                <input type="number" class="form-control" name="num_movtos" value="<?= $cuenta->num_movtos ?>">
            </div>

            <!-- Saldo -->
            <div class="mb-3">
                <label for="saldo" class="form-label">Saldo</label>
                <input type="number" step="0.01" class="form-control" name="saldo" value="<?= $cuenta->saldo ?>">
            </div>
            
            <!-- Botones de acción -->
            <a class="btn btn-secondary" href="index.php" role="button">Cancelar</a>
            <button type="reset" class="btn btn-danger">Borrar</button>
            <button type="submit" class="btn btn-primary">Actualizar</button>

        </form>
        <!-- Fin formulario edición cuenta -->
    </div>
    <br><br><br>

    <!-- Pie del documento -->
    <?php include 'views/partials/partial.footer.php'; ?>

    <!-- Bootstrap Javascript y popper -->
    <?php include 'views/layouts/layout.javascript.html'; ?>

</body>

</html>
