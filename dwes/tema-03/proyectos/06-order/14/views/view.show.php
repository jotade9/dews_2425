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
            <!-- nombre -->
            <div class="mb-3 row">
                <label for="inputnombre" class="col-sm-2 col-form-label">Nombre:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputnombre" name="nombre" value="<?=$registro['nombre'];?>"disabled>
                </div>
            </div>
            <!-- poblacion -->
            <div class="mb-3 row">
                <label for="inputpoblacion" class="col-sm-2 col-form-label">Poblacion:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputpoblacion" name="poblacion" value="<?=$registro['poblacion'];?>"disabled>
                </div>
            </div>
            <!-- curso  -->
            <div class="mb-3 row">
                <label for="inputcurso" class="col-sm-2 col-form-label">Curso:</label>
                <div class="col-sm-10">
                    <input type="curso" class="form-control" id="inputcurso" name="curso" value="<?=$registro['curso'];?>"disabled>
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