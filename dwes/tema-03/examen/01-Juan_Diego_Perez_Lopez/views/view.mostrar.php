<!DOCTYPE html>
<html lang="es">
<head>
    <!-- cargar head.html -->
    <title>Artículos - Nuevo </title> 
    <?php include 'layouts/head.html' ?>
</head>
<body>
    <!-- Capa Principal -->
    <div class="container">

        <!-- cargar partial.headr.php -->
        <?php include 'partials/partial.header.php' ?>
        <legend>Formulario Nuevo Artículo</legend>

      <form action="mostrar.php" method="GET">
        <!-- id -->
        <div class="mb-3">
            <label for="titulo" class="form-label"><?=$registro['id']?></label>
            <input type="text" class="form-control" readonly >
            
        </div>
        <!-- Descripción -->
        <div class="mb-3">
            <label for="descripcion" class="form-label"><?=$registro['descripcion']?></label>
            <input type="text" class="form-control" readonly>
        </div>
        
        <!-- Modelo -->
        <div class="mb-3">
            <label for="modelo" class="form-label" ><?=$registro['modelo']?></label>
            <input type="text" class="form-control" readonly>
        </div>

        <!-- Categoria -->
        <div class="mb-3">
            <label for="modelo" class="form-label"><?=$registro['categoria']?></label>
            <input type="text" class="form-control" readonly>
        </div>


        <!-- Unidades -->
        <div class="mb-3">
            <label for="unidades" class="form-label"><?=$registro['unidades']?></label>
            <input type="number" class="form-control"  step="0.01" readonly>
        </div>

        <!-- Precio -->
        <div class="mb-3">
            <label for="precio" class="form-label"><?=$registro['precio']?> €</label>
            <input type="number" class="form-control"  step="0.01" readonly>
        </div>
        
        <!-- botones de acción -->
        <a class="btn btn-secondary" href="index.php" role="button">Volver</a>
        
      </form>

      <br><br><br>

    <!-- Pie del documento -->
    <!-- cargar partial.footer.php -->
    <?php include 'partials/partial.footer.php' ?>
    <!-- Bootstrap Javascript y popper -->
    <!-- cargar javascript.php -->
    <?php include 'layouts/javascript.html' ?>
 
</body>
</html>