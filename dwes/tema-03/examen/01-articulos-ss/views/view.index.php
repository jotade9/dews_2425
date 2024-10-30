<!DOCTYPE html>
<html lang="es">
<head>
    <!-- cargar head.html -->
    <title>Gestión de Artículos - Home </title>
    <?php include 'layouts/head.html' ?>
</head>
<body>
    <!-- Capa Principal -->
    <div class="container">

        <!-- Encabezado proyecto -->
        <!-- cargar partial.header.php -->
        <?php include 'partials/partial.header.php' ?>

                
        <!-- Menú principal -->
        <!-- cargar partial.menu.php -->
        <?php include 'partials/partial.menu.php' ?>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <!-- Mostramos el encabezado de la tabla -->
                    <tr>
                        <th>Id</th>
                        <th>Descripcion</th>
                        <th>Modelo</th>
                        <th>Categoria</th>
                        <th class="text-end">Unidades</th>
                        <th class="text-end">Precio</th>
                        <!-- columna de acciones  -->
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Mostramos cuerpo de la tabla -->
                    <?php foreach ($tabla as $registro): ?>
                        <tr class="">
                            <td><?= $registro['id'] ?></th>
                            <td><?= $registro['descripcion'] ?></td>
                            <td><?= $registro['modelo'] ?></td>
                            <td><?= $registro['categoria'] ?></td>
                            <td class="text-end"><?= number_format($registro['unidades'], 2, ',', '.') ?></td>
                            <td class="text-end"><?= number_format($registro['precio'], 2, ',', '.')  ?> €</td>

                            <!-- Botones de acción  -->
                            <td>
                                <!-- boton borrar -->
                                <a href="delete.php?id=<?= $registro['id'] ?>" title="Eliminar"
                                    onclick="return confirm('Confirmar eliminación del producto')">
                                    <i class="bi bi-trash-fill"></i>

                                    <!-- boton editar  -->
                                    <a href="edit.php?id=<?= $registro['id'] ?>" title="Editar">
                                        <i class="bi bi-pencil-square"></i>

                                        <!-- boton mostrar  -->
                                        <a href="mostrar.php?id=<?= $registro['id'] ?>" title="Mostrar">
                                            <i class="bi bi-eye-fill"></i>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
                <tfoot>
                    <!-- Mostrar el número de registros de la tabla -->
                </tfoot>
            </table>
        </div>
    </div>
    <br><br><br>

    <!-- Pie del documento -->
    <!-- cargar partial.footer.php -->
    <?php include 'partials/partial.footer.php' ?>
    <!-- Bootstrap Javascript y popper -->
    <!-- cargar javascript.php -->
    <?php include 'layouts/javascript.html' ?>
 
</body>
</html>