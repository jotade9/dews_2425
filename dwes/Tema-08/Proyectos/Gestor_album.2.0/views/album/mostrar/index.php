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

                    <table class="table">
                        <tbody>
                            <tr>
                                <th scope="col">Titulo</th>
                                <td>
                                    <?= $this->album->titulo ?>
                                </td>
                            </tr>
                            <tr>
                                <th scope="col">Descripción</th>
                                <td>
                                    <?= $this->album->descripcion ?>
                                </td>
                            </tr>
                            <tr>
                                <th scope="col">Autor</th>
                                <td>
                                    <?= $this->album->autor ?>
                                </td>
                            </tr>
                            <tr>
                                <th scope="col">Fecha</th>
                                <td>
                                    <?= $this->album->fecha ?>
                                </td>
                            </tr>
                            <tr>
                                <th scope="col">Lugar</th>
                                <td>
                                    <?= $this->album->lugar ?>
                                </td>
                            </tr>
                            <tr>
                                <th scope="col">Categorías</th>
                                <td>
                                <?=$this->categorias[$this->album->id_categoria]?>
                                </td>
                            </tr>
                            <tr>
                                <th scope="col">Etiquetas</th>
                                <td>
                                <?=$this->album->etiquetas?>
                                </td>
                            </tr>
                            <tr>
                                <th scope="col">Nº Fotos</th>
                                <td>
                                <?=$this->album->num_fotos?>
                                </td>
                            </tr>
                            <tr>
                                <th scope="col">Nº Visitas</th>
                                <td>
                                <?=$this->album->num_visitas?>
                                </td>
                            </tr>
                            <tr>
                                <th scope="col">Carpeta</th>
                                <td>
                                <?=$this->album->carpeta?>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <?php
                    // Obtenemos la ruta de la carpeta de imágenes
                    $rutaCarpeta = 'images/' . $this->album->carpeta;

                    // Obtenemos la lista de archivos
                    $archivos = scandir($rutaCarpeta);

                    // Filtramos los archivos para solo subir imágenes jpg, jpeg, png y gif
                    $imagenes = array_filter($archivos, function ($archivo) {
                        // Especificamos la extensión de los archivos que se pueden subir
                        $extension = strtolower(pathinfo($archivo, PATHINFO_EXTENSION));
                        return in_array($extension, ['png', 'gif', 'jpg', 'jpeg']);
                    });

                    // Creamos la estructura del carrusel con las imágenes
                    ?>
                    <div id="carouselExampleDark" class="carousel carousel-dark slide">
                        <div class="carousel-indicators">
                            <?php $contador = 0; ?>
                            <?php foreach (glob("images/" . $this->album->carpeta . "/*") as $imagen): ?>
                                <button type="button" data-bs-target="#carouselExampleDark"
                                    data-bs-slide-to="<?= $contador ?>" <?= ($contador == 0) ? 'class="active" aria-current="true"' : null ?>
                                    aria-label="Slide <?= $contador ?>"></button>
                                <?php $contador++; ?>
                            <?php endforeach; ?>
                        </div>
                        <div class="carousel-inner">

                            <!-- Recorremos todas las imagenes -->
                            <?php $contador = 0; ?>
                            <?php foreach (glob("images/" . $this->album->carpeta . "/*") as $imagen): ?>

                                <!-- Si es la primera, la ponemos activa -->
                                <div class="carousel-item <?= ($contador == 0) ? 'active' : '' ?>" data-bs-interval="5000">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <img src="<?= URL . $imagen ?>" class="d-block" style="height: 1000px; object-fit: cover;" alt="...">
                                    </div>
                                    <div class="carousel-caption d-none d-md-block" style="color: white;">
                                        <h5><?= $this->album->titulo ?></h5>
                                        <p><?= $this->album->fecha ?></p>
                                    </div>
                                </div>

                                <?php $contador++; ?>
                            <?php endforeach; ?>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
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