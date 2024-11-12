<!DOCTYPE html>
<html lang="es">

<head>
    <?php include 'views/layouts/layout.head.html'; ?>
    <title>Nuevo Alumno - CRUD Alumno </title>
</head>

<body>
    <!-- Capa Principal -->
    <div class="container">

        <!-- Encabezado proyecto -->
        <?php include 'views/partials/partial.header.php'; ?>

        <legend>Formulario Nuevo Alumno</legend>

        <!-- Formulario Nuevo artículo -->

        <form action="create.php" method="POST">

            <!-- id -->
            <div class="mb-3">
                <label for="id" class="form-label">Id</label>
                <input type="text" class="form-control" name="id">
            </div>

            <!-- Nombre -->
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre">
            </div>

            <!-- apellidos -->
            <div class="mb-3">
                <label for="apellidos" class="form-label">Apellidos</label>
                <input type="text" class="form-control" name="apellidos">
            </div>

            <!-- email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" name="email">
            </div>

            <!-- Fecha de nacimiento -->
            <div class="mb-3">
                <label for="f_nacimiento" class="form-label">Fecha de nacimiento</label>
                <input type="text" class="form-control" name="f_nacimiento">
            </div>

            <!-- Select curso -->
            <div class="mb-3">
                <label for="curso" class="form-label">Cursos</label>
                <select class="form-select" name="curso" id="curso">
                    <option selected disabled>Seleccione un Curso</option>
                    <!-- mostar lista curso -->
                    <?php foreach ($cursos as $indice => $data): ?>
                        <option value="<?= $indice ?>">
                            <?= $data ?>
                        </option>
                    <?php endforeach; ?>
                </select>

            </div>


            <!-- lista checkbox dinámica categorías -->
            <div class="mb-3">
                <label for="asignaturas" class="form-label">Seleccione las asignaturas</label>

                <!-- mostar el array asignaturas -->
                <?php foreach ($asignaturas as $indice => $data): ?>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="asignaturas[]" value="<?=$indice?>">
                        <label class="form-check-label" for="">
                            <?= $data ?>
                        </label>
                    </div>
                <?php endforeach; ?>


            </div>

            <!-- botones de acción -->
            <a class="btn btn-secondary" href="index.php" role="button">Cancelar</a>
            <button type="reset" class="btn btn-danger">Borrar</button>
            <button type="submit" class="btn btn-primary">Enviar</button>

        </form>

        <!-- Fin formulario nuevo artículo -->



    </div>
    <br><br><br>

    <!-- Pie del documento -->
    <?php include 'views/partials/partial.footer.php'; ?>

    <!-- Bootstrap Javascript y popper -->
    <?php include 'views/layouts/layout.javascript.html'; ?>


</body>

</html>