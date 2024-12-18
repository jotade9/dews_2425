<!doctype html>
<html lang="es">

<head>
    <?php include 'template/layouts/head.layout.php'; ?>
    <title>Hola Mundo -MVC </title>
</head>



<body>
    <!-- Menú fijo superior -->
    <?php require_once 'template/partials/menu.partial.php' ?>

    <!-- Page Content -->
    <div class="container">
        <br><br><br><br>

        <!-- Capa de mensajes -->
        <?php require_once 'template/partials/mensaje.partial.php' ?>


        <!-- Estilo card de bootstrap -->
        <div class="card">
            <div class="card-header">
                Formulario Nuevo Alumno
            </div>

            <div class="card-body">

                <!-- Formulario de  Alumnos -->
                <form action="<?= URL ?>alumno/create" method="POST">

                    <!-- id -->
                    <div class="mb-3">
                        <label for="id" class="form-label">Id</label>
                        <input type="text" class="form-control" name="id">
                    </div>

                    <!-- titulo -->
                    <div class="mb-3">
                        <label for="titulo" class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="nombre">
                    </div>

                    <!-- autor -->
                    <div class="mb-3">
                        <label for="autor" class="form-label">Apellidos</label>
                        <input type="text" class="form-control" name="apellidos">
                    </div>

                    <!-- editorial -->
                    <div class="mb-3">
                        <label for="editorial" class="form-label">Email</label>
                        <input type="text" class="form-control" name="email">
                    </div>

                    <!-- fecha_edicion -->
                    <div class="mb-3">
                        <label for="fecha_edicion" class="form-label">Tlf</label>
                        <input type="text" class="form-control" name="telefono">
                    </div>

                    <!-- fecha_edicion -->
                    <div class="mb-3">
                        <label for="fecha_edicion" class="form-label">Nacionalidad</label>
                        <input type="text" class="form-control" name="nacionalidad">
                    </div>

                    <!-- fecha_edicion -->
                    <div class="mb-3">
                        <label for="fecha_edicion" class="form-label">DNI</label>
                        <input type="text" class="form-control" name="dni">
                    </div>

                    <div class="mb-3">
                        <label for="fecha_edicion" class="form-label">Fecha Nacimiento</label>
                        <input type="date" class="form-control" name="fechNac">
                    </div>




                    <!-- Select Dinámico Cursos -->
                    <div class="mb-3">
                        <label for="materia" class="form-label">Cursos</label>
                        <select class="form-select" name="id_cursos" id="id_cursos">
                            <option selected disabled>Seleccione un curso</option>
                            <!-- mostrar lista cursos -->
                            <?php foreach ($cursos as $data): ?>
                                <option value="<?= $data['id'] ?>">
                                    <?= $data['cursos'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>


                    <!-- botones de acción -->
                    <a class="btn btn-secondary" href="<?= URL ?>alumno" role="button">Cancelar</a>
                    <button type="reset" class="btn btn-danger">Borrar</button>
                    <button type="submit" class="btn btn-primary">Enviar</button>

                </form>


            </div>
            <div class="card-footer">
                Curso 24/25
            </div>
        </div>


    </div>

    <!-- /.container -->

    <?php require_once 'template/partials/footer.partial.php' ?>
    <?php require_once 'template/layouts/javascript.layout.php' ?>

</body>

</html>