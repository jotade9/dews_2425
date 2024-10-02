<!doctype html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>2.2 Lanzamiento Proyectiles</title>
  <!-- css bootstrap 533 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

  <!-- bootstrap icons 1.11.3 -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body>
  <!-- capa principal -->
  <div class="container">

    <!-- cabecera documento -->
    <header class="pb-3 mb-4 border-bottom">
      <i class="bi bi-radioactive"></i>
      <span class="fs-6">Lanzamiento Proyectiles</span>
    </header>

    <!-- Formulario -->
    <legend>Resultado</legend>

    <!-- Fin del formulario -->
    <table class="table">
      <thead>
        <tr>
          <th>VALORES INICIALES:</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <!-- Muestro velocidad  -->
        <tr>
          <td>Velocidad Inicial:</td>
          <td><?= $valor1 ?> m/s</td>
        </tr>
        <!-- Muestro inclinicación -->
        <tr>
          <td>Ángulo Inclinación</td>
          <td><?= $valor2 ?> º</td>
        </tr>
        <thead>
          <tr>
            <th>RESULTADOS:</th>
            <th></th>
          </tr>
        </thead>
        <!-- Muestro Radianes -->
        <tr>
          <td>Angulo Radianes</td>
          <td><?= $radianes ?> Radianes</td>
        </tr>
        <!-- Muestro velocidad de componente horizontal -->
        <tr>
          <td>Velocidad Inicial X:</td>
          <td><?= $v_x ?> m/s</td>
        </tr>
        <!-- Muestro velocidad de componente vertical -->
        <tr>
          <td>Velocidad Inicial Y:</td>
          <td><?= $v_y ?> m/s </td>
        </tr>
        <!-- Muestro alcance máximo -->
        <tr>
          <td>Alcance Máximo del Proyectil:</td>
          <td><?= $alcance_horizontal ?> m </td>
        </tr>
        <!-- Muestro tiempo de vuelo -->
        <tr>
          <td>Tiempo de Vuelo del proyectil:</td>
          <td><?= $tiempo_vuelo ?> s</td>
        </tr>
        <!-- Muestro Altura máxima  -->
        <tr>
          <td>Altura Máxima del Proyectil:</td>
          <td><?= $altura_maxima ?> m</td>
        </tr>
      </tbody>
    </table>
    <div class="btn-group" role="group">
      <a class="btn  btn-primary" href="index.php" role="button">Volver</a>
    </div>
    <!-- pie del documento -->
    <footer class="footer mt-auto py-3 fixed-bottom bg-light">
      <div class="container">
        <span class="text-muted">© 2024
          Juan Diego Pérez López - DWES - 2º DAW - Curso 24/25
        </span>
      </div>
    </footer>
  </div>
  <!-- javascript bootstrap 533 -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>