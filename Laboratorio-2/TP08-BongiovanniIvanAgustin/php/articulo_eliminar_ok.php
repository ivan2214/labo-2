<?php
require_once 'conexion.php';

$conexion = conectar();

if ($conexion && !empty($_GET['id']) && !empty($_GET['usuario'])) {
    // hago el casteo de $_GET["id"] a int pq een la db es int
    $id = (int) $_GET['id'];
    $usuario = $_GET['usuario'];

    $consulta = "DELETE FROM articulo WHERE id_articulo = ?";

    $sentencia = mysqli_prepare($conexion, $consulta);

    mysqli_stmt_bind_param($sentencia, 'i', $id);

    $q = mysqli_stmt_execute($sentencia);

    if ($q) {
        header("refresh:1;url=articulo_listado.php?usuario=$usuario");
        echo '<p>Artículo borrado correctamente redirigiendo...</p>';
    } else {
        header("refresh:1;url=articulo_listado.php?usuario=$usuario");
        echo '<p>No se ha podido borrar el articulo</p>';
    }

    mysqli_stmt_close($sentencia);
}
