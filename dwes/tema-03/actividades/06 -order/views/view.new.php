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
        <!-- Mostrar la tabla de alumnos  -->
        <legend>Formulario Añadir Libro</legend>
        <!-- Formulario Nuevo Alumno  -->
        <form action="new.php" method="POST">

            <!-- id  -->
            <div class="mb-3 row">
                <label for="inputid" class="col-sm-2 col-form-label">Id:</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="inputid" name ="id">
                </div>
            </div>
            <!-- titulo -->
            <div class="mb-3 row">
                <label for="inputtitulo" class="col-sm-2 col-form-label">Titulo:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputtitulo" name="titulo">
                </div>
            </div>
            <!-- autor -->
            <div class="mb-3 row">
                <label for="inputautor" class="col-sm-2 col-form-label">Autor:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputautor" name="autor">
                </div>
            </div>
            <!-- editorial  -->
            <div class="mb-3 row">
                <label for="inputeditorial" class="col-sm-2 col-form-label">Editorial:</label>
                <div class="col-sm-10">
                    <input type="editorial" class="form-control" id="inputeditorial" name="editorial">
                </div>
            </div>
            <!-- genero  -->
            <div class="mb-3 row">
                <label for="inputgenero" class="col-sm-2 col-form-label">Genero:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputgenero" name="genero">
                </div>
            </div>
            <!-- precio  -->
            <div class="mb-3 row">
                <label for="inputprecio" class="col-sm-2 col-form-label">Precio:</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="inputprecio" name="precio">
                </div>
            </div>
            

            <!-- Botones de accion  -->

            <a class="btn btn-secondary" href="index.php" role="button">Cancelar</a>
            <button type="reset" class="btn btn-secondary">Reset</button>
            <button type="submit" formaction="create.php" class="btn btn-primary">Añadir</button>

        </form>
        <!-- Pie del documento -->
        <?php include 'views/partials/footer.php'; ?>
    </div>
    <!-- javascript bootstrap 533 -->
    <?php include 'views/layouts/javascript.html'; ?>    
</body>

</html>