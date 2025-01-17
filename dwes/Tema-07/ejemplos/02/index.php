<?php
/**
 * personalizar SID y NAME
 */

 session_id(('1010'));

 session_start();

 echo 'sesión iniciada' . '<br>';

 echo 'SID: ' . session_id() . '<br>';

 echo 'Name: ' . session_name();