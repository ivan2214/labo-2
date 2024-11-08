<?php
session_start();

$ruta = '../';
require_once "encabezado.php";
$rutaFotosUsuarios = "../img/usuarios/";
$rutaFotosArticulos = "../img/articulos/";

if (!empty($_SESSION["usuario"])) {
    $usuario = $_SESSION["usuario"];
    $fotoUsuario = $_SESSION["fotoUsuario"];
    var_dump($_SESSION);

    if ($fotoUsuario == "" || $fotoUsuario == NULL || empty($fotoUsuario)) {
        $fotoUsuario = "usuario_default.png";
    }
} else {
    header('refresh:1;../index.php');
    $usuario = "";
    $fotoUsuario = "usuario_default.png";
}

require_once 'funciones.php';

date_default_timezone_set('America/Argentina/Tucuman');

$fecha = date("Y-m-d");

$fechaDeHoy = crearFecha($fecha);

echo  $fotoUsuario;

?>

<main class="container">
    <header class="d-flex align-items-center justify-content-between bg-secondary shadow">
        <section class="p-2">
            <h2 class="h5 fw-semibold mb-0"><?= $fechaDeHoy ?></h2>
        </section>
        <section class="d-flex align-items-center gap-3 px-3 py-2">
            <h2 class="h5 fw-semibold mb-0"><?= $usuario ?></h2>
            <figure class="rounded-circle overflow-hidden border" style="width: 48px; height: 48px;">
                <img class="img-fluid rounded-circle" src="<?= $rutaFotosUsuarios . $fotoUsuario ?>"
                    alt="Foto de perfil del usuario" style="width: 100%; height: 100%;">
            </figure>
        </section>
    </header>

    <section>
        <article class="row text-center">
            <section class="menu_tmp pt-3 pb-3">
                <a class="btn btn-dark" href="articulo_alta.php">+ Alta Articulo</a>
            </section>
            <section class="d-flex justify-content-center">
                <table class="table table-bordered table-hover table-striped w-auto">
                    <caption class="caption-top text-center bg-dark text-white">Listado de artículos</caption>
                    <tr>
                        <th class="bg-secondary text-white">Foto</th>
                        <th class="bg-secondary text-white">Producto</th>
                        <th class="bg-secondary text-white">Categoría</th>
                        <th class="bg-secondary text-white">Precio</th>
                        <th class="bg-secondary text-white">Modificar</th>
                        <th class="bg-secondary text-white">Eliminar</th>
                    </tr>


                    <tbody class="bg-white">
                        <?php

                        require_once 'conexion.php';

                        $conexion = conectar();


                        if (!$conexion) {
                            header("refresh:0;url=../index.php");
                            echo '<p>No se ha podido conectar con la base de datos</p>';
                        } else {

                            $consulta = "SELECT id_articulo, nombre, categoria, precio, foto FROM articulo"; // consulta

                            $sentencia = mysqli_prepare($conexion, $consulta); // prepara la sentencia

                            $q = mysqli_stmt_execute($sentencia); // ejecuta la sentencia

                            mysqli_stmt_bind_result($sentencia, $id, $nombre, $categoria, $precio, $fotoArticulo); // asocia los resultados

                            if ($q) {

                                mysqli_stmt_store_result($sentencia); // almacena los resultados
                                $cantFilas = mysqli_stmt_num_rows($sentencia);



                                if ($cantFilas > 0) {
                                    //si obtuve resultados entonces los voy a iterar y los mostrare por pantalla en la tabla
                                    // esto va uno por uno no lo devuelve como un array sino que es independiente del anterior podria guardar en un array los valores e iterarlos luego tambien (es una opcion) (Nota para el que corrige: escribo esto para acordarme como vuelven los datos)
                                    while (mysqli_stmt_fetch($sentencia)) {
                                        if ($fotoArticulo == '' || $fotoArticulo == NULL || empty($fotoArticulo)) {
                                            $fotoArticulo = "sin_imagen.png";
                                        }
                                        echo '<td>
            <img src="' . $rutaFotosArticulos . $fotoArticulo . '" alt="Imagen del artículo" style="width: 100px; height: auto;">
            </td>';
                                        echo '<td>' . $nombre . '</td>';
                                        echo '<td>' . $categoria . '</td>';
                                        echo '<td>$ ' . number_format($precio, 0, ",", ".") . '</td>';
                                        echo '<td >
                    <a  href="articulo_modificar.php?id=' . $id . '">
                    <img src="../img/modificar.png" alt="Imagen del artículo" >
                    </a>
                    </td>';
                                        echo '<td >
                    <a  href="articulo_eliminar.php?id=' . $id . '">
                    <img src="../img/eliminar.png" alt="Imagen del artículo" >
                    </a>
                    </td>';
                                        echo '</tr>';
                                    }
                                } else {
                                    echo '<p>No hay articulos</p>';
                                }
                            }
                            desconectar($conexion);
                        }

                        ?>
                    </tbody>

                </table>
            </section>
        </article>
    </section>
</main>

<?php
require_once "pie.php";
?>