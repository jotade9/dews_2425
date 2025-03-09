<!doctype html>
<html lang="es">

<head>
    <?php require_once 'template/layouts/head.layout.php'; ?>
    <title>autors - Gestión Gesautors </title>
</head>

<body>
    <!-- Menú fijo superior -->
    <?php require_once 'template/partials/menu.auth.partial.php' ?>

    <!-- Capa Principal -->
    <div class="container">
        <br><br><br><br>

        <!-- capa de errores -->
        <?php require_once 'template/partials/error.partial.php' ?>

        <!-- capa de mensajes -->
        <?php require_once 'template/partials/mensaje.partial.php' ?>

        <!-- Estilo card de bootstrap -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title"><?= $this->title ?></h5>
            </div>
            <div class="card-body">
                <!-- detalles de autors  -->

                <!-- Menú principal panel de autors  -->
                <?php include 'views/autor/partials/menu.autor.partial.php'; ?>

                <!-- tabla de autors -->
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <!-- Mostramos el encabezado de la tabla -->
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Nacionalidad</th>
                                <th>Email</th>
                                <th>Premios</th>
                                <th class='text-end'>edad</th>
                                <!-- columna de acciones -->
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Mostramos cuerpo de la tabla -->
                            <?php while ($autor = $this->autores->fetch()): ?>
                                <tr class="align-middle">
                                    <!-- Detalles de artículos -->
                                    <td><?= $autor->id ?></td>
                                    <td><?= $autor->nombre ?></td>
                                    <td><?= $autor->nacionalidad ?></td>
                                    <td><?= $autor->email ?></td>
                                    <td><?= $autor->premios ?></td>
                                    <!-- Mostramos la edad del autor -->
                                    <td class='text-end'><?= $autor->edad() ?></td>

                                    <!-- Columna de acciones -->
                                    <td>
                                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                            <a href="<?= URL ?>autor/eliminar/<?= $autor->id ?>/<?= $_SESSION['csrf_token'] ?>" title="Eliminar"
                                                class="btn btn-danger
                                                <?= in_array($_SESSION['role_id'], $GLOBALS['autor']['eliminar'])? null:'disabled'?>"
                                                onclick="return confirm('Confimar elimación del autor')" aria-label="Eliminar libeo"><i
                                                    class="bi bi-trash-fill"></i></a>
                                            <a href="<?= URL ?>autor/editar/<?= $autor->id ?>/<?= $_SESSION['csrf_token'] ?>" title="Editar"
                                                class="btn btn-primary
                                                <?= in_array($_SESSION['role_id'], $GLOBALS['autor']['editar'])? null:'disabled'?>">
                                                <i class="bi bi-pencil-square"></i></a>
                                            <a href="<?= URL ?>autor/mostrar/<?= $autor->id ?>/<?= $_SESSION['csrf_token'] ?>" title="Mostrar"
                                                class="btn btn-warning
                                                <?= in_array($_SESSION['role_id'], $GLOBALS['autor']['mostrar'])? null:'disabled'?>">
                                                <i class="bi bi-eye-fill"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>

                    </table>

                </div>
            </div>
            <div class="card-footer">
                Nº autors <?= $this->autors->rowCount() ?>
            </div>
        </div>
        <br><br><br>

    </div>

    <!-- /.container -->

    <?php require_once 'template/partials/footer.partial.php' ?>
    <?php require_once 'template/layouts/javascript.layout.php' ?>

</body>

</html>