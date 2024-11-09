<?php
session_start();
$ruta = '../';
require("encabezado.php");

if (empty($_SESSION["usuario"]))
    header('refresh:1;../index.php');


session_destroy();
header('refresh:1;../index.php');


