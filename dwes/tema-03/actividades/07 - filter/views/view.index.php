<!doctype html>
<html lang="es">

<head>
    <!-- Frameworks bootstrap -->
    <?php include 'views/layouts/head.html'; ?>

    <title>Tema 3 - Ejercicio 3</title>
</head>

<body>
    <!-- capa principal -->
    <div class="container">
        <!-- cabecera documento -->
        <?php include 'views/partials/header.php' ?>
        <!-- Menu libros  -->
        <?php include 'views/partials/m_libros.php'; ?>
        <legend>Tabla libros</legend>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Titulo</th>
                    <th scope="col">Autor</th>
                    <th scope="col">Editorial</th>
                    <th scope="col">Genero</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($libros as $registro): ?>
                    <tr class="">
                        <th><?= $registro['id'] ?></th>
                        <td><?= $registro['titulo'] ?></td>
                        <td><?= $registro['autor'] ?></td>
                        <td><?= $registro['editorial'] ?></td>
                        <td><?= $registro['genero'] ?></td>
                        <td><?= number_format($registro['precio'], 2, ',', '.')  ?> €</td>

                        <!-- Botones de acción  -->
                        <td>
                            <!-- boton borrar -->
                            <a href="delete.php?id=<?= $registro['id']?>" title="Eliminar"
                            onclick="return confirm('Confirmar eliminación del libro')">
                            <i class="bi bi-trash-fill"></i>
                            
                            <!-- boton editar  -->
                            <a href="edit.php?id=<?= $registro['id']?>" title="Editar">
                            <i class="bi bi-pencil-square"></i>

                            <!-- boton mostrar  -->
                            <a href="show.php?id=<?= $registro['id'] ?>" title="Mostrar">
                                <i class="bi bi-card-text"></i>
                        </td>

                            

                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>


        <!-- Pie del documento -->
        <?php include 'views/partials/footer.php'; ?>
    </div>
    <!-- javascript bootstrap 533 -->
    <?php include 'views/layouts/javascript.html'; ?>
</body>

</html>