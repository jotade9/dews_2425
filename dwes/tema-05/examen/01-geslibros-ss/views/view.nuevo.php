<!DOCTYPE html>
<html lang="es">

<head>
    <!-- include head -->
    <title>Nuevo Libro - GESLIBROS </title>
    <?php include 'views/layouts/layout.head.html'; ?>
</head>

<body>
    <!-- Capa Principal -->
    <div class="container">

        <!-- Encabezado proyecto -->
        <!-- include header -->
        <?php include 'views/partials/partial.header.php'; ?>
        <legend>Formulario Nuevo Libro</legend>

        <!-- Formulario Nuevo autor -->

        <form>
            <!-- título -->
            <div class="mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" class="form-control" name="titulo">
            </div>

            <!-- autor -->
            <div class="mb-3">
                <label for="" class="form-label">Autor</label>
                <select class="form-select">
                    <option selected disabled>Seleccione Autor</option>
                    <!-- generar lista dinámica -->
                    <div class="mb-3">
                        <label for="libro" class="form-label">Autor</label>
                        <select class="form-select" name="autor_id">
                            <!-- mostrar lista autores -->
                            <?php foreach ($autores as $indice => $data): ?>
                                <option value="<?= $indice ?>"
                                    <?= ($libro->autor == $indice) ? 'selected' : null ?>>
                                    <?= $data ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </select>
            </div>

            <!-- autor -->
            <div class="mb-3">
                <label for="" class="form-label">autor</label>
                <select class="form-select">
                    <option selected disabled>Seleccione autor</option>
                    <!-- generar lista dinámica -->
                    <div class="mb-3">
                        <label for="libro" class="form-label">autor</label>
                        <select class="form-select" name="autor_id">
                            <!-- mostrar lista autores -->
                            <?php foreach ($autores as $indice => $data): ?>
                                <option value="<?= $indice ?>"
                                    <?= ($libro->autor_id == $indice) ? 'selected' : null ?>>
                                    <?= $data ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </select>
            </div>

            <!-- precio -->
            <div class="mb-3">
                <label for="" class="form-label">Precio</label>
                <input type="number" class="form-control" aria-describedby="emailHelpId" step="0.01" placeholder="0.00" name="precio">
            </div>

            <!-- stock -->
            <div class="mb-3">
                <label for="" class="form-label">Unidades</label>
                <input type="number" class="form-control" aria-describedby="emailHelpId" value=0 name="stock">
            </div>

            <!-- fecha_edicion -->
            <div class="mb-3">
                <label for="fecha_edicion" class="form-label">Fecha Edición</label>
                <input type="date" class="form-control" name="fecha_edicion">
            </div>

            <!-- isbn -->
            <div class="mb-3">
                <label for="isbn" class="form-label">Isbn</label>
                <input type="text" class="form-control" name="isbn">
            </div>

            <!-- lista checbox dinámica géneros -->

            <div class="mb-3">
                <label for="generos_id" class="form-label">Seleccione Generos</label>
                <div class="form-control">
                    <!-- muestro el array generos -->
                    <?php foreach ($generos_id as $indice => $data): ?>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="generos_id[]" value="<?= $indice ?>">
                            <label class="form-check-label" for="">
                                <?= $data ?>
                            </label>
                        </div>
                    <?php endforeach; ?>

                </div>
            </div>

            <!-- botones de acción -->
            <a class="btn btn-secondary" href="index.php" role="button">Cancelar</a>
            <button type="reset" class="btn btn-danger">Borrar</button>
            <button type="submit" class="btn btn-primary">Enviar</button>

        </form>
        <!-- Fin formulario nuevo autor -->
    </div>
    <br><br><br>

    <!-- Pie del documento -->
    <!-- include footer -->
    <?php include 'views/partials/partial.footer.php'; ?>
    <!-- Bootstrap Javascript y popper -->
    <!-- include javascript -->
    <?php include 'views/layouts/layout.javascript.html'; ?>

</body>

</html>