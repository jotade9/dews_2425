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
                <form>

                    <!-- protección CSRF -->
                    <input type="hidden" name="csrf_token"
                        value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '') ?>">

                    <!-- titulo -->
                    <div class="mb-3">
                        <label for="titulo" class="form-label">Título</label>
                        <input type="text" class="form-control
                            <?= (isset($this->error['titulo'])) ? 'is-invalid' : null ?>" id="titulo" name="titulo"
                            placeholder="Introduzca título" value="<?= htmlspecialchars($this->album->titulo) ?>"
                            disabled>
                        <!-- mostrar posible error -->
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['titulo'] ??= null ?>
                        </span>
                    </div>


                    <!-- descripcion -->
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <input type="text" class="form-control
                            <?= (isset($this->error['descripcion'])) ? 'is-invalid' : null ?>" id="descripcion"
                            name="descripcion" placeholder="Introduzca descripción"
                            value="<?= htmlspecialchars($this->album->descripcion) ?>" disabled>
                        <!-- mostrar posible error -->
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['descripcion'] ??= null ?>
                        </span>
                    </div>

                    <!-- autor -->
                    <div class="mb-3">
                        <label for="autor" class="form-label">Autor</label>
                        <input type="text" class="form-control
                            <?= (isset($this->error['autor'])) ? 'is-invalid' : null ?>" id="autor" name="autor"
                            placeholder="Introduzca autor" value="<?= htmlspecialchars($this->album->autor) ?>"
                            disabled>
                        <!-- mostrar posible error -->
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['autor'] ??= null ?>
                        </span>
                    </div>


                    <!-- Fecha -->
                    <div class="mb-3">
                        <label for="fecha" class="form-label">Fecha</label>
                        <input type="date" class="form-control 
                            <?= (isset($this->error['fecha'])) ? 'is-invalid' : null ?>" id="fecha" name="fecha"
                            value="<?= htmlspecialchars($this->album->fecha) ?>" disabled>
                        <!-- mostrar posible error -->
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['fecha'] ??= null ?>
                        </span>
                    </div>


                    <!-- lugar -->
                    <div class="mb-3">
                        <label for="lugar" class="form-label">Lugar</label>
                        <input type="text" class="form-control
                            <?= (isset($this->error['lugar'])) ? 'is-invalid' : null ?>" id="lugar" name="lugar"
                            placeholder="Introduzca lugar" value="<?= htmlspecialchars($this->album->lugar) ?>"
                            disabled>
                        <!-- mostrar posible error -->
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['lugar'] ??= null ?>
                        </span>
                    </div>



                    <!-- Select Dinámico categorias -->
                    <div class="mb-3">
                        <label for="id_categoria" class="form-label">Categoria</label>
                        <select class="form-select 
                            <?= (isset($this->error['id_categoria'])) ? 'is-invalid' : null ?>" id="id_categoria"
                            name="id_categoria" disabled>
                            <option selected disabled>Seleccione categoria</option>
                            <!-- mostrar lista cucrsos -->
                            <?php foreach ($this->categorias as $indice => $data): ?>
                                <option value="<?= $indice ?>" <?= $this->album->id_categoria == $indice ? 'selected' : '' ?>>
                                    <?= $data ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <!-- mostrar posible error -->
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['id_categoria'] ??= null ?>
                        </span>
                    </div>


                    <!-- etiqueta -->
                    <div class="mb-3">
                        <label for="etiquetas" class="form-label">Etiquetas</label>
                        <input type="text" class="form-control
                            <?= (isset($this->error['etiquetas'])) ? 'is-invalid' : null ?>" id="etiquetas"
                            name="etiquetas" placeholder="Sin etiquetas"
                            value="<?= htmlspecialchars($this->album->etiquetas) ?>" disabled>
                        <!-- mostrar posible error -->
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['etiquetas'] ??= null ?>
                        </span>
                    </div>


                    <!-- num_fotos -->
                    <div class="mb-3">
                        <label for="num_fotos" class="form-label">Nº fotos</label>
                        <input type="text" class="form-control
                            <?= (isset($this->error['num_fotos'])) ? 'is-invalid' : null ?>" id="num_fotos"
                            name="num_fotos" placeholder="Sin fotos"
                            value="<?= htmlspecialchars($this->album->num_fotos) ?>" disabled>
                        <!-- mostrar posible error -->
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['num_fotos'] ??= null ?>
                        </span>
                    </div>


                    <!-- num_visitas -->
                    <div class="mb-3">
                        <label for="num_visitas" class="form-label">Nº visitas</label>
                        <input type="text" class="form-control
                            <?= (isset($this->error['num_visitas'])) ? 'is-invalid' : null ?>" id="num_visitas"
                            name="num_visitas" placeholder="Sin visitas"
                            value="<?= htmlspecialchars($this->album->num_visitas) ?>" disabled>
                        <!-- mostrar posible error -->
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['num_visitas'] ??= null ?>
                        </span>
                    </div>


                    <!-- carpeta -->
                    <div class="mb-3">
                        <label for="carpeta" class="form-label">Carpetas</label>
                        <input type="text" class="form-control
                            <?= (isset($this->error['carpeta'])) ? 'is-invalid' : null ?>" id="carpeta" name="carpeta"
                            placeholder="Introduzca carpeta" value="<?= htmlspecialchars($this->album->carpeta) ?>"
                            disabled>
                        <!-- mostrar posible error -->
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['carpeta'] ??= null ?>
                        </span>
                    </div>

                    <!-- Imágenes -->
                    <h2>Imágenes</h2>
                    <div class="row">
                        <?php
                        //Obtenemos la ruta de la carpeta de imágenes
                        $rutaCarpeta = 'images/' . $this->album->carpeta;

                        //Obtenemos la lista de archivos
                        $archivos = scandir($rutaCarpeta);

                        //Filtramos los archivos para solo subir imágens jpg, jpeg, png y gif
                        $imagenes = array_filter($archivos, function ($archivo) {
                            //Especificamos la extension de los archivos que se pueden subir
                            $extension = strtolower(pathinfo($archivo, PATHINFO_EXTENSION));
                            return in_array($extension, ['png', 'gif', 'jpg', 'jpeg']);
                        });

                        //Mostramos las imágenes
                        foreach ($imagenes as $imagen): ?>
                            <div class="col-md-3">
                                <img src="<?= URL . $rutaCarpeta . '/' . $imagen ?>" class="img-fluid mb-2">
                            </div>
                        <?php endforeach; ?>
                    </div>





            </div>
            <div class="card-footer">
                <!-- botones de acción -->
                <a class="btn btn-secondary" href="<?= URL ?>album" role="button">Volver</a>
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