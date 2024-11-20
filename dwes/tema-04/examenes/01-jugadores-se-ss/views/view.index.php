<!DOCTYPE html>
<html lang="es">

<head>
    <!-- incluye head -->
    <title>Gestión de jugadores - Home </title>
    <?php include 'layouts/layout.head.html' ?>
</head>

<body>
    <!-- Capa Principal -->
    <div class="container">

        <!-- Encabezado proyecto -->
        <!-- incluye header -->
        <?php include 'partials/partial.header.php' ?>


        <!-- Menú principal -->
        <!-- incluye menú principal -->
        <?php include 'partials/partial.menu.php' ?>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <!-- Mostramos el encabezado de la tabla -->
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Equipo</th>
                        <th>Nacionalidad</th>
                        <th>Posiciones</th>
                        <th class='text-end'>Edad</th>
                        <th class='text-end'>Altura</th>
                        <th class='text-end'>Peso</th>
                        <th class='text-end'>Valor</th>

                        <!-- columna de acciones -->
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($array_jugador as $indice => $jugador): ?>
                        <!-- Mostramos cuerpo de la tabla -->
                        <tr class="align-middle">

                            <!-- Mostramos detalles del jugador -->
                            <td><?= $jugador->id ?></td>
                            <td><?= $jugador->nombre ?></td>
                            <td><?= $equipos[$jugador->equipo_id] ?></td>
                            <td><?= $jugador->nacionalidad ?></td>
                            <td><?= implode(', ', $obj_tabla_jugadores->mostrar_nombre_posiciones($jugador->posiciones_id)) ?></td>
                            <td class="text-end"><?= $jugador->getEdad() ?></td>
                            <td class="text-end"><?= number_format($jugador->altura, 2, ',', '.') ?></td>
                            <td class="text-end"><?= number_format($jugador->peso, 2, ',', '.') ?></td>
                            <td class='text-end'><?= number_format($jugador->valor_merdado, 2, ',', '.') . '€' ?></td>

                            <!-- Columna de acciones -->
                            <td>
                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                    <a href="#" title="Eliminar" class="btn btn-danger" onclick="return confirm('Confimar elimación del jugador')"><i class="bi bi-trash-fill"></i></a>
                                    <a href="#" title="Editar" class="btn btn-primary"><i class="bi bi-pencil-square"></i></a>
                                    <a href="mostrar.php" title="Mostrar" class="btn btn-warning"><i class="bi bi-eye-fill"></i></a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="9">Nº Registros <?= count($array_jugador) ?></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <br><br><br>

    <!-- Pie del documento -->
    <!-- inclye footer -->
    <?php include 'partials/partial.footer.php' ?>
    <!-- Bootstrap Javascript y popper -->
    <!-- incluye javascript -->
    <?php include 'layouts/layout.javascript.html' ?>

</body>

</html>