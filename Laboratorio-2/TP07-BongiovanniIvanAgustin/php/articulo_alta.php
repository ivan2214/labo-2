<?php
$ruta = '../';
require("encabezado.php");

$usuarioFoto = $_GET["usuarioFoto"];
$rutaFotosUsuarios = "../img/usuarios/";
$ubicacionFoto = $rutaFotosUsuarios . $usuarioFoto;
$usuarioNombre = explode(".", $usuarioFoto)[0];


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
        <form class="p-4 border rounded w-50" action=<?= "articulo_alta_ok.php?usuario=" . $usuarioNombre ?> method="POST"
            enctype="multipart/form-data">
            <fieldset>
                <legend class="text-center mb-4">Alta de Artículo</legend>

                <label for="nombre" class="form-label">Nombre del artículo</label>
                <input type="text" id="nombre" name="nombre" class="form-control mb-3" required>

                <label for="categoria" class="form-label">Categoría</label>
                <input type="text" id="categoria" name="categoria" class="form-control mb-3" required>

                <label for="precio" class="form-label">Precio</label>
                <input type="number" step="0.01" id="precio" name="precio" class="form-control mb-3" required>

                <label for="imagen" class="form-label">Subir imagen del artículo</label>
                <input type="file" id="imagen" name="imagen" class="form-control mb-4">

                <button type="submit" class="btn btn-primary w-100">Dar de alta</button>
            </fieldset>
        </form>
    </section>
</main>

<?php
require("pie.php");
?>