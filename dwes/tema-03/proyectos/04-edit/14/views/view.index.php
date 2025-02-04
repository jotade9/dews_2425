<!doctype html>
<html lang="es">

<head>
    <!-- Frameworks bootstrap  -->
    <?php include 'views/layouts/head.html' ?>
    <title>Proyecto 31 - CRUD Alumnos Array</title>
</head>

<body>
    <!-- capa principal -->
    <div class="container">

        <!-- cabecera documento -->
        <?php include 'views/partials/header.php'; ?>

        <!-- Mostrar la tabla alumnos  -->
        <legend>Tabla Alumnos</legend>

        <!-- Menu alumnos  -->
        <?php include 'views/partials/m_alumnos.php'; ?>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Población</th>
                    <th scope="col">Curso</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($alumnos as $registro): ?>
                    <tr class="">
                        <th><?= $registro['id'] ?></th>
                        <td><?= $registro['nombre'] ?></td>
                        <td><?= $registro['poblacion'] ?></td>
                        <td><?= $registro['curso'] ?></td>

                        <!-- Botones de acción  -->


                        <td>
                            <!-- boton de eliminar  -->
                            <a href="delete.php?id=<?= $registro['id'] ?>" title="Eliminar"
                                onclick="return confirm('Confirmar eliminación del alumno')">
                                <i class="bi bi-trash-fill"></i>
                                
                                <!-- boton editar  -->
                            <a href="edit.php?id=<?= $registro['id'] ?>" title="Editar">
                                <i class="bi bi-pencil-square"></i>
                        </td>
                    </tr>
                <?php endforeach ?>
                <tr>
                    <th colspan="6">Total alumnos: <?= count($alumnos) ?></td>
                </tr>
            </tbody>
        </table>


        <!-- pie de página -->
        <?php include 'views/partials/footer.php'; ?>
    </div>
    <!-- javascript bootstrap 533 -->
    <?php include 'views/layouts/javascript.html'; ?>
</body>

</html>