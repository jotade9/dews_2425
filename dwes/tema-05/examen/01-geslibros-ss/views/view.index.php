<!DOCTYPE html>
<html lang="es">
<head>
    <!-- include head -->
    <title>Panel de Control de libros - GESBANK </title>
    <?php include 'views/layouts/layout.head.html'; ?>
</head>
<body>
    <!-- Capa Principal -->
    <div class="container">

        <!-- Encabezado proyecto -->
        <!-- include header -->
        <?php include 'views/partials/partial.header.php'; ?>
                
        <!-- Menú principal -->
        <!-- include menú -->
        <?= include 'views/partials/partial.menu.php';?>

        <div class="table-responsive"> 
            <table class="table">
                <thead>
                    <!-- Mostramos el encabezado de la tabla -->
                    <tr>
                        <th>Id</th>
                        <th>Título</th>
                        <th>Autor</th>
                        <th>Editorial</th>
                        <th>Géneros</th>
                        <th class='text-end'>Stock</th>
                        <th class='text-end'>Precio</th>
                        <!-- columna de acciones -->
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                     <!-- Mostramos cuerpo de la tabla -->
                     <?php while ($libro = $stmt_libros->fetch()): ?>
                        <tr class="align-middle">
                            <td><?= $libro->id ?></td>
                            <td><?= $libro->titulo ?></td>
                            <td><?= $libro->autor ?></td>
                            <td><?= $libro->editorial ?></td>
                            <td><?= $libro->generos_id ?></td>
                            <td class='text-end'><?= $libro->stock ?></td>
                            <td class='text-end'><?= $libro->precio ?></td>
                            <td>
                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <a href="#" title="Eliminar" class="btn btn-danger" onclick="return confirm('Confimar elimación del libro')"><i class="bi bi-trash-fill"></i></a>
                                <a href="#" title="Editar" class="btn btn-primary"><i class="bi bi-pencil-square"></i></a>
                                <a href="#" title="Mostrar" class="btn btn-warning"><i class="bi bi-eye-fill"></i></a>
                                </div>
                            </td>
                        </tr>
                        
                    <?php endwhile; ?>   
                </tbody>
                <tfoot>
                    <tr><td colspan="8">Nº libros <?=$stmt_libros->rowCount()?></td></tr>
                </tfoot>
            </table>
        </div>
    </div>
    <br><br><br>

    <!-- Pie del documento -->
    <!-- include footer -->
    <?php include 'views/partials/partial.footer.php'; ?>
    <!-- Bootstrap Javascript y popper -->
    <!-- include javascritp -->
    <?php include 'views/layouts/layout.javascript.html'; ?>
    
 
</body>
</html>