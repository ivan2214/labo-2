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

if (!empty($_POST['nombre']) && !empty($_POST['categoria']) && !empty($_POST['precio'])) {
    $conImagen = false;
    $nombre = $_POST["nombre"];
    $categoria = $_POST["categoria"];
    $precio = $_POST["precio"];
    // verifico que me envien una foto y saco su extension para guardarla en conjunto con su nombre
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
    // si no se conecto redirigo
    if (!$conexion) {
        header("refresh:1;url=../index.php");
        echo '<p>No se ha podido conectar con la base de datos</p>';
    } else {
        // creo la consulta con la espera de las variables
        $consulta = "INSERT INTO articulo(nombre,categoria,precio,foto)
                     VALUES (?,?,?,?)
                    ";

        // preparo la consulta

        $sentencia = mysqli_prepare($conexion, $consulta);

        //casteo el precio a int ya que viene como un string

        $precioDB = (int) $precio;

        // agrego los valores a la consulta con los datos del form          

        mysqli_stmt_bind_param($sentencia, 'ssis', $nombre, $categoria, $precioDB, $nombreImagen);

        // verifico el resultado si fue exitoso o no para redirigir y mostrar un mensaje

        $q = mysqli_stmt_execute($sentencia);

        if ($q) {
            // si laconsulta se hizo guardo la imagen en la carpeta img/articulos
            if ($conImagen) {
                $rutaOrigen = $_FILES["imagen"]["tmp_name"];
                $rutaDestino = "../img/articulos/" . $nombreImagen;
                $envio = move_uploaded_file($rutaOrigen, $rutaDestino);
                if ($envio) {
                    header("refresh:1;url=articulo_listado.php");
                    echo '<p>Guardado exitoso </p>';
                } else {
                    header("refresh:1;url=articulo_alta.php");
                    echo '<p>Error al guardar</p>';
                }
            } else {
                header("refresh:1;url=articulo_listado.php");
                echo '<p>Guardado exitoso </p>';
            }
        } else {
            header("refresh:1;url=articulo_alta.php");
            echo '<p>Error al guardar</p>';
        }

        desconectar($conexion);
    }
}
