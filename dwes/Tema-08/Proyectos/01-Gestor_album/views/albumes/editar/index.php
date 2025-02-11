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
                <!-- Formulario de albums  -->
                <form action="<?= URL ?>album/update/<?= $this->id ?>/<?= $this->csrf_token?>" method="POST">

                    <!-- protección CSRF -->
                    <input type="hidden" name="csrf_token"
                        value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '') ?>">

                    <!-- id oculto -->
                    <!-- Tengo que pasar el id oculto para que el controlador pueda validar doblemente el id -->
                    <input type="number" class="form-control" name="id" 
                    value="<?= htmlspecialchars($this->album->id) ?>" hidden>
                    
                    <!-- titulo -->
                    <div class="mb-3">
                        <label for="titulo" class="form-label">Titulo</label>
                        <input type="text" class="form-control
                            <?= (isset($this->error['titulo'])) ? 'is-invalid' : null ?>" id="titulo" name="titulo"
                            placeholder="Introduzca titulo" value="<?= htmlspecialchars($this->album->titulo) ?>"
                            required>
                        <!-- mostrar posible error -->
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['titulo'] ??= null ?>
                        </span>
                    </div>

                    <!-- lugar -->
                    <div class="mb-3">
                        <label for="lugar" class="form-label">Lugar</label>
                        <input type="text" class="form-control
                            <?= (isset($this->error['lugar'])) ? 'is-invalid' : null ?>" id="lugar"
                            name="lugar" placeholder="Introduzca lugar"
                            value="<?= htmlspecialchars($this->album->lugar) ?>" required>
                        <!-- mostrar posible error -->
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['lugar'] ??= null ?>
                        </span>
                    </div>

                    <!-- Fecha Nacimiento -->
                    <div class="mb-3">
                        <label for="categoria" class="form-label">Fecha Nacimiento</label>
                        <input type="date" class="form-control 
                            <?= (isset($this->error['categoria'])) ? 'is-invalid' : null ?>" id="categoria" name="categoria"
                            value="<?= htmlspecialchars($this->album->categoria) ?>" required>
                        <!-- mostrar posible error -->
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['categoria'] ??= null ?>
                        </span>
                    </div>

                    <!-- Dni -->
                    <div class="mb-3">
                        <label for="dni" class="form-label">Dni</label>
                        <input type="text" class="form-control 
                            <?= (isset($this->error['dni'])) ? 'is-invalid' : null ?>" id="dni" name="dni"
                            placeholder="11111111A" value="<?= htmlspecialchars($this->album->dni) ?>" required
                            pattern="^[0-9]{8}[A-Za-z]{1}$" title="8 dígitos y una letra">
                        <!-- mostrar posible error -->
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['dni'] ??= null ?>
                        </span>
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control 
                            <?= (isset($this->error['email'])) ? 'is-invalid' : null ?>" id="email" name="email"
                            placeholder="email@ejemplo.es" value="<?= htmlspecialchars($this->album->email) ?>"
                            required>
                        <!-- mostrar posible error -->
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['email'] ??= null ?>
                        </span>
                    </div>

                    <!-- Telefono -->
                    <div class="mb-3">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="tel" class="form-control 
                            <?= (isset($this->error['telefono'])) ? 'is-invalid' : null ?>" id="telefono" name="telefono"
                            placeholder="666666666" value="<?= htmlspecialchars($this->album->telefono) ?>" required
                            title="9 dígitos">
                        <!-- mostrar posible error -->
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['telefono'] ??= null ?>
                        </span>
                    </div>

                    <!-- Nacionalidad -->
                    <div class="mb-3">
                        <label for="nacionalidad" class="form-label">Nacionalidad</label>
                        <input type="text" class="form-control 
                            <?= (isset($this->error['nacionalidad'])) ? 'is-invalid' : null ?>" id="nacionalidad"
                            name="nacionalidad" placeholder="Introduzca nacionalidad"
                            value="<?= htmlspecialchars($this->album->nacionalidad) ?>">
                        <!-- mostrar posible error -->
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['nacionalidad'] ??= null ?>
                        </span>
                    </div>

                    <!-- Select Dinámico Cursos -->
                    <div class="mb-3">
                        <label for="id_curso" class="form-label">Curso</label>
                        <select class="form-select 
                            <?= (isset($this->error['id_curso'])) ? 'is-invalid' : null ?>" id="id_curso" name="id_curso"
                            required>
                            <option selected disabled>Seleccione curso</option>
                            <!-- mostrar lista cucrsos -->
                            <?php foreach ($this->cursos as $indice => $data): ?>
                                <option value="<?= $indice ?>" <?= $this->album->id_curso == $indice ? 'selected' : '' ?>>
                                    <?= $data ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <!-- mostrar posible error -->
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['id_curso'] ??= null ?>
                        </span>
                    </div>
            </div>
            <div class="card-footer">
                <!-- botones de acción -->
                <a class="btn btn-secondary" href="<?= URL ?>album" role="button"
                    onclick="return confirm('¿Estás seguro de que deseas cancelar? Se perderán los datos ingresados.')">Cancelar</a>
                <button type="reset" class="btn btn-danger">Restaurar</button>
                <button type="submit" class="btn btn-primary">Actualizar</button>
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