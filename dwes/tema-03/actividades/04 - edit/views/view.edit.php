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

        <!-- Mostrar la tabla de libros -->
        <legend>Formulario Editar libro</legend>

        <!-- Formulario Nuevo libro -->
        <form action="update.php?id=<?= $id ?>" method="POST">

            <!-- id -->
            <div class="mb-3 row">
                <label for="inputid" class="col-sm-2 col-form-label">Id:</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="inputid" name="id" value="<?= $registro['id'];?>" readonly>
                </div>
            </div>
            <!-- titulo -->
            <div class="mb-3 row">
                <label for="inputtitulo" class="col-sm-2 col-form-label">Titulo:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputtitulo" name="titulo" value="<?= $registro['titulo'];?>">
                </div>
            </div>
            <!-- autor  -->
            <div class="mb-3 row">
                <label for="inputautor" class="col-sm-2 col-form-label">Autor:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputautor" name="autor" value="<?= $registro['autor'];?>">
                </div>
            </div>
            <!-- editorial  -->
            <div class="mb-3 row">
                <label for="inputeditorial" class="col-sm-2 col-form-label">Editorial:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputeditorial" name="editorial" value="<?= $registro['editorial'];?>">
                </div>
            </div>
            <!-- genero  -->
            <div class="mb-3 row">
                <label for="inputgenero" class="col-sm-2 col-form-label">Genero:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputgenero" name="genero" value="<?= $registro['genero'];?>">
                </div>
            </div>
            <!-- precio  -->
            <div class="mb-3 row">
                <label for="inputprecio" class="col-sm-2 col-form-label">Precio:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputprecio" name="precio" value="<?= $registro['precio'];?>">
                </div>
            </div>

            <!-- botones de acción -->
            <a class="btn btn-secondary" href="index.php" role="button">Cancelar</a>
            <button type="reset" class="btn btn-danger">Borrar</button>
            <button type="submit" class="btn btn-primary">Actualizar</button>
 
        </form>
        <!-- fin formulario -->


        <!-- Pie del documento -->
        <?php include 'views/partials/footer.php'; ?>

    </div>
    
    <!-- javascript bootstrap 533 -->
    <?php include 'views/layouts/javascript.html'; ?>
</body>

</html>