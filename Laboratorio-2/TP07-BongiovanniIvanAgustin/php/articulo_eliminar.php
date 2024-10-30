<?php
$ruta = '../';
require("encabezado.php");


if (!empty($_GET["id"]) && !empty($_GET["usuario"])) {
    $id = (int) $_GET["id"];
    $usuario = $_GET["usuario"];
    $eliminado = false;

    require_once 'conexion.php';

    $conexion = conectar();

    if (!$conexion) {
        header("refresh:1;url=../index.php");
        echo '<p>No se ha podido conectar con la base de datos</p>';
    } else {
        $consulta = "SELECT nombre FROM articulo WHERE id_articulo = ? ";

        $sentencia = mysqli_prepare($conexion, $consulta);

        mysqli_stmt_bind_param($sentencia, 'i', $id);

        $q = mysqli_stmt_execute($sentencia);

        mysqli_stmt_bind_result($sentencia, $nombreArticulo);
        mysqli_stmt_fetch($sentencia);
        mysqli_stmt_close($sentencia);

        if (!empty($_GET["confirmar"]) && $_GET["confirmar"] == "true") {

            $consulta = "DELETE FROM articulo WHERE id_articulo = ?";

            $sentencia = mysqli_prepare($conexion, $consulta);

            mysqli_stmt_bind_param($sentencia, 'i', $id);

            $q = mysqli_stmt_execute($sentencia);

            mysqli_stmt_close($sentencia);

            if ($q) {
                header("refresh:1;url=articulo_listado.php?usuario=" . $usuario);
                $eliminado = true;
            } else {
                header("refresh:1;url=articulo_listado.php?usuario=" . $usuario);
            }
        }

        desconectar($conexion);
    }
} else {
    header("refresh:1;url=../index.php");
    echo '<p>Faltan datos</p>';
}

?>

<main class="d-flex justify-content-center align-items-center login">
    <section class="text-center">
        <article>
            <h1 class="mb-3 text-white">Eliminar artículo</h1>
            <p class="mb-4 text-white">¿Está seguro que quiere eliminar el artículo <strong><?= $nombreArticulo ?></strong>?</p>
        </article>

        <section>
            <?php

            if ($eliminado) {
                echo '<p class="mb-4 text-white">Artículo eliminado correctamente redirigiendo...</p>';
            } else {
                echo '<a href="articulo_eliminar.php?id=' . $id . '&usuario=' . $usuario . '&confirmar=true" class="btn btn-primary me-2">Aceptar</a>';
                echo '<a href="articulo_listado.php?usuario=' . $usuario . '" class="btn btn-secondary">Cancelar</a>';
            }

            ?>

        </section>
    </section>
</main>

<?php
require("pie.php");
?>