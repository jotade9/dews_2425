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
                Tabla Alumnos
            </div>

            <div class="card-body">

                <?php require_once 'views/alumno/partials/menu.alumno.partial.php'  ?>

            </div>


            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <!-- Mostramos el encabezado de la tabla -->
                        <tr>
                            <th>Id</th>
                            <th>Alumno</th>
                            <th>Email</th>
                            <th>Teléfono</th>
                            <th>Nacionalidad</th>
                            <th>Dni</th>
                            <th>Curso</th>
                            <th>Edad</th>
                            <!-- columna de acciones -->
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Mostramos cuerpo de la tabla -->
                        <?php while ($alumno = $this->alumnos->fetch()) : ?>
                            <tr class="align-middle">
                                <!-- Detalles de artículos -->
                                <td><?= $alumno->id ?></td>
                                <td><?= $alumno->alumno ?></td>
                                <td><?= $alumno->email ?></td>
                                <td><?= $alumno->telefono ?></td>
                                <td><?= $alumno->nacionalidad ?></td>
                                <td><?= $alumno->dni ?></td>
                                <td><?= $alumno->curso ?></td>
                                <td class='text-end'><?= $alumno->edad ?></td>
                                <!-- Columna de acciones -->
                                <td>
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <a href="eliminar.php?indice=<?= $alumno->id ?>" title="Eliminar" class="btn btn-danger" onclick="return confirm(' Confimar elimación del alumno$alumno')"><i class="bi bi-trash-fill"></i></a>
                                        <a href="editar.php?indice=<?= $alumno->id ?>" title="Editar" class="btn btn-primary"><i class="bi bi-pencil-square"></i></a>
                                        <a href="mostrar.php?indice=<?= $alumno->id ?>" title="Mostrar" class="btn btn-warning"><i class="bi bi-eye-fill"></i></a>
                                    </div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="6">Nº Registros <?= $this->alumnos->rowCount() ?></td>
                        </tr>
                    </tfoot>
                </table>
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