<?php
$ruta = '../';
require("encabezado.php");

if (!empty($_SESSION["usuario"])) {
    $usuario = $_SESSION["usuario"];
    $fotoUsuario = $_SESSION["fotoUsuario"];


    if ($fotoUsuario == "" || $fotoUsuario == NULL || empty($fotoUsuario)) {
        $fotoUsuario = "usuario_default.png";
    }
} else {
    header('refresh:1;../index.php');
    $usuario = "";
    $fotoUsuario = "usuario_default.png";
}

$rutaFotosUsuarios = "../img/usuarios/";
$ubicacionFoto = $rutaFotosUsuarios . $fotoUsuario;

require_once 'funciones.php';


date_default_timezone_set('America/Argentina/Tucuman');

$fecha = date("Y-m-d");

$fechaDeHoy = crearFecha($fecha);

?>

<header class="d-flex align-items-center justify-content-between bg-secondary shadow">
    <section class="p-2">
        <a class="btn btn-dark" href="articulo_listado.php">
            Listado de articulos
        </a>
    </section>
    <section class="p-2">
        <h2 class="h5 fw-semibold mb-0"><?= $fechaDeHoy ?></h2>
    </section>
    <section class="d-flex align-items-center gap-3 p-2">
        <h2 class="h5 fw-semibold mb-0"><?= $usuario ?></h2>
        <figure class="rounded-circle overflow-hidden border" style="width: 48px; height: 48px;">
            <img class="img-fluid rounded-circle" src="<?= $ubicacionFoto ?>" alt="Foto de perfil del usuario"
                style="width: 100%; height: 100%;">
        </figure>

        <a href="cerrar_session_ok.php" class="btn btn-dark">
            Cerrar Session
        </a>

    </section>
</header>