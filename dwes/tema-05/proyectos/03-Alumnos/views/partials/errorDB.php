
<h2>ERROR BASE DE DATOS</h2>
<HR>;
<?= "Mensaje: " . $e->getMessage() . '<BR>'?>
<?= "Codigo: " . $e->getCode() . '<BR>'?>
<?= "Fichero: " . $e->getFile() . '<BR>'?>
<?= "Linea: " . $e->getLine() . '<BR>'?>
<?= "Trace: " . $e->getTraceAsString() . '<BR>'?>