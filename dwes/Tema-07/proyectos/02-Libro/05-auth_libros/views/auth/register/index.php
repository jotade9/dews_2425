<!doctype html>
<html lang="es">

<head>
    <?php require_once 'template/layouts/head.layout.php'; ?>
    <title>Registro Nuevo Usuario - Autenticación  </title>
</head>

<body>
    <!-- Menú fijo superior -->
    <?php require_once 'template/partials/menu.partial.php' ?>

    <!-- Capa Principal -->
    <div class="container">
        <br><br><br><br>

        <div class="row justify-content-center">
            
            <div class="col-md-8">
            <?php require_once("template/partials/mensaje.partial.php") ?>
            <?php require_once("template/partials/error.partial.php") ?>
                <div class="card">
                    <div class="card-header">Registro Nuevo Usuario</div>
                    <div class="card-body">
                        <form method="POST" action="<?= URL ?>auth/validate_register">
                            <!-- token csrf  -->
                            <input type="hidden" name="csrf_token"
                            value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '') ?>">
                            

                             <!-- campo name -->
                             <div class="mb-3 row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Nombre</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" 
                                    value="<?= htmlspecialchars( $this->name)?>" required autocomplete="name" autofocus>

                                     <!-- control de errores  -->
                                   <?php if (isset($this->errores['name'])): ?>  
                                        <span class="form-text text-danger" role="alert">
                                            <?=  $this->error['name'] ??= null?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- campo email -->
                            <div class="mb-3 row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control <?= (isset($this->errores['email']))? 'is-invalid': null ?>" 
                                     name="email" value="<?= htmlspecialchars( $this->email) ?>" required 
                                    autocomplete="email" autofocus>

                                    <!-- control de errores  -->
                                   <?php if (isset($this->errores['email'])): ?>  
                                        <span class="form-text text-danger" role="alert">
                                            <?=  $this->error['email'] ??= null?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                           <!--  password confirmacion -->
                           <div class="mb-3 row">
                                <label for="password_confirm" class="col-md-4 col-form-label text-md-right">Confirmar Password</label>

                                <div class="col-md-6">
                                    <input id="password_confirm" type="password" 
                                    class="form-control" name="password_confirm"  required autocomplete="new-password">

                                    
                                </div>
                            </div> 

                            <div class="mb-3 row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control <?= (isset($this->errores['password']))? 'is-invalid': null ?>" 
                                    id="password" name="password" value="<?= htmlspecialchars( $this->password) ?>" required 
                                    autocomplete="current-password">

                                </div>
                            </div>

                            <!-- botones de accion  -->
                            <div class="mb-3 row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <a class="btn btn-secondary" href="<?=URL?>auth/login" role="button">Cancelar</a>
                                    <button type="reset" class="btn btn-secondary" >Reset</button>
                                    <button type="submit" class="btn btn-primary">Registrar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>



    </div>

    

    <!-- /.container -->

    <?php require_once 'template/partials/footer.partial.php' ?>
    <?php require_once 'template/layouts/javascript.layout.php' ?>

</body>

</html>