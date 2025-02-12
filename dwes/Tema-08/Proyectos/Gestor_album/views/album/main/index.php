<!doctype html>
<html lang="es">

<head>
    <?php require_once 'template/layouts/head.layout.php'; ?>
    <title>Albumes - Gestión </title>
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
                <!-- detalles de albumes  -->

                <!-- Menú principal panel de albums  -->
                <?php include 'views/album/partials/menu.album.partial.php'; ?>

                <!-- tabla de albums -->
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <!-- Mostramos el encabezado de la tabla -->
                            <tr>
                                <th>Id</th>
                                <th>Título</th>
                                <th>Lugar</th>
                                <th>Categoría</th>
                                <th>Etiquetas</th>
                                <th class='text-end'>Nº Fotos</th>
                                <th class='text-end'>Nº Visitas</th>
                                <!-- columna de acciones -->
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Mostramos cuerpo de la tabla -->
                            <?php while ($album = $this->albumes->fetch()): ?>

                                <tr class="align-middle">
                                    <!-- Detalles de artículos -->
                                    <td><?= $album->id ?></td>
                                    <td><?= $album->titulo ?></td>
                                    <td><?= $album->lugar ?></td>
                                    <td><?= $album->categoria ?></td>
                                    <td><?= $album->etiquetas ?></td>
                                    <td class='text-end'><?= $album->num_fotos ?></td>
                                    <td class='text-end'><?= $album->num_visitas ?></td>

                                    <!-- Columna de acciones -->
                                    <td>
                                        <div class="btn-group btn-group-toggle" data-toggle="buttons">

                                            <!-- botón eliminar -->
                                            <a href="<?= URL ?>album/eliminar/<?= $album->id ?>/<?= $_SESSION['csrf_token'] ?>/<?= $album->carpeta ?>"
                                                title="Eliminar"
                                                class="btn btn-danger
                                                <?= !in_array($_SESSION['role_id'], $GLOBALS['album']['eliminar']) ? 'disabled' : null ?>"
                                                onclick="return confirm('Confimar elimación del album')"
                                                aria-label="Eliminar album"><i class="bi bi-trash-fill"></i></a>

                                            <!-- botón editar -->
                                            <a href="<?= URL ?>album/editar/<?= $album->id ?>/<?= $_SESSION['csrf_token'] ?>"
                                                title="Editar"
                                                class="btn btn-primary
                                                <?= !in_array($_SESSION['role_id'], $GLOBALS['album']['editar']) ? 'disabled' : null ?>">
                                                <i class="bi bi-pencil-square"></i></a>

                                            <!-- botón mostrar -->
                                            <a href="<?= URL ?>album/mostrar/<?= $album->id ?>/<?= $_SESSION['csrf_token'] ?>"
                                                title="Mostrar"
                                                class="btn btn-warning 
                                                <?= !in_array($_SESSION['role_id'], $GLOBALS['album']['mostrar']) ? 'disabled' : null ?>">
                                                <i class="bi bi-eye-fill"></i></a>

                                            
                                            <!-- botón modal -->
                                            <?php require('views/album/partials/modal.php'); ?>
                                            
                                            <a href="#" title="Subir" data-bs-toggle="modal"
                                                data-bs-target="#subir<?= $album->id ?>"
                                                class="btn btn-success <?= (!in_array($_SESSION['role_id'], $GLOBALS['album']['agregar'])) ? 'disabled' : null ?> ">
                                                <i class="bi bi-cloud-upload-fill"></i>
                                            </a>

                                        </div>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>

                    </table>

                </div>
            </div>
            <div class="card-footer">
                Nº albumes <?= $this->albumes->rowCount() ?>
            </div>
        </div>
        <br><br><br>

    </div>

    <!-- /.container -->

    <?php require_once 'template/partials/footer.partial.php' ?>
    <?php require_once 'template/layouts/javascript.layout.php' ?>

</body>

</html>