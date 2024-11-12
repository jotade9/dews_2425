<!DOCTYPE html>
<html lang="es">

<head>
    <?php include 'views/layouts/layout.head.html'; ?>
    <title>Gestión de Alumnos - Home </title>
</head>

<body>
    <!-- Capa Principal -->
    <div class="container">

        <!-- Encabezado proyecto -->
        <?php include 'views/partials/partial.header.php'; ?>


        <!-- Menú principal -->
        <?php include 'views/partials/partial.menu.php'; ?>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <!-- Mostramos el encabezado de la tabla -->
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Email</th>
                        <th>Fecha de nacimiento</th>
                        <th>Curso</th>
                        <th>Asignaturas</th>
                        <!-- columna de acciones -->
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Mostramos cuerpo de la tabla -->
                    <?php foreach ($array_alumnos as $alumno): ?>
                        <tr>
                            <!-- Detalles de artículos -->
                            <td><?= $alumno->getId() ?></td>
                            <td><?= $alumno->getNombre() ?></td>
                            <td><?= $alumno->getApellidos() ?></td>
                            <td><?= $alumno->getEmail() ?></td>
                            <td><?= $alumno->getEdad() ?> años</td>
                            <td><?= $cursos[$alumno->getCurso()] ?></td>
                            <td><?= implode(', ', $obj_tabla_alumnos->mostrar_nombre_asignaturas($alumno->getAsignaturas())) ?></td>

                            <!-- Columna de acciones -->
                            <td>
                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <a href="eliminar.php?id=<?= $alumno->getId() ?>" title="Eliminar" class="btn btn-danger" onclick="return confirm('Confirmar eliminación del alumno')"><i class="bi bi-trash-fill" ></i></a>
                                <a href="editar.php?id=<?= $alumno->getId() ?>" title="Editar" class="btn btn-primary"><i class="bi bi-pencil-square" ></i></a>
                                <a href="mostrar.php?id=<?= $alumno->getId() ?>" title="Mostrar" class="btn btn-warning"><i class="bi bi-eye-fill" ></i></a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="8">Nº Registros <?= count($array_alumnos) ?></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <br><br><br>

    <!-- Pie del documento -->
    <?php include 'views/partials/partial.footer.php'; ?>

    <!-- Bootstrap Javascript y popper -->
    <?php include 'views/layouts/layout.javascript.html'; ?>


</body>

</html>