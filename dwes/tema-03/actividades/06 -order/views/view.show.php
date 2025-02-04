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

        <!-- Mostrar la tabla de alumnos  -->
        <legend>Formulario Mostrar Alumno</legend>

        <!-- Formulario Nuevo Alumno  -->
        <form>

            <!-- id  -->
            <div class="mb-3 row">
                <label for="inputid" class="col-sm-2 col-form-label">Id:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputid" name="id" value="<?=$registro['id'];?>" disabled>
                </div>
            </div>
            <!-- titulo -->
            <div class="mb-3 row">
                <label for="inputtitulo" class="col-sm-2 col-form-label">Titulo:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputtitulo" name="titulo" value="<?=$registro['titulo'];?>"disabled>
                </div>
            </div>
            <!-- autor -->
            <div class="mb-3 row">
                <label for="inputautor" class="col-sm-2 col-form-label">Autor:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputautor" name="autor" value="<?=$registro['autor'];?>"disabled>
                </div>
            </div>
            <!-- editorial  -->
            <div class="mb-3 row">
                <label for="inputeditorial" class="col-sm-2 col-form-label">Editorial:</label>
                <div class="col-sm-10">
                    <input type="editorial" class="form-control" id="inputeditorial" name="editorial" value="<?=$registro['editorial'];?>"disabled>
                </div>
            </div>
            <!-- genero  -->
            <div class="mb-3 row">
                <label for="inputgenero" class="col-sm-2 col-form-label">Genero:</label>
                <div class="col-sm-10">
                    <input type="genero" class="form-control" id="inputgenero" name="genero" value="<?=$registro['genero'];?>"disabled>
                </div>
            </div>
            <!-- precio  -->
            <div class="mb-3 row">
                <label for="inputprecio" class="col-sm-2 col-form-label">Precio:</label>
                <div class="col-sm-10">
                    <input type="precio" class="form-control" id="inputprecio" name="precio" value="<?=$registro['precio'];?>"disabled>
                </div>
            </div>
            
            <!-- Botones de accion  -->
            <a class="btn btn-secondary" href="index.php" role="button">Volver</a>

        </form>

        <!-- pie de página -->
        <?php include 'views/partials/footer.php'; ?>

    </div>

    <!-- javascript bootstrap 533 -->
    <?php include 'views/layouts/javascript.html'; ?>
</body>

</html>