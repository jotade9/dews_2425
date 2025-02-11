<!doctype html>
<html lang="es">

<head>
    <?php require_once 'template/layouts/head.layout.php'; ?>
    <title><?= $this->title ?> </title>
</head>

<body>
    <!-- Menú fijo superior -->
    <?php require_once 'template/partials/menu.auth.partial.php' ?>

    <!-- Capa Principal -->
    <div class="container">
        <br><br><br><br>

        <!-- capa de mensajes -->
        <?php require_once 'template/partials/mensaje.partial.php' ?>

        <!-- capa errores -->
        <?php require_once 'template/partials/error.partial.php' ?>

        <!-- Estilo card de bootstrap -->
        <div class="card">
            <div class="card-header">
                <!-- Protección ataques XSS -->
                <h5 class="card-title"><?= htmlspecialchars($this->title) ?></h5>
            </div>
            <div class="card-body">
                <!-- Formulario de albumes  -->
                <form action="<?= URL ?>album/create" method="POST">

                    <!-- protección CSRF -->
                    <input type="hidden" name="csrf_token"
                        value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '') ?>">

                    <!-- titulo -->
                    <div class="mb-3">
                        <label for="titulo" class="form-label">Titulo</label>
                        <input type="text" class="form-control
                            <?= (isset($this->error['titulo']))? 'is-invalid': null ?>" 
                            id="titulo" name="titulo"
                            placeholder="Introduzca titulo" value="<?= htmlspecialchars($this->album->titulo) ?>"
                            required>
                        <!-- mostrar posible error -->
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['titulo'] ??= null ?>
                        </span>
                    </div>
                    <!-- descripcion -->
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <input type="text" class="form-control
                            <?= (isset($this->error['descripcion']))? 'is-invalid': null ?>" 
                            id="descripcion" name="descripcion"
                            placeholder="Introduzca descripcion" value="<?= htmlspecialchars($this->album->descripcion) ?>"
                            required>
                        <!-- mostrar posible error -->
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['descripcion'] ??= null ?>
                        </span>   
                    </div>
                    <!-- Fecha -->
                    <div class="mb-3">
                        <label for="fecha" class="form-label">Fecha</label>
                        <input type="date" class="form-control 
                            <?= (isset($this->error['fecha']))? 'is-invalid': null ?>" 
                            id="fecha" name="fecha"
                            value="<?= htmlspecialchars($this->album->fecha) ?>" required>
                        <!-- mostrar posible error -->
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['fecha'] ??= null ?>
                        </span>
                    </div>
                    
                    <!-- autor -->
                    <div class="mb-3">
                        <label for="autor" class="form-label">Autor</label>
                        <input type="text" class="form-control 
                            <?= (isset($this->error['autor']))? 'is-invalid': null ?>" 
                            id="autor" name="autor"
                            placeholder="Introduzca Autor" 
                            value="<?= htmlspecialchars($this->album->autor) ?>">
                        <!-- mostrar posible error -->
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['autor'] ??= null ?>
                        </span>
                    </div>
                    <!-- lugar -->
                    <div class="mb-3">
                        <label for="lugar" class="form-label">Lugar</label>
                        <input type="text" class="form-control 
                            <?= (isset($this->error['lugar']))? 'is-invalid': null ?>" 
                            id="lugar" name="lugar"
                            placeholder="Introduzca Lugar" 
                            value="<?= htmlspecialchars($this->album->lugar) ?>">
                        <!-- mostrar posible error -->
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['lugar'] ??= null ?>
                        </span>
                    </div>
                    <!-- categoria -->
                    <div class="mb-3">
                        <label for="categoria" class="form-label">Categoria</label>
                        <input type="text" class="form-control 
                            <?= (isset($this->error['categoria']))? 'is-invalid': null ?>" 
                            id="categoria" name="categoria"
                            placeholder="Introduzca Categoria" 
                            value="<?= htmlspecialchars($this->album->categoria) ?>">
                        <!-- mostrar posible error -->
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['categoria'] ??= null ?>
                        </span>
                    </div>
                    <!-- etiquetas -->
                    <div class="mb-3">
                        <label for="etiquetas" class="form-label">Etiquetas</label>
                        <input type="text" class="form-control 
                            <?= (isset($this->error['etiqueta']))? 'is-invalid': null ?>" 
                            id="etiqueta" name="etiqueta"
                            placeholder="Introduzca Etiquetas" 
                            value="<?= htmlspecialchars($this->album->etiqueta) ?>">
                        <!-- mostrar posible error -->
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['etiqueta'] ??= null ?>
                        </span>
                    </div>
                    <!-- carpeta -->
                    <div class="mb-3">
                        <label for="carpeta" class="form-label">Carpeta</label>
                        <input type="text" class="form-control 
                            <?= (isset($this->error['carpeta']))? 'is-invalid': null ?>" 
                            id="carpeta" name="carpeta"
                            placeholder="Introduzca Carpeta" 
                            value="<?= htmlspecialchars($this->album->carpeta) ?>">
                        <!-- mostrar posible error -->
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['carpeta'] ??= null ?>
                        </span>
                    </div>
            </div>
            <div class="card-footer">
                <!-- botones de acción -->
                <a class="btn btn-secondary" href="<?= URL ?>album" role="button" 
                onclick="return confirm('¿Estás seguro de que deseas cancelar? Se perderán los datos ingresados.')">Cancelar</a>
                <button type="reset" class="btn btn-danger">Borrar</button>
                <button type="submit" class="btn btn-primary">Enviar</button>
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