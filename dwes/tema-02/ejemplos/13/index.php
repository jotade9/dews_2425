<?php
/**
 * Conversiones de tipos
 */

 $var = 3;
 var_dump($var);

//Conversion mediante funciones

 //strval
$var1 = strval($var);
echo"<BR>";
var_dump($var1);

 //intval
$var2 = intval($var1);
echo"<BR>";
var_dump($var2);

 //floatval
$var3 = floatval($var);
echo"<BR>";
var_dump($var3);

#Conversion (tipo dato) variable
$var4 = 7.89;
$var4=(int) $var4;
echo"<BR>";
var_dump($var4);

$var5 = 89;
$var5=(float) $var5;
echo"<BR>";
var_dump($var5);

$var6 = 89;
$var6=(string) $var6;
echo"<BR>";
var_dump($var6);

$var7 = 100;
$var7=(array) $var7;
echo"<BR>";
var_dump($var7);


//Conversion mediante settype
echo"<BR>";
$var8 = 45;
settype($var8,"string");
var_dump($var8);