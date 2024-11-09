<?php

session_start();
$ruta = '../';
require("encabezado.php");

if (!empty($_SESSION["usuario"])) {
    $usuario = $_SESSION["usuario"];
    $fotoUsuario = $_SESSION["fotoUsuario"];


    if ($fotoUsuario == "" || $fotoUsuario == NULL || empty($fotoUsuario)) {
        $fotoUsuario = "usuario_default.png";
    }

} else {
    header('refresh:1;../index.php');
    $usuario = "";
    $fotoUsuario = "usuario_default.png";
}


require_once 'conexion.php';

$conexion = conectar();

if ($conexion && !empty($_GET['id'])) {
    
    $id = (int) $_GET['id'];
    

    $consulta = "DELETE FROM articulo WHERE id_articulo = ?";

    $sentencia = mysqli_prepare($conexion, $consulta);

    mysqli_stmt_bind_param($sentencia, 'i', $id);

    $q = mysqli_stmt_execute($sentencia);

    if ($q) {
        header("refresh:1;url=articulo_listado.php");
        echo '<p>Artículo borrado correctamente redirigiendo...</p>';
    } else {
        header("refresh:1;url=articulo_listado.php");
        echo '<p>No se ha podido borrar el articulo</p>';
    }

    mysqli_stmt_close($sentencia);
}
