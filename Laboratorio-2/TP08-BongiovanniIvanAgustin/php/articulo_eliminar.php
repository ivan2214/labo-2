<?php
$ruta = '../';
require("encabezado.php");


if (!empty($_GET["id"]) && !empty($_GET["usuarioFoto"])) {

    $id = (int) $_GET["id"];

    $usuarioFoto = $_GET["usuarioFoto"];
    $rutaFotosUsuarios = "../img/usuarios/";
    $ubicacionFoto = $rutaFotosUsuarios . $usuarioFoto;


    $usuarioNombre = explode(".", $usuarioFoto)[0];

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

require_once 'funciones.php';

date_default_timezone_set('America/Argentina/Tucuman');

$fecha = date("Y-m-d");

$fechaDeHoy = crearFecha($fecha);


?>

<main class="container py-3">

    <header class="d-flex align-items-center justify-content-between bg-secondary shadow">
        <section class="p-2">
            <h2 class="h5 fw-semibold mb-0"><?= $fechaDeHoy ?></h2>
        </section>
        <section class="d-flex align-items-center gap-3 px-3 py-2">
            <h2 class="h5 fw-semibold mb-0"><?= $usuarioNombre ?></h2>
            <figure class="rounded-circle overflow-hidden border" style="width: 48px; height: 48px;">
                <img class="img-fluid rounded-circle" src="<?= $ubicacionFoto ?>" alt="Foto de perfil del usuario"
                    style="width: 100%; height: 100%;">
            </figure>
        </section>
    </header>


    <section class="text-center">
        <article>
            <h1 class="mb-3 text-white">Eliminar artículo</h1>
            <p class="mb-4 text-white">¿Está seguro que quiere eliminar el artículo
                <strong><?= $nombreArticulo ?></strong>?</p>
        </article>

        <section>


            <a href="articulo_eliminar_ok.php?id=<?= $id ?>&usuario=<?= $usuarioNombre ?>"
                class="btn btn-primary me-2">Aceptar</a>

            <a href="articulo_listado.php?usuario=<?= $usuarioNombre ?>" class="btn btn-secondary">Cancelar</a>


        </section>
    </section>
</main>

<?php
require("pie.php");
?>