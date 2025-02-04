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

        <!-- capa errores -->
        <?php require_once 'template/partials/error.partial.php' ?>

        <!-- Estilo card de bootstrap -->
        <div class="card">
            <div class="card-header">
                <!-- Protección ataques XSS -->
                <h5 class="card-title"><?= htmlspecialchars($this->title) ?></h5>
            </div>
            <div class="card-body">
                <!-- Formulario de libros  -->
                <form action="<?= URL ?>libro/update/<?= $this->id ?>/<?= $this->csrf_token?>" method="POST">

                    <!-- protección CSRF -->
                    <input type="hidden" name="csrf_token"
                        value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '') ?>">

                    <!-- id oculto -->
                    <!-- Tengo que pasar el id oculto para que el controlador pueda validar doblemente el id -->
                    <input type="number" class="form-control" name="id" 
                    value="<?= htmlspecialchars($this->libro->id) ?>" hidden>

                    <!-- Titulo -->
                    <div class="mb-3">
                        <label for="titulo" class="form-label">Título</label>
                        <input type="text" class="form-control
                        <?= (isset($this->error['titulo'])) ? 'is-invalid' : null ?>" id="titulo" name="titulo"
                            placeholder="Introduzca título" value="<?= htmlspecialchars($this->libro->titulo ?? '') ?>"
                            required>
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['titulo'] ?? null ?>
                        </span>
                    </div>

                    <!-- Select Dinámico autores -->
                    <div class="mb-3">
                        <label for="autor" class="form-label">Autor</label>
                        <select class="form-select 
                            <?= (isset($this->error['autor'])) ? 'is-invalid' : null ?>" id="autor" name="autor"
                            required>
                            <option selected disabled>Seleccione autor</option>
                            <!-- mostrar lista autores -->
                            <?php foreach ($this->autores as $indice => $data): ?>
                                <option value="<?= $indice ?>" <?= $this->libro->autor_id == $indice ? 'selected' : '' ?>>
                                    <?= $data ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <!-- mostrar posible error -->
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['autor'] ??= null ?>
                        </span>
                    </div>
                    <!-- Select Dinámico editorial -->
                    <div class="mb-3">
                        <label for="editorial" class="form-label">Editorial</label>
                        <select class="form-select 
                            <?= (isset($this->error['editorial'])) ? 'is-invalid' : null ?>" id="editorial"
                            name="editorial" required>
                            <option selected disabled>Seleccione Editorial</option>
                            <!-- mostrar lista editoriales -->
                            <?php foreach ($this->editoriales as $indice => $data): ?>
                                <option value="<?= $indice ?>" <?= $this->libro->editorial_id == $indice ? 'selected' : '' ?>>
                                    <?= $data ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <!-- mostrar posible error -->
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['editorial'] ??= null ?>
                        </span>
                    </div>
                    <!-- Precio -->
                    <div class="mb-3">
                        <label for="precio" class="form-label">Precio</label>
                        <input type="number" class="form-control
                        <?= (isset($this->error['precio'])) ? 'is-invalid' : null ?>" id="precio" name="precio"
                            placeholder="0.00" step="0.01" min="0"
                            value="<?= htmlspecialchars($this->libro->precio ?? '') ?>" required>
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['precio'] ?? null ?>
                        </span>
                    </div>

                    <!-- Unidades -->
                    <div class="mb-3">
                        <label for="unidades" class="form-label">Unidades</label>
                        <input type="number" class="form-control
                        <?= (isset($this->error['unidades'])) ? 'is-invalid' : null ?>" id="unidades" name="unidades"
                            placeholder="0" step="1" min="0" value="<?= htmlspecialchars($this->libro->stock ?? '') ?>"
                            >
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['unidades'] ?? null ?>
                        </span>
                    </div>

                    <!-- Fecha Edición -->
                    <div class="mb-3">
                        <label for="fecha_edicion" class="form-label">Fecha Edición</label>
                        <input type="date" class="form-control
                        <?= (isset($this->error['fecha_edicion'])) ? 'is-invalid' : null ?>" id="fecha_edicion"
                            name="fecha_edicion" value="<?= htmlspecialchars($this->libro->fecha_edicion ?? '') ?>"
                            required>
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['fecha_edicion'] ?? null ?>
                        </span>
                    </div>

                    <!-- ISBN -->
                    <div class="mb-3">
                        <label for="isbn" class="form-label">ISBN</label>
                        <input type="number" class="form-control
                        <?= (isset($this->error['isbn'])) ? 'is-invalid' : null ?>" id="isbn" name="isbn"
                            minlength="13" maxlength="13" placeholder="1234567890123"
                            value="<?= htmlspecialchars($this->libro->isbn ?? '') ?>" min="0" required>
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['isbn'] ?? null ?>
                        </span>
                    </div>

                    <!-- Géneros -->
                    <div class="mb-3">
                        <label for="generos" class="form-label">Seleccione Géneros</label>
                        <div class="form-control">
                            <?php foreach ($this->generos as $indice => $data): ?>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="genero_<?= $indice ?>"
                                        name="generos[]" value="<?= $indice ?>" <?= in_array($indice, $this->libro->generos ?? []) ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="genero_<?= $indice ?>">
                                        <?= htmlspecialchars($data) ?>
                                    </label>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['generos'] ?? null ?>
                        </span>
                    </div>

            </div>
            <div class="card-footer">
                <!-- Botones -->
                <a class="btn btn-secondary" href="<?= URL ?>libro" role="button"
                    onclick="return confirm('¿Estás seguro de que deseas cancelar? Se perderán los datos ingresados.')">Cancelar</a>
                <button type="reset" class="btn btn-danger">Borrar</button>
                <button type="submit" class="btn btn-primary">Enviar</button>
            </div>
            </form>
        </div>
        <br><br><br>
    </div>

    <!-- Footer -->
    <?php require_once 'template/partials/footer.partial.php' ?>
    <?php require_once 'template/layouts/javascript.layout.php' ?>

</body>

</html>