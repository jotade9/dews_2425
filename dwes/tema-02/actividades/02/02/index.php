<?php
/**
 * Ejercicio 2. is_null()
 * Crear un script PHP donde se muetre el resultado
 *  de 3 valores verdaderos y
 *  3 valores falsos para la función is_null()
 */

 $v1;
 var_dump(is_null($v1));

 echo "<BR>";

 $v1 = null;
 var_dump(is_null($v1));

 echo "<BR>";

 $v1 = "";
 var_dump(is_null($v1));

 echo "<BR>";

 $v1 = true;
 var_dump(is_null($v1));

 echo "<BR>";

 $v1 = 0;
 var_dump(is_null($v1));

 echo "<BR>";

unset($v1);
 var_dump(is_null($v1));

 echo "<BR>";