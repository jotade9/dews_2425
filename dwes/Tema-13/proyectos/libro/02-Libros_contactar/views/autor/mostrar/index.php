<!doctype html>
<html lang="es">

<head>
    <?php require_once 'template/layouts/head.layout.php'; ?>
    <title><?= $this->title ?> </title>
</head>

<body>
    <!-- Menú fijo superior -->
    <?php require_once 'template/partials/menu.partial.php' ?>

    <!-- Capa Principal -->
    <div class="container">
        <br><br><br><br>

        <!-- capa de mensajes -->
        <?php require_once 'template/partials/mensaje.partial.php' ?>

        <!-- Estilo card de bootstrap -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title"><?= $this->title ?></h5>
            </div>
            <div class="card-body">
                <!-- Formulario de autors  sin edicion-->
                <form>

                    <!-- id -->
                    <div class="mb-3">
                        <label for="id" class="form-label">Id</label>
                        <input type="number" class="form-control" value="<?= $this->autor->id ?>" disabled>
                    </div>

                    <!-- nombre -->
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Título</label>
                        <input type="text" class="form-control" value="<?= $this->autor->nombre ?>" disabled>
                    </div>

                    <!-- nacionalidad -->
                    <div class="mb-3">
                        <label for="nacionalidad" class="form-label">Nacionalidad</label>
                        <input type="text" class="form-control" value="<?= $this->autor->nacionalidad ?>" disabled>
                    </div>
                    
                    <!-- email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" value="<?= $this->autor->email ?>" disabled>
                    </div>

                    <!-- fecha_nac -->
                    <div class="mb-3">
                        <label for="fecha_nac" class="form-label">Fecha Nacimiento</label>
                        <input type="date" class="form-control" value="<?= $this->autor->fecha_nac ?>" disabled>
                    </div>

                    

                    <!-- fecha_def -->
                    <div class="mb-3">
                        <label for="fecha_def" class="form-label">Fecha de defunción</label>
                        <input type="date" class="form-control" value="<?= $this->autor->fecha_def ?>" disabled>
                    </div>

                    <!-- premios -->
                    <div class="mb-3">
                        <label for="premios" class="form-label">Premios</label>
                        <input type="number" class="form-control" value="<?= $this->autor->premios ?>" disabled>
                    </div>
                    

            </div>
            <div class="card-footer">
                <!-- botones de acción -->
                <a class="btn btn-secondary" href="<?= URL ?>autor" role="button">Volver</a>
            </div>
            </form>
            <!-- Fin formulario nuevo artículo -->
        </div>
        <br><br><br>

    </div>

    <!-- /.container -->

    <?php require_once 'template/partials/footer.partial.php' ?>
    <?php require_once 'template/layouts/javascript.layout.php' ?>

</body>

</html>