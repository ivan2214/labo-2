<?php
session_start();
$ruta = '../';
require("encabezado.php");


if (empty($_SESSION["usuario"]))
    header('refresh:1;../index.php');

if (!empty($_GET["id"])) {
    $id = $_GET["id"];
    require_once 'conexion.php';

    $conexion = conectar();

    if (!$conexion) {
        header("refresh:1;url=../index.php");
        echo '<p>No se ha podido conectar con la base de datos</p>';
    } else {
        $consulta = "SELECT nombre,categoria,precio,foto FROM articulo WHERE id_articulo = ?";

        $sentencia = mysqli_prepare($conexion, $consulta);

        mysqli_stmt_bind_param($sentencia, 'i', $id);
        mysqli_stmt_execute($sentencia);

        mysqli_stmt_bind_result($sentencia, $nombre, $categoria, $precio, $foto);



        mysqli_stmt_fetch($sentencia);

        mysqli_stmt_close($sentencia);



        desconectar($conexion);
    }
} else {
    header("refresh:1;url=../index.php");
    echo '<p>Faltan datos</p>';
}



?>

<main class="container py-3">

    <?php
    require_once 'header.php';
    ?>

    <section class="d-flex justify-content-center">


        <form class="p-4 border rounded w-50" action=<?= "articulo_modificar_ok.php?id=" . $id ?> method="POST"
            enctype="multipart/form-data">
            <fieldset>
                <legend class="text-center mb-4">Modificar Artículo</legend>

                <label for="nombre" class="form-label">Nombre del artículo</label>
                <input type="text" id="nombre" name="nombre" class="form-control mb-3" value=<?= $nombre ?> required>

                <label for="categoria" class="form-label">Categoría</label>
                <input type="text" id="categoria" name="categoria" class="form-control mb-3" value=<?= $categoria ?>
                    required>

                <label for="precio" class="form-label">Precio</label>
                <input type="number" step="0.01" id="precio" name="precio" class="form-control mb-3" value=<?= $precio ?>
                    required>

                <label for="imagen" class="form-label">Subir imagen del artículo</label>
                <input type="file" id="imagen" name="imagen" class="form-control mb-4">

                <input type="hidden" name="id" value="<?= $id ?>">
                <input type="hidden" name="fotoVieja" value="<?= $foto ?>">




                <button class="btn btn-primary w-100" type="submit">
                    Modificar
                </button>

                <a class="btn btn-secondary w-100 mt-1" href="articulo_listado.php">Cancelar</a>

            </fieldset>
        </form>
    </section>
</main>
<?php
require("pie.php");
?>