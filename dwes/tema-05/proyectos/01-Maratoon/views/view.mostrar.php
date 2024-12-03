<!DOCTYPE html>
<html lang="es">

<head>
    <?php include 'views/layouts/layout.head.html'; ?>
    <title>Mostrar Corredor - CRUD Corredores </title>
</head>

<body>
    <!-- Capa Principal -->
    <div class="container">

        <!-- Encabezado proyecto -->
        <?php include 'views/partials/partial.header.php'; ?>

        <legend>Formulario Mostrar Corredor</legend>

        <!-- Formulario Nuevo corredor -->

        <form >
            <!-- id -->
            <div class="mb-3">
                <label for="id" class="form-label">Id</label>
                <input type="text" class="form-control" name="id" value="<?= $corredor->id?>" disabled>
            </div>

            <!-- Nombre -->
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre" value="<?= $corredor->nombre ?>" disabled >
            </div>
            <!-- Apellidos -->
            <div class="mb-3">
                <label for="apellidos" class="form-label">Apellidos</label>
                <input type="text" class="form-control" name="apellidos" value="<?= $corredor->apellidos ?>" disabled>
            </div>
            <!-- Ciudad-->
            <div class="mb-3">
                <label for="ciudad" class="form-label">Ciudad</label>
                <input type="text" class="form-control" name="ciudad" value="<?= $corredor->ciudad ?>" disabled>
            </div>
            <!-- Fecha Nacimiento -->
            <div class="mb-3">
                <label for="fechaNacimiento" class="form-label">Fecha Nacimiento</label>
                <input type="date" class="form-control" name="fechaNacimiento" value="<?= $corredor->fechaNacimiento ?>" disabled>
            </div>
            <!-- sexo -->
            <div class="mb-3">
                <label class="form-label">Sexo</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="sexo" id="masculino" value="H" <?= ( $corredor->sexo == 'H' )? 'checked' : null ?> disabled>
                    <label class="form-check-label" for="masculino">Masculino</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="sexo" id="femenino" value="M" <?= ( $corredor->sexo == 'M' )? 'checked' : null ?> disabled>
                    <label class="form-check-label" for="femenino">Femenino</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="sexo" id="otro" value="" <?= ( $corredor->sexo == '' )? 'checked' : null ?> disabled>
                    <label class="form-check-label" for="otro">Sin especificar</label>
                </div>
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" value="<?= $corredor->email ?>" disabled>
            </div>
            <!-- dni -->
            <div class="mb-3">
                <label for="dni" class="form-label">Dni</label>
                <input type="text" class="form-control" name="dni" value="<?= $corredor->dni ?>" disabled>
            </div>

            <!-- Select Dinámico categorias -->
            <div class="mb-3">
                <label for="categoria" class="form-label">Categoria</label>
                <select class="form-select" name="id_categoria" disabled>
                    <option selected disabled>Seleccione Categoria</option>
                    <!-- mostrar lista categorias -->
                    <?php foreach ($categorias as $data): ?>
                        <option value="<?= $data['id'] ?>" 
                        <?= ( $corredor->id_categoria == $data['id'] )? 'selected' : null ?>>
                            <?= $data['categoria'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <!-- Select Dinámico club -->
            <div class="mb-3">
                <label for="club" class="form-label">Club</label>
                <select class="form-select" name="id_club" disabled>
                    <option selected disabled>Seleccione Club</option>
                    <!-- mostrar lista clubes -->
                    <?php foreach ($clubs as $data): ?>
                        <option value="<?= $data['id'] ?>" <?= ( $corredor->id_club == $data['id'] )? 'selected' : null ?>>
                            <?= $data['club'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Campo Mostar categoria
            <div class="mb-3">
                <label for="categoria" class="form-label">Categoria</label>
                <input type="text" class="form-control" name="categoria" value="<?= $tabla_corredores->getNombreCategoria($corredor->id_categoria)->nombreCorto ?>" disabled>
            </div>

             Campo Mostar club
            <div class="mb-3">
                <label for="club" class="form-label">Club</label>
                <input type="text" class="form-control" name="club" value="<?= $tabla_corredores->getNombreClub($corredor->id_club)->nombreCorto ?>" disabled>
            </div> -->
            

            <!-- botones de acción -->
            <a class="btn btn-primary" href="index.php" role="button">Volver</a>

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