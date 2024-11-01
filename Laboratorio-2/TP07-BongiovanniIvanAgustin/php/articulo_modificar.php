<?php
$ruta = '../';
require("encabezado.php");
$usuarioURL = $_GET["usuario"];

if (!empty($_GET["id"])) {
    $id = $_GET["id"];

    require_once 'conexion.php';

    $conexion = conectar();

    if (!$conexion) {
        header("refresh:1;url=../index.php");
        echo '<p>No se ha podido conectar con la base de datos</p>';
    } else {
        $consulta = "SELECT nombre,categoria,precio FROM articulo WHERE id_articulo = ?";

        $sentencia = mysqli_prepare($conexion, $consulta);

        mysqli_stmt_bind_param($sentencia, 'i', $id);
        mysqli_stmt_execute($sentencia);

        mysqli_stmt_bind_result($sentencia, $nombre, $categoria, $precio);
        mysqli_stmt_fetch($sentencia);

        mysqli_stmt_close($sentencia);

        desconectar($conexion);
    }
}


?>

<main class="container py-3">
    <section class="d-flex justify-content-center">
        <form class="p-4 border rounded w-50" action="<?= "articulo_modificar_ok.php?usuario=" . $usuarioURL ?>" method="POST" enctype="multipart/form-data">
            <fieldset>
                <legend class="text-center mb-4">Modificar Artículo</legend>


                <input type="hidden" name="id" value="<?= $id ?>">

                <label for="nombre" class="form-label">Nombre del artículo</label>
                <input type="text" id="nombre" name="nombre" class="form-control mb-3" value="<?= htmlspecialchars($nombre) ?>" required>

                <label for="categoria" class="form-label">Categoría</label>
                <input type="text" id="categoria" name="categoria" class="form-control mb-3" value="<?= htmlspecialchars($categoria) ?>" required>

                <label for="precio" class="form-label">Precio</label>
                <input type="number" step="0.01" id="precio" name="precio" class="form-control mb-3" value="<?= htmlspecialchars($precio) ?>" required>

                <label for="imagen" class="form-label">Actualizar imagen del artículo (opcional)</label>
                <input type="file" id="imagen" name="imagen" class="form-control mb-4">

                <a href="articulo_modificar_ok.php?usuario=<?= $usuarioURL ?>&id=<?= $id ?>" class="btn btn-primary w-100">Aceptar</button>
                    <a href="articulo_listado.php?usuario=<?= $usuarioURL ?>" class="btn btn-secondary w-100 mt-2">Cancelar</a>
            </fieldset>
        </form>
    </section>
</main>
<?php
require("pie.php");
?>