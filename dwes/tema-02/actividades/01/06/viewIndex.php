<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Actividad 2.1.1</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
    <!-- Muesto el titulo -->
    <h1>Datos del alumno</h1>
    <table  class="table">
      <thead>
        <tr>
          <th>Campo</th>
          <th>Valor</th>
        </tr>
      </thead>
      <tbody>
         <!-- Muestro nombre -->
         <tr>
                <td>Nombre</td>
                <td><?=$nombre?></td>
            </tr>
            <!-- Muestro apellidos -->
            <tr>
                <td>Apellidos</td>
                <td><?=$apellidos?></td>
            </tr>
            <!-- Muestro edad -->
            <tr>
                <td>Edad</td>
                <td><?=$edad?></td>
            </tr>
            <!-- Muestro poblacion -->
            <tr>
                <td>Población</td>
                <td><?=$poblacion?></td>
            </tr>
            <!-- Muestro ciclo -->
            <tr>
                <td>Ciclo</td>
                <td><?=$ciclo?></td>
            </tr>
            <!-- Muestro curso -->
            <tr>
                <td>Curso</td>
                <td><?=$curso?></td>
            </tr>
            <!-- Muestro modulo -->
            <tr>
                <td>Módulo</td>
                <td><?=$modulo?></td>
            </tr>
      </tbody>
    </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>