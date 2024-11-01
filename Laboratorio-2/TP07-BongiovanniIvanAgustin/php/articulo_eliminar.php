<?php
$ruta = '../';
require("encabezado.php");


if (!empty($_GET["id"]) && !empty($_GET["usuario"])) {
    // hago el casteo de $_GET["id"] a int pq een la db es int
    $id = (int) $_GET["id"];
    $usuario = $_GET["usuario"];
    // declaro la variable para saber si fue eliminado o no el articulo
    $eliminado = false;

    require_once 'conexion.php';

    $conexion = conectar();

    if (!$conexion) {
        // si no se ha podido conectar con la base de datos mostrar el error y redirigir
        header("refresh:1;url=../index.php");
        echo '<p>No se ha podido conectar con la base de datos</p>';
    } else {
        // creo la consulta
        $consulta = "SELECT nombre FROM articulo WHERE id_articulo = ? ";
        // preparo la sentencia
        $sentencia = mysqli_prepare($conexion, $consulta);
        // asigno los valores a la sentencia
        mysqli_stmt_bind_param($sentencia, 'i', $id);
        // ejecuto la sentencia
        $q = mysqli_stmt_execute($sentencia);
        // guardo el resultado en una variable
        mysqli_stmt_bind_result($sentencia, $nombreArticulo);
        // recorro el resultado
        mysqli_stmt_fetch($sentencia);
        // cerrar la sentencia
        mysqli_stmt_close($sentencia);

        if (!empty($_GET["confirmar"]) && $_GET["confirmar"] == "true") {
            // si pulsaron el boton de confirmar borro el articulo de la base de datos
            $consulta = "DELETE FROM articulo WHERE id_articulo = ?";

            $sentencia = mysqli_prepare($conexion, $consulta);

            mysqli_stmt_bind_param($sentencia, 'i', $id);

            $q = mysqli_stmt_execute($sentencia);

            mysqli_stmt_close($sentencia);

            if ($q) {
                // se borro correctamente asigno el valor a $eliminado com true para mostrar el mensaje de redireccionamiento
                header("refresh:1;url=articulo_listado.php?usuario=" . $usuario);
                $eliminado = true;
            } else {
                // si no se ha podido borrar mostrar el error y redirigir
                header("refresh:1;url=articulo_listado.php?usuario=" . $usuario);
                echo '<p>No se ha podido borrar el articulo</p>';
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
                // si fue eliminado mostrar el mensaje de redireccionamiento
                echo '<p class="mb-4 text-white">Artículo eliminado correctamente redirigiendo...</p>';
            } else {
                // si aun no fue eliminado mostrar el boton de confirmar y el de cancelar
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