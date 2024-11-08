<?php
$ruta = '../';
require("encabezado.php");


if (!empty($_GET["id"])) {
    $id = $_GET["id"];
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

    <section class="d-flex justify-content-center">


        <form class="p-4 border rounded w-50" action=<?= "articulo_modificar_ok.php?usuarioFoto=" . $usuarioNombre . "&id=" . $id ?> method="POST" enctype="multipart/form-data">
            <fieldset>
                <legend class="text-center mb-4">Alta de Artículo</legend>

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

                <a class="btn btn-secondary w-100 mt-1" href=<?= "articulo_listado.php?usuario=" . $usuarioNombre ?>>Cancelar</a>

            </fieldset>
        </form>
    </section>
</main>
<?php
require("pie.php");
?>