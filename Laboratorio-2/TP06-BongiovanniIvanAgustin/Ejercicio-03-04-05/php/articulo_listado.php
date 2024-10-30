<?php
$ruta = '../css/';
require_once "encabezado.php";



if (!empty($_GET["usuario"])) {
    $usuario = $_GET["usuario"];
    $rutaFotosUsuarios = "../img/usuarios/";
    $rutaFotosArticulos = "../img/articulos/";

    require_once 'conexion.php';

    $conexion = conectar();

    if (!$conexion) {
        header("refresh:1;url=../index.php");
        echo '<p>No se ha podido conectar con la base de datos</p>';
    } else {
        $consulta = "SELECT usuario, foto FROM usuario WHERE usuario = ? ";

        $sentencia = mysqli_prepare($conexion, $consulta);

        mysqli_stmt_bind_param($sentencia, 's', $usuario);

        $q = mysqli_stmt_execute($sentencia);

        mysqli_stmt_bind_result($sentencia, $usuarioDB, $fotoDB);

        if ($q) {
            mysqli_stmt_fetch($sentencia);
            if (!$fotoDB || $fotoDB == "" || $fotoDB == null) {
                $fotoDB = "usuario_default.png";
            }
        } else {
            header("refresh:1;url=../index.php");
            echo '<p>Usuario no encontrado</p>';
        }

        desconectar($conexion);

    }





}

?>

<main class="container">
    <header class="d-flex align-items-center justify-content-end bg-secondary shadow">
        <section class="d-flex align-items-center gap-3 px-3 py-2">
            <h2 class="h5 fw-semibold mb-0"><?= $usuarioDB ?></h2>
            <figure class="rounded-circle overflow-hidden border" style="width: 48px; height: 48px;">
                <img class="img-fluid rounded-circle" src="<?= $rutaFotosUsuarios . $fotoDB ?>"
                    alt="Foto de perfil del usuario" style="width: 100%; height: 100%;">
            </figure>
        </section>
    </header>

    <section>
        <article class="row text-center">
            <section class="menu_tmp pt-3 pb-3">
                <a class="btn btn-dark" href=<?= "articulo_alta.php?usuario=" . $usuarioDB ?>>+ Alta Articulo</a>
            </section>
            <section class="d-flex justify-content-center">
                <table class="table table-bordered table-hover table-striped w-auto">
                    <caption class="caption-top text-center bg-dark text-white">Listado de artículos</caption>
                    <tr>
                        <th class="bg-secondary text-white">Foto</th>
                        <th class="bg-secondary text-white">Producto</th>
                        <th class="bg-secondary text-white">Categoría</th>
                        <th class="bg-secondary text-white">Precio</th>
                    </tr>

                    <?php

                    $conexion = conectar();


                    if (!$conexion) {
                        header("refresh:0;url=../index.php");
                        echo '<p>No se ha podido conectar con la base de datos</p>';
                    } else {

                        $consulta = "SELECT nombre, categoria, precio, foto FROM articulo"; // consulta
                    
                        $sentencia = mysqli_prepare($conexion, $consulta); // prepara la sentencia
                    
                        $q = mysqli_stmt_execute($sentencia); // ejecuta la sentencia
                    
                        mysqli_stmt_bind_result($sentencia, $nombre, $categoria, $precio, $foto); // asocia los resultados
                    
                        if ($q) {

                            mysqli_stmt_store_result($sentencia); // almacena los resultados
                            $cantFilas = mysqli_stmt_num_rows($sentencia);

                            if (!$foto || $foto == "" || $foto == null) {
                                // si el usuario no tiene foto entonces le asigno una default
                                $foto = "sin_imagen.png";
                            }

                            if ($cantFilas > 0) {
                                //si obtuve resultados entonces los voy a iterar y los mostrare por pantalla en la tabla
                                // esto va uno por uno no lo devuelve como un array sino que es independiente del anterior podria guardar en un array los valores e iterarlos luego tambien (es una opcion)
                                while (mysqli_stmt_fetch($sentencia)) {
                                    if ($foto == '' || $foto == NULL || empty($foto)) {
                                        $foto = "sin_imagen.png";
                                    }
                                    echo '<td>
                                <img src="' . $rutaFotosArticulos . $foto . '" alt="Imagen del artículo" style="width: 100px; height: auto;">
                                </td>';
                                    echo '<td>' . $nombre . '</td>';
                                    echo '<td>' . $categoria . '</td>';
                                    echo '<td>$ ' . number_format($precio, 0, ",", ".") . '</td>';
                                    echo '</tr>';
                                }
                            } else {
                                echo '<p>No hay articulos</p>';
                            }
                        }
                        desconectar($conexion);
                    }

                    ?>
                </table>
            </section>
        </article>
    </section>
</main>

<?php
require_once "pie.php";
?>