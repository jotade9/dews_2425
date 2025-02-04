<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Proyecto Alumnos Array</title>
    <!-- css bootstrap 533 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- bootstrap icons 1.11.3 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body>
    <!-- capa principal -->
    <div class="container">

        <!-- cabecera documento -->
        <header class="pb-3 mb-4 border-bottom">
            <i class="bi bi-calculator"></i>
            <span class="fs-6">Proyecto Alumnos Array</span>
        </header>
        <!-- Mostrar la tabla de alumnos  -->
        <legend>Formulario Nuevo Alumno</legend>
        <!-- Formulario Nuevo Alumno  -->
        <form action="new.php" method="POST">

            <!-- id  -->
            <div class="mb-3 row">
                <label for="inputid" class="col-sm-2 col-form-label">Id:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputid" name ="id">
                </div>
            </div>
            <!-- nombre -->
            <div class="mb-3 row">
                <label for="inputnombre" class="col-sm-2 col-form-label">Nombre:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputnombre" name="nombre">
                </div>
            </div>
            <!-- poblacion -->
            <div class="mb-3 row">
                <label for="inputpoblacion" class="col-sm-2 col-form-label">Poblacion:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputpoblacion" name="poblacion">
                </div>
            </div>
            <!-- curso  -->
            <div class="mb-3 row">
                <label for="inputcurso" class="col-sm-2 col-form-label">Curso:</label>
                <div class="col-sm-10">
                    <input type="curso" class="form-control" id="inputcurso" name="curso">
                </div>
            </div>
            <!-- Botones de accion  -->

            <a class="btn btn-secondary" href="index.php" role="button">Cancelar</a>
            <button type="reset" class="btn btn-danger">Borrar</button>
            <button type="submit" formaction="create.php" class="btn btn-primary">Enviar</button>

        </form>
        <!-- pie de página -->
        <footer class="footer mt-auto py-3 fixed-bottom bg-light">
            <div class="container">
                <span class="text-muted">© 2024
                    Juan Diego Pérez López - DWES - 2º DAW - Curso 24/25
                </span>
            </div>
        </footer>
    </div>
    <!-- javascript bootstrap 533 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>