<!DOCTYPE html>
<html lang="es">

<head>
    <?php include 'views/layouts/layout.head.html'; ?>
    <title>Mostrar Libro - CRUD Libros </title>
</head>

<body>
    <!-- Capa Principal -->
    <div class="container">

        <!-- Encabezado proyecto -->
        <?php include 'views/partials/partial.header.php'; ?>

        <legend>Formulario Editar Libro</legend>

        <!-- Formulario Editar artículo -->

        <form action="update.php?indice=<?= $indice ?>" method="POST">

            <!-- id -->
            <div class="mb-3">
                <label for="id" class="form-label">Id</label>
                <input type="text" class="form-control" name="id" value="<?= $libro->id?>" readonly>
            </div>

            <!-- Titulo -->
            <div class="mb-3">
                <label for="titulo" class="form-label">Titulo</label>
                <input type="text" class="form-control" name="titulo"  value="<?= $libro->titulo?>" readonly>
            </div>

            <!-- Autor -->
            <div class="mb-3">
                <label for="autor" class="form-label">Autor</label>
                <input type="text" class="form-control" name="autor"  value="<?= $libro->autor?>" readonly>
            </div>

            <!-- editorial -->
            <div class="mb-3">
                <label for="editorial" class="form-label">Editorial</label>
                <input type="text" class="form-control" name="editorial"  value="<?= $libro->editorial?>" readonly>
            </div>

            <!-- Fecha edición -->
            <div class="mb-3">
                <label for="fecha_edicion" class="form-label">Fecha de edición</label>
                <input type="text" class="form-control" name="fecha_edicion"  value="<?= $libro->fecha_edicion?>" readonly>
            </div>

            <!-- Select Dinámico materia -->
            <div class="mb-3">
                <label for="materia" class="form-label">Materia</label>
                <select class="form-select" name="materia" id="materia" disabled>
                    <!-- mostrar lista materia -->
                    <?php foreach($materia as $indice => $data):?>
                        <option value="<?= $indice ?>" <?= ($libro->materia == $indice) ? 'selected': null ?>>
                            <?= $data ?>
                        </option>
                    <?php endforeach;?>
                </select>
            </div>
            

            <!-- lista checbox dinámica etiquetas -->
            <div class="mb-3">
                <label for="etiquetas" class="form-label">Seleccione las etiquetas</label>
                <div class="form-control">
                    <!-- muestro el array categorías -->
                    <?php foreach($etiquetas as $indice => $data): ?>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="etiquetas[]" value="<?= $indice ?>" disabled
                            <?= (in_array($indice, $libro->etiquetas) ? 'checked' : null ) ?>>
                            <label class="form-check-label" >
                                <?= $data ?>
                            </label>
                        </div>
                    <?php endforeach; ?> 
                    
                </div>
            </div>

            <!-- Precio -->
            <div class="mb-3">
                <label for="precio" class="form-label">Precio (€)</label>
                <input type="number" class="form-control" name="precio" step="0.01"  value="<?= $libro->precio?>">
            </div>

            <!-- botones de acción -->
            <a class="btn btn-secondary" href="index.php" role="button">Volver</a>

        </form>

        <!-- Fin formulario nuevo artículo -->



    </div>
    <br><br><br>

    <!-- Pie del documento -->
    <?php include 'views/partials/partial.footer.php'; ?>

    <!-- Bootstrap Javascript y popper -->
    <?php include 'views/layouts/layout.javascript.html'; ?>


</body>

</html>