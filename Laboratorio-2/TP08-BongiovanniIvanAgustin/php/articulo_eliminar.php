<?php
session_start();
$ruta = '../';
require("encabezado.php");


if (empty($_SESSION["usuario"])) header('refresh:1;../index.php');


if (!empty($_GET["id"])) {
    $id = (int) $_GET["id"];


    require_once 'conexion.php';

    $conexion = conectar();

    if (!$conexion) {

        header("refresh:1;url=../index.php");
        echo '<p>No se ha podido conectar con la base de datos</p>';
    } else {
        // obtengo el nombre del articulo para mostrarlo

        $consulta = "SELECT nombre FROM articulo WHERE id_articulo = ? ";

        $sentencia = mysqli_prepare($conexion, $consulta);

        mysqli_stmt_bind_param($sentencia, 'i', $id);

        $q = mysqli_stmt_execute($sentencia);

        mysqli_stmt_bind_result($sentencia, $nombreArticulo);

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
    require 'header.php';
    ?>


    <section class="text-center">
        <article>
            <h1 class="mb-3 text-white">Eliminar artículo</h1>
            <p class="mb-4 text-white">¿Está seguro que quiere eliminar el artículo
                <strong><?= $nombreArticulo ?></strong>?
            </p>
        </article>

        <section>


            <a href="articulo_eliminar_ok.php?id=<?= $id ?>" class="btn btn-primary me-2">Aceptar</a>

            <a href="articulo_listado.php" class="btn btn-secondary">Cancelar</a>


        </section>
    </section>
</main>

<?php
require("pie.php");
?>