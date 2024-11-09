<?php
session_start();





// Agregar artículo al carrito si `id` está presente en la URL
if (!empty($_SESSION['usuario']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    if (empty($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }

    if (empty($_SESSION['carrito'][$id])) {
        $_SESSION['carrito'][$id] = 1;
    } else {
        $_SESSION['carrito'][$id]++;
    }
}


?>

<main class="container">
    <?php
    require_once 'header.php';
    ?>

    <section class="my-5">
        <article class="row text-center">
            <section class="d-flex justify-content-center">
                <table class="table table-bordered table-hover table-striped w-auto">
                    <caption class="caption-top text-center bg-dark text-white">Listado de carrito</caption>
                    <tr>
                        <th class="bg-secondary text-white">Foto</th>
                        <th class="bg-secondary text-white">Producto</th>
                        <th class="bg-secondary text-white">Categoría</th>
                        <th class="bg-secondary text-white">Precio</th>
                        <th class="bg-secondary text-white">Cantidad</th>
                        <th class="bg-secondary text-white">Eliminar del carrito</th>
                    </tr>


                    <tbody class="bg-white">
                        <?php

                        if (!empty($_SESSION['carrito'])) {
                            require_once "conexion.php";
                            $conexion = conectar();
                            $consulta = 'SELECT * FROM articulo WHERE id_articulo = ?';
                            $sentencia = mysqli_prepare($conexion, $consulta);

                            mysqli_stmt_bind_param($sentencia, "i", $id);
                            mysqli_stmt_bind_result($sentencia, $id, $nombre, $categoria, $precio, $imagen);
                            $suma = 0;

                            foreach ($_SESSION['carrito'] as $id => $cantidad) {

                                mysqli_stmt_execute($sentencia);
                                mysqli_stmt_fetch($sentencia);
                                $carrito = $_SESSION['carrito'];

                                if (empty($imagen)) {
                                    $imagen = "sin_imagen.png";
                                }

                                $ubicacionArticuloImagen = "../img/articulos/" .  $imagen;
                                echo '
                                <tr>
                                <td><img src="' . $ubicacionArticuloImagen . '" width="100" height="100"></td>
                                <td>' . $nombre . '</td>
                                <td>' . $categoria . '</td>
                                <td>' . number_format($precio, 2, ',', '.') . '</td>
                                <td>' . $cantidad . '</td>
                                <td><a href="eliminar_carrito.php?id=' . $id . '"><button class="btn btn-danger">Eliminar</button></a></td>
                                </tr>
                                ';
                                $suma += $cantidad * $precio;
                            }
                            mysqli_stmt_close($sentencia);
                            desconectar($conexion);
                            echo '
                            <tr>
                            <td colspan="5">Total:</td>
                            <td>' . number_format($suma, 2, ',', '.') . '</td>
                            </tr>
                            ';
                        } else {
                            echo '
                            <tr>
                            <td colspan="6">No hay articulos en el carrito</td>
                            </tr>
                            ';
                        }

                        ?>
                    </tbody>

                </table>
            </section>
        </article>
    </section>

</main>

<?php
require_once "pie.php";
?>