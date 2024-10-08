<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Incluir head -->
    <?php include 'views/layouts/head.html' ?>
    <title>Resultado</title>
</head>
<body>
    <!-- Capa principal -->
    <div class="container">

        <!-- cabecera documento -->
        <header class="pb-3 mb-4 border-bottom">
            <i class="bi bi-calculator"></i>
            <span class="fs-6">Calculadora Conversor Decimal</span>   
        </header>

        <legend>Resultado</legend>
        <form>

            <!-- Valor Decimal -->
            <!-- <div class="form-group">
                <label for="valDecimal">Valor Decimal:</label>
                <input type="number" name="" class="form-control" placeholder="0" aria-describedby="helpId">
                <small id="helpId" class="text-muted">Introduzca número en decimal</small>
            </div>

            <br> -->

            <table class="table">
                <tbody>
                    <tr>
                        <td>DECIMAL</td>
                        <td>
                            <?= $valDecimal ?> 
                        </td>
                    </tr>
                    <tr>
                        <td>BINARIO</td>
                        <td>
                            <?= $valBinario ?> 
                        </td>
                    </tr>
                    <tr>
                        <td>OCTAL</td>
                        <td>
                            <?= $valOctal ?> 
                        </td>
                    </tr>
                    <tr>
                        <td>HEXADECIMAL</td>
                        <td>
                            <?= $valHexadecimal ?> 
                        </td>
                    </tr>
                </tbody>
            </table>
            
            <!-- Botones de acción -->
            <button type="submit" class="btn btn-primary" formaction="index.php">Volver</button>
            
        </form>

        
        <!-- Pié del documento -->
        <?php include 'views/layouts/footer.html' ?>
        
    </div>

    <!-- javascript bootstrap 532 -->
    <?php include 'views/layouts/javascript.html' ?>
</body>
</html>