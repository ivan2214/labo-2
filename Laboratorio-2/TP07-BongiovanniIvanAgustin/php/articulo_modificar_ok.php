<?php
$usuarioURL = $_GET["usuario"];

if (!empty($_POST['id']) && !empty($_POST['nombre']) && !empty($_POST['categoria']) && !empty($_POST['precio'])) {
    $conImagen = false;
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $categoria = $_POST['categoria'];
    $precio = (float) $_POST['precio'];
    $nombreImagen = "";

    if (!empty($_FILES["imagen"]["size"])) {
        $extensionImage = explode("/", $_FILES["imagen"]["type"])[1];
        $nombreImagen = $nombre . "." . $extensionImage;
        $conImagen = true;
    } else {
        $conImagen = false;
        $nombreImagen = "";
    }

    require_once 'conexion.php';
    $conexion = conectar();
    if (!$conexion) {
        header("refresh:1;url=articulo_listado.php?usuario=" . $usuarioURL);
        echo '<p>Error al conectar con la base de datos</p>';
    } else {

        if ($conImagen) {
            $rutaOrigen = $_FILES["imagen"]["tmp_name"];
            $rutaDestino = "../img/articulos/" . $nombreImagen;
            $envio = move_uploaded_file($rutaOrigen, $rutaDestino);

            if ($envio) {
                $consulta = "UPDATE articulo SET nombre = ?, categoria = ?, precio = ?, foto = ? WHERE id_articulo = ?";
                $sentencia = mysqli_prepare($conexion, $consulta);
                mysqli_stmt_bind_param($sentencia, 'ssisi', $nombre, $categoria, $precio, $nombreImagen, $id);
            } else {
                header("refresh:1;url=articulo_modificar.php?id=" . $id . "&usuario=" . $usuarioURL);
                echo '<p>Error al subir la imagen</p>';
            }
        } else {
            $consulta = "UPDATE articulo SET nombre = ?, categoria = ?, precio = ? WHERE id_articulo = ?";
            $sentencia = mysqli_prepare($conexion, $consulta);
            mysqli_stmt_bind_param($sentencia, 'ssii', $nombre, $categoria, $precio, $id);
        }

        $resultado = mysqli_stmt_execute($sentencia);
        mysqli_stmt_close($sentencia);
        desconectar($conexion);


        if ($resultado) {
            header("refresh:1;url=articulo_listado.php?usuario=" . $usuarioURL);
            echo '<p>Modificación exitosa</p>';
        } else {
            header("refresh:1;url=articulo_modificar.php?id=" . $id . "&usuario=" . $usuarioURL);
            echo '<p>Error al modificar el artículo</p>';
        }
    }
} else {
    header("refresh:1;url=articulo_listado.php?usuario=" . $usuarioURL);
    echo '<p>Información incompleta para la modificación</p>';
}
