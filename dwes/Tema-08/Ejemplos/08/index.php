<?php

$ruta='files';
$archivo='archivo.txt';

$ruta=$ruta.'/'.$archivo;
$metadatos=stat($ruta);

echo"<pre>";
print_r($metadatos);
echo"</pre>";