<!doctype html>
<html lang="es">

<head>
    <?php require_once 'template/layouts/head.layout.php'; ?>
    <title>Login - Autenticación Usuarios </title>
</head>

<body>
    <!-- Menú fijo superior -->
    <?php require_once 'template/partials/menu.auth.partial.php' ?>

    <!-- Capa Principal -->
    <div class="container">
        <br><br><br><br><br>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <?php require_once("template/partials/mensaje.partial.php") ?>
                <?php require_once("template/partials/error.partial.php") ?>
                <div class="card">
                    <div class="card-header"></div>
                    <div class="card-body">
                        <form method="POST">
                            <!--Campo nombre-->
                            <div class="mb-3 row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Nombre</label>
                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control" name="name" value="<?= htmlspecialchars($this->perfil->name); ?>" >
                                </div>
                            </div>
                            <!--campo email-->
                            <div class="mb-3 row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Email</label>
                                <div class="col-md-6">
                                    <input id="email" type="text"
                                        class="form-control" name="email" value="<?= htmlspecialchars($this->perfil->email); ?>" >
                                </div>
                            </div>
                            <!--campo rol-->
                            <div class="mb-3 row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Rol</label>
                                <div class="col-md-6">
                                    <input id="role" type="text"
                                        class="form-control" name="role" value="<?= htmlspecialchars($_SESSION['role_name']); ?>" >
                                </div>

                            <!-- botones de acción -->

                            <div class="mb-3 row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <a class="btn btn-secondary" href="<?= URL ?>alumno" role="button">Salir</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <!-- /.container -->

    <?php require_once 'template/partials/footer.partial.php' ?>
    <?php require_once 'template/layouts/javascript.layout.php' ?>

</body>

</html>