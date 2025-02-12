<!DOCTYPE html>
<html lang="es">

<head>
    <!-- head -->
    <?php require_once("template/partials/head.php") ?>
    <title><?= $this->title ?></title>
</head>

<body>
    <!-- Menú Principal -->
    <?php require_once("template/partials/menuAut.php") ?>
    <br><br><br>

    <!-- Capa principal -->
    <div class="container">

        <!-- header -->
        <?php include 'views/album/partials/header.php' ?>

        <!-- comprobamos si existe error -->
        <?php include 'template/partials/error.php' ?>

        <legend>Detalle de Álbum</legend>

        <!-- Formulario de Detalle de Álbum -->
        <form>

            <!-- id -->
            <div class="mb-3">
                <label for="id" class="form-label">ID</label>
                <input type="text" class="form-control" name="id" value="<?= $this->album->id ?>" readonly>
            </div>

            <!-- Título -->
            <div class="mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" class="form-control" name="titulo" value="<?= $this->album->titulo ?>" readonly>
            </div>

            <!-- Descripción -->
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control" name="descripcion" disabled><?= $this->album->descripcion ?></textarea>
            </div>

            <!-- Autor -->
            <div class="mb-3">
                <label for="autor" class="form-label">Autor</label>
                <input type="text" class="form-control" name="autor" value="<?= $this->album->autor ?>" readonly>
            </div>

            <!-- Fecha -->
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha</label>
                <input type="date" class="form-control" name="fecha" value="<?= $this->album->fecha ?>" readonly>
            </div>

            <!-- Lugar -->
            <div class="mb-3">
                <label for="lugar" class="form-label">Lugar</label>
                <input type="text" class="form-control" name="lugar" value="<?= $this->album->lugar ?>" readonly>
            </div>

            <!-- Categoría -->
            <div class="mb-3">
                <label for="categoria" class="form-label">Categoría</label>
                <input type="text" class="form-control" name="categoria" value="<?= $this->album->categoria ?>" readonly>
            </div>

            <!-- Etiquetas -->
            <div class="mb-3">
                <label for="etiquetas" class="form-label">Etiquetas</label>
                <input type="text" class="form-control" name="etiquetas" value="<?= $this->album->etiquetas ?>" readonly>
            </div>

            <!-- Número de Fotos -->
            <div class="mb-3">
                <label for="num_fotos" class="form-label">Número de Fotos</label>
                <input type="number" class="form-control" name="num_fotos" value="<?= $this->album->num_fotos ?>" readonly>
            </div>

            <!-- Número de Visitas -->
            <div class="mb-3">
                <label for="num_visitas" class="form-label">Número de Visitas</label>
                <input type="number" class="form-control" name="num_visitas" value="<?= $this->album->num_visitas ?>" readonly>
            </div>

            <!-- Carpeta -->
            <div class="mb-3">
                <label for="carpeta" class="form-label">Carpeta</label>
                <input type="text" class="form-control" name="carpeta" value="<?= $this->album->carpeta ?>" readonly>
            </div>

            <br><br>

            <!-- Imágenes -->
            <h2>Imagen</h2>
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
                    return in_array($extension, ['png', 'gif','jpg', 'jpeg']);
                });

                //Mostramos las imágenes
                foreach ($imagenes as $imagen) : ?>
                    <div class="col-md-3">
                        <img src="<?= URL . $rutaCarpeta . '/' . $imagen ?>" class="img-fluid mb-2">
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- botones de acción -->
            <a class="btn btn-secondary" href="<?= URL ?>album" role="button">Volver</a>

        </form>

        <br>
        <br>
        <br>

        <!-- Pié del documento -->
        <?php include 'template/partials/footer.php' ?>

    </div>

    <!-- javascript bootstrap 532 -->
    <?php include 'template/partials/javascript.php' ?>
</body>

</html>