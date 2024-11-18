<!DOCTYPE html>
<html lang="es">

<head>
    <?php include 'views/layouts/layout.head.html'; ?>
    <title>Nuevo Profesor - CRUD Profesores </title>
</head>

<body>
    <!-- Capa Principal -->
    <div class="container">

        <!-- Encabezado proyecto -->
        <?php include 'views/partials/partial.header.php'; ?>

        <legend>Formulario Editar profesor</legend>

        <!-- Formulario editar profesor -->

        <form action="update.php?indice=<?= $indice ?>" method="POST">

            <!-- id -->
            <div class="mb-3">
                <label for="id" class="form-label">Id</label>
                <input type="text" class="form-control" name="id" value="<?= $profesor->id ?>" readonly>
            </div>

            <!-- nombre -->
            <div class="mb-3">
                <label for="nombre" class="form-label">nombre</label>
                <input type="text" class="form-control" name="nombre" value="<?= $profesor->nombre ?>">
            </div>

            <!-- apellidos -->
            <div class="mb-3">
                <label for="rauto" class="form-label">apellidos</label>
                <input type="text" class="form-control" name="apellidos" value="<?= $profesor->apellidos ?>">
            </div>

            <!-- nrp -->
            <div class="mb-3">
                <label for="nrp" class="form-label">NRP</label>
                <input type="text" class="form-control" name="nrp" value="<?= $profesor->nrp ?>">
            </div>

            <!-- Fecha nacimiento -->
            <div class="mb-3">
                <label for="fecha_nacimiento" class="form-label">Fecha Nacimiento</label>
                <input type="text" class="form-control" name="fecha_nacimiento" value="<?= $profesor->fecha_nacimiento ?>">
            </div>

            <!-- Select Dinámico especialidad -->
            <div class="mb-3">
                <label for="especialidad" class="form-label">especialidad</label>
                <select class="form-select" name="especialidad" id="especialidad">
                    <option selected disabled>Seleccione una especialidad</option>
                    <!-- mostrar lista especialidads -->
                    <?php foreach ($especialidad as $indice => $data): ?>
                        <option value="<?= $indice ?>" <?= ($profesor->especialidad == $indice) ? 'selected' : null ?>>
                            <?= $data ?>
                        </option>
                    <?php endforeach; ?>
                </select>

            </div>

            <!-- poblacion -->
            <div class="mb-3">
                <label for="poblacion" class="form-label">Población</label>
                <input type="text" class="form-control" name="poblacion"  value="<?= $profesor->poblacion ?>">
            </div>

            <!-- lista checbox dinámica asignaturas -->
            <div class="mb-3">
                <label for="asignaturas" class="form-label">Seleccione las asignaturas</label>
                <div class="form-control">
                    <!-- muestro el array asignaturas -->
                    <?php foreach ($asignaturas as $indice => $data): ?>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="asignaturas[]" value="<?= $indice ?>"
                                <?= (in_array($indice, $profesor->asignaturas) ? 'checked' : true) ?>>
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

        <!-- Fin formulario nuevo profesor -->



    </div>
    <br><br><br>

    <!-- Pie del documento -->
    <?php include 'views/partials/partial.footer.php'; ?>

    <!-- Bootstrap Javascript y popper -->
    <?php include 'views/layouts/layout.javascript.html'; ?>


</body>

</html>