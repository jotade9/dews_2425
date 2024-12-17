<!doctype html>
<html lang="es">

<head>
	<?php include 'template/layouts/head.layout.php'; ?>
	<title>Hola Mundo -MVC </title>
</head>



<body>
	<!-- Menú fijo superior -->
	<?php require_once("template/partials/menu.partial.php") ?>

	<!-- Page Content -->
	<div class="container">
		<br><br><br><br>

		<!-- Capa de mensajes -->
		<?php require_once("template/partials/mensaje.partial.php") ?>


		<!-- Estilo card de bootstrap -->
		<div class="card">
			<div class="card-header">
				MVC
			</div>
			<div class="card-body">

				<?php require_once("template/partials/cabecera.partial.php") ?>

			</div>
			<div class="card-footer">
			Curso 24/25
			</div>
		</div>


	</div>

	<!-- /.container -->

	<?php require_once("template/partials/footer.partial.php") ?>
	<?php require_once("template/layouts/javascript.layout.php") ?>

</body>

</html>