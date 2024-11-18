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

        <legend>Formulario Nuevo Profesor</legend>

        <!-- Formulario Nuevo profesor -->

        <form action="create.php" method="POST">

            <!-- id -->
            <div class="mb-3">
                <label for="id" class="form-label">Id</label>
                <input type="text" class="form-control" name="id">
            </div>

            <!-- nombre -->
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre">
            </div>

            <!-- apellidos -->
            <div class="mb-3">
                <label for="apellidos" class="form-label">Apellidos</label>
                <input type="text" class="form-control" name="apellidos">
            </div>

            <!-- nrp -->
            <div class="mb-3">
                <label for="nrp" class="form-label">NRP</label>
                <input type="text" class="form-control" name="nrp">
            </div>

            <!-- nacimiento -->
            <div class="mb-3">
                <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                <input type="date" class="form-control" name="fecha_nacimiento">
            </div>

            

            <!-- Select Dinámico especialidad -->
            <div class="mb-3">
                <label for="especialidad" class="form-label">Especialidad</label>
                <select class="form-select" name="especialidad" id="especialidad" >
                    <option selected disabled>Seleccione una especialidad</option>
                    <!-- mostrar lista especialidad -->
                    <?php foreach($especialidad as $indice => $data):?>
                        <option value="<?= $indice ?>">
                            <?= $data ?>
                        </option>
                    <?php endforeach;?>
                </select>

            </div>

            <!-- poblacion-->
            <div class="mb-3">
                <label for="poblacion" class="form-label">Poblacion</label>
                <input type="text" class="form-control" name="poblacion">
            </div>

            <!-- lista checbox dinámica asignatura -->
            <div class="mb-3">
                <label for="asignaturas" class="form-label">Seleccione las Asignaturas</label>
                <div class="form-control">
                    <!-- muestro el array asignatura -->
                    <?php foreach($asignaturas as $indice => $data): ?>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="asignaturas[]" value="<?= $indice ?>">
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