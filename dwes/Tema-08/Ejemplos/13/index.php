<?php

echo 'Directorio actual: '. getcwd() . '<br>';

$files=glob('files/a*.*');

//Muestra el contenifo del directorio files
echo '<pre>';
print_r($files);
echo '</pre>';

