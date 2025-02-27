<<<<<<< HEAD
<!doctype html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Calculadora Básica</title>
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
      <i class="bi bi-calculator"></i>
      <span class="fs-6">Proyecto 42 - Calculadora Básica</span>
    </header>

    <!-- Formulario -->
    <legend>Calculadora Básica</legend>

    <!-- Fin del formulario -->
    <form method="GET" action="calculadora.php">

      <!-- Valor 1 -->
      <div class="input-group mb-3">
        <span class="input-group-text" id="inputGroup-sizing-default">Valor 1</span>
        <input type="number" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" step="0.01" placeholder="0.00" name="valor1">
      </div>

      <!-- Valor 2 -->
      <div class="input-group mb-3">
        <span class="input-group-text" id="inputGroup-sizing-default">Valor 2</span>
        <input type="number" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" step="0.01" placeholder="0.00" name="valor2">
      </div>

      <!-- botones de acción -->
      <div class="btn-group" role="group">
        <button type="reset" class="btn btn-secondary">Borrar</button>
        <button type="submit" class="btn btn-warning" name="operador" value="sumar">Sumar</button>
        <button type="submit" class="btn btn-success" name="operador" value="restar">Restar</button>
        <button type="submit" class="btn btn-primary" name="operador" value="multiplicar">Multiplicar</button>
        <button type="submit" class="btn btn-danger" name="operador" value="dividir">Dividir</button>
        <button type="submit" class="btn btn-dark" name="operador" value="potenciar">Potencia</button>
      </div>

    </form>

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

=======
<<<<<<< HEAD
<!doctype html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Calculadora Básica</title>
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
      <i class="bi bi-calculator"></i>
      <span class="fs-6">Proyecto 42 - Calculadora Básica</span>
    </header>

    <!-- Formulario -->
    <legend>Calculadora Básica</legend>

    <!-- Fin del formulario -->
    <form method="GET" action="calculadora.php">

      <!-- Valor 1 -->
      <div class="input-group mb-3">
        <span class="input-group-text" id="inputGroup-sizing-default">Valor 1</span>
        <input type="number" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" step="0.01" placeholder="0.00" name="valor1">
      </div>

      <!-- Valor 2 -->
      <div class="input-group mb-3">
        <span class="input-group-text" id="inputGroup-sizing-default">Valor 2</span>
        <input type="number" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" step="0.01" placeholder="0.00" name="valor2">
      </div>

      <!-- botones de acción -->
      <div class="btn-group" role="group">
        <button type="reset" class="btn btn-secondary">Borrar</button>
        <button type="submit" class="btn btn-warning" name="operador" value="sumar">Sumar</button>
        <button type="submit" class="btn btn-success" name="operador" value="restar">Restar</button>
        <button type="submit" class="btn btn-primary" name="operador" value="multiplicar">Multiplicar</button>
        <button type="submit" class="btn btn-danger" name="operador" value="dividir">Dividir</button>
        <button type="submit" class="btn btn-dark" name="operador" value="potenciar">Potencia</button>
      </div>

    </form>

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

=======
<!doctype html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Calculadora Básica</title>
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
      <i class="bi bi-calculator"></i>
      <span class="fs-6">Proyecto 42 - Calculadora Básica</span>
    </header>

    <!-- Formulario -->
    <legend>Calculadora Básica</legend>

    <!-- Fin del formulario -->
    <form method="GET" action="calculadora.php">

      <!-- Valor 1 -->
      <div class="input-group mb-3">
        <span class="input-group-text" id="inputGroup-sizing-default">Valor 1</span>
        <input type="number" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" step="0.01" placeholder="0.00" name="valor1">
      </div>

      <!-- Valor 2 -->
      <div class="input-group mb-3">
        <span class="input-group-text" id="inputGroup-sizing-default">Valor 2</span>
        <input type="number" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" step="0.01" placeholder="0.00" name="valor2">
      </div>

      <!-- botones de acción -->
      <div class="btn-group" role="group">
        <button type="reset" class="btn btn-secondary">Borrar</button>
        <button type="submit" class="btn btn-warning" name="operador" value="sumar">Sumar</button>
        <button type="submit" class="btn btn-success" name="operador" value="restar">Restar</button>
        <button type="submit" class="btn btn-primary" name="operador" value="multiplicar">Multiplicar</button>
        <button type="submit" class="btn btn-danger" name="operador" value="dividir">Dividir</button>
        <button type="submit" class="btn btn-dark" name="operador" value="potenciar">Potencia</button>
      </div>

    </form>

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

>>>>>>> 880701ca79aea3b9a52b24be21ccbac733d67c82
>>>>>>> 7c139080c002fe1675da1016599ab6d972ca90e2
</html>