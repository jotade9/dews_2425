<!DOCTYPE html>
<html lang="es">

<head>
    <?php include 'views/layouts/layout.head.html'; ?>
    <title>Mostrar Profesor - CRUD Profesores </title>
</head>

<body>
    <!-- Capa Principal -->
    <div class="container">

        <!-- Encabezado proyecto -->
        <?php include 'views/partials/partial.header.php'; ?>

        <legend>Formulario Mostrar Profesor</legend>

        <!-- Formulario Editar artículo -->

        <form action="update.php?indice=<?= $indice ?>" method="POST">

            <!-- id -->
            <div class="mb-3">
                <label for="id" class="form-label">Id</label>
                <input type="text" class="form-control" name="id" value="<?= $profesor->id?>" readonly>
            </div>

            <!-- nombre -->
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre"  value="<?= $profesor->nombre?>" readonly>
            </div>

            <!-- apellidos -->
            <div class="mb-3">
                <label for="apellidos" class="form-label">Apellidos</label>
                <input type="text" class="form-control" name="apellidos"  value="<?= $profesor->apellidos?>" readonly>
            </div>

            <!-- nrp -->
            <div class="mb-3">
                <label for="nrp" class="form-label">NRP</label>
                <input type="text" class="form-control" name="nrp"  value="<?= $profesor->nrp?>" readonly>
            </div>

            <!-- Fecha nacimiento -->
            <div class="mb-3">
                <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento</label>
                <input type="text" class="form-control" name="fecha_nacimiento"  value="<?= $profesor->fecha_nacimiento?>" readonly>
            </div>

            <!-- Select Dinámico especialidad -->
            <div class="mb-3">
                <label for="especialidad" class="form-label">Especialidad</label>
                <select class="form-select" name="especialidad" id="especialidad" disabled>
                    <!-- mostrar lista especialidad -->
                    <?php foreach($especialidad as $indice => $data):?>
                        <option value="<?= $indice ?>" <?= ($profesor->especialidad == $indice) ? 'selected': null ?>>
                            <?= $data ?>
                        </option>
                    <?php endforeach;?>
                </select>
            </div>
            
            <!-- poblacion -->
            <div class="mb-3">
                <label for="poblacion" class="form-label">Poblacion </label>
                <input type="text" class="form-control" name="poblacion"  value="<?= $profesor->poblacion?>" readonly>
            </div>

            <!-- lista checbox dinámica asignaturas -->
            <div class="mb-3">
                <label for="asignaturas" class="form-label">Seleccione las Asignaturas</label>
                <div class="form-control">
                    <!-- muestro el array categorías -->
                    <?php foreach($asignaturas as $indice => $data): ?>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="asignaturas[]" value="<?= $indice ?>" disabled
                            <?= (in_array($indice, $profesor->asignaturas) ? 'checked' : null ) ?>>
                            <label class="form-check-label" >
                                <?= $data ?>
                            </label>
                        </div>
                    <?php endforeach; ?> 
                    
                </div>
            </div>

            

            <!-- botones de acción -->
            <a class="btn btn-secondary" href="index.php" role="button">Volver</a>

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