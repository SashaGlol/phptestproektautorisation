<?php

$host = 'localhost';
$db   = 'd92361h9_bais';
$user = 'd92361h9_bais';
$pass = 'Jb6&Yu4657lJ'; //  AAwjP6HpVCnG
$charset = 'utf8mb4';

$mysqli = mysqli_connect($host, $user, $pass, $db);
mysqli_set_charset($mysqli, $charset);
unset($host, $db, $user, $pass, $charset);

?>