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


if (!empty($_POST['id']) && !empty($_POST['nombre']) && !empty($_POST['categoria']) && !empty($_POST['precio'])) {
    $conImagen = false;
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $categoria = $_POST['categoria'];
    $precio = (float) $_POST['precio'];
    $fotoVieja = $_POST['fotoVieja'];
    $nombreImagenNueva = "";

    $ubicacionArchivo = "../img/articulos/" . $fotoVieja;

    if (!empty($fotoVieja)) {
        unlink($ubicacionArchivo);
    }

    if (!empty($_FILES["imagen"]["size"])) {
        $extensionImage = explode("/", $_FILES["imagen"]["type"])[1];
        $nombreImagenNueva = $nombre . "." . $extensionImage;
        $conImagen = true;
    } else {
        $conImagen = false;
        $nombreImagenNueva = "";
    }

    require_once 'conexion.php';
    $conexion = conectar();
    if (!$conexion) {
        header("refresh:1;url=articulo_listado.php");
        echo '<p>Error al conectar con la base de datos</p>';
    } else {

        if ($conImagen) {
            $rutaOrigen = $_FILES["imagen"]["tmp_name"];
            $rutaDestino = "../img/articulos/" . $nombreImagenNueva;
            $envio = move_uploaded_file($rutaOrigen, $rutaDestino);

            if (!$envio) {
                header("refresh:1;url=articulo_listado.php");
                echo '<p>Error al guardar imagen</p>';
            }

        }

        $consulta = "UPDATE articulo SET nombre = ?, categoria = ?, precio = ?, foto = ? WHERE id_articulo = ?";
        $sentencia = mysqli_prepare($conexion, $consulta);
        mysqli_stmt_bind_param($sentencia, 'ssisi', $nombre, $categoria, $precio, $nombreImagenNueva, $id);

        $resultado = mysqli_stmt_execute($sentencia);
        mysqli_stmt_close($sentencia);
        desconectar($conexion);


        if ($resultado) {
            header("refresh:1;url=articulo_listado.php");
            echo '<p>Modificación exitosa</p>';
        } else {
            header("refresh:1;url=articulo_listado.php");
            echo '<p>Error al modificar el artículo</p>';
        }
    }
} else {
    header("refresh:1;url=articulo_listado.php");
    echo '<p>Información incompleta para la modificación</p>';
}
