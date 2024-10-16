<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Actividad 3.2 - Tabla de Multiplicar</title>
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
            <i class="bi bi-file-spreadsheet"></i>
            <span class="fs-6">Tablas de multiplicar</span>
        </header>
        <legend>Tablas de multiplicar</legend>
        <table class="table table-primary">
            <tr>
                <th></th>
                <?php for ($i = 1; $i <= 10; $i++): ?>
                    <th><?= $i ?></th>
                <?php endfor; ?>
            </tr>

            <?php for ($i = 1; $i <= 10; $i++): ?>
                <tr>
                    <th><?= $i ?></th>
                    <?php for ($j = 1; $j <= 10; $j++): ?>
                        <td><?= $i * $j ?></td>
                    <?php endfor; ?>
                </tr>
            <?php endfor; ?>
        </table>

        <!-- pie de página -->
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

</html>