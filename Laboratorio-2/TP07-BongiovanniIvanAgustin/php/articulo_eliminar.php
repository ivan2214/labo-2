<?php
$ruta = '../';
require("encabezado.php");


if (!empty($_GET["id"]) && !empty($_GET["usuario"])) {
    // hago el casteo de $_GET["id"] a int pq een la db es int
    $id = (int) $_GET["id"];
    $usuario = $_GET["usuario"];

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


            <a href="borrar.php?id=<?= $id ?>&usuario=<?= $usuario ?>" class="btn btn-primary me-2">Aceptar</a>

            <a href="articulo_listado.php?usuario=<?= $usuario ?>" class="btn btn-secondary">Cancelar</a>


        </section>
    </section>
</main>

<?php
require("pie.php");
?>