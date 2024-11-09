<?php
session_start();

$ruta = '../';
require_once "encabezado.php";

$rutaFotosArticulos = "../img/articulos/";

if (empty($_SESSION["usuario"])) {
    header('refresh:1;../index.php');
}

if (empty($_SESSION['tipoUsuario'])) {
    header('refresh:1;../index.php');
}

$tipoUsuario = $_SESSION['tipoUsuario'];
$nombreUsuario = $_SESSION['usuario'];


function gestionarCookieCategoria($categoria, $nombreUsuario)
{
    if ($categoria == "Todos") {

        setcookie($nombreUsuario, "", time() - 3600, "/");
    } else {

        setcookie($nombreUsuario, $categoria, time() + 3600 * 24 * 30, "/"); // 30 dias
    }
}


if (isset($_POST["categoria"]) && !empty($_POST["categoria"])) {
    $categoria = $_POST["categoria"];
    gestionarCookieCategoria($categoria, $nombreUsuario);
} else {
    $categoria = isset($_COOKIE[$nombreUsuario]) && !empty($_COOKIE[$nombreUsuario]) ? $_COOKIE[$nombreUsuario] : "Todos";
}

$buscar = isset($_GET["buscar"]) ? $_GET["buscar"] : "";
?>

<main class="container">
    <?php require_once 'header.php'; ?>

    <section class="container py-3">
        <article class="row text-center d-flex gap-3">
            <section class="d-flex w-100 align-items-center container bg-secondary justify-content-between py-3">
                <form action="articulo_listado.php" method="get" class="d-flex w-25 justify-content-between px-1 bg-transparent py-2 align-items-center">
                    <input class="form-control w-75" value="<?= !empty($buscar) ? $buscar : "" ?>" id="buscar" name="buscar" type="search" placeholder="Buscar..." />
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </form>

                <section class="d-flex justify-content-center align-items-center w-25">
                    <?php
                    if ($tipoUsuario == "Administrador") {
                        require_once 'boton_alta_articulo.php';
                    } else {
                        require_once 'boton_mi_carrito.php';
                    }
                    ?>
                </section>


                <form method="post" class="d-flex w-25 justify-content-between px-1 bg-transparent py-2 align-items-center">
                    <select id="categoria" name="categoria" class="form-select w-75">
                        <!-- 
                    si lacategoria es vacia o es todos se selecciona por defecto el todos
                    sino selecciona la categoria que viene por get 

                     -->
                        <option value="Todos" <?= empty($categoria) || $categoria == 'Todos' ? 'selected' : '' ?>>Todos</option>
                        <option value="Celulares" <?= $categoria == 'Celulares' ? 'selected' : '' ?>>Celulares</option>
                        <option value="Televisores" <?= $categoria == 'Televisores' ? 'selected' : '' ?>>Televisores</option>
                        <option value="Laptops" <?= $categoria == 'Laptops' ? 'selected' : '' ?>>Laptops</option>
                        <option value="Electrodomesticos" <?= $categoria == 'Electrodomesticos' ? 'selected' : '' ?>>Electrodomésticos</option>
                    </select>
                    <button type="submit" class="btn btn-primary">Filtrar</button>
                </form>
            </section>

            <section class="d-flex justify-content-center">
                <table class="table shadow rounded-3 overflow-hidden table-bordered table-hover table-striped w-auto">
                    <caption class="caption-top text-center bg-dark text-white">Listado de artículos</caption>
                    <tr>
                        <th class="bg-secondary text-white">Foto</th>
                        <th class="bg-secondary text-white">Producto</th>
                        <th class="bg-secondary text-white">Categoría</th>
                        <th class="bg-secondary text-white">Precio</th>

                        <?php
                        if ($tipoUsuario == "Administrador") {
                            echo '<th class="bg-secondary text-white">Modificar</th>';
                            echo '<th class="bg-secondary text-white">Eliminar</th>';
                        } else {
                            echo '<th class="bg-secondary text-white">Comprar</th>';
                        }
                        ?>
                    </tr>
                    <tbody class="bg-white">
                        <?php
                        require_once 'conexion.php';
                        $conexion = conectar();

                        if (!$conexion) {
                            echo '<p>No se ha podido conectar con la base de datos</p>';
                        } else {
                            $consulta = "SELECT * FROM articulo";
                            if (!empty($buscar) && $categoria != "Todos") {
                                // caso con busqueda y categoria concateno a la consulta las condiciones
                                $consulta .= " WHERE nombre LIKE ? AND categoria LIKE ?";
                            } elseif (!empty($buscar)) {
                                // caso solo busqueda concateno a la consulta la condicion
                                $consulta .= " WHERE nombre LIKE ?";
                            } elseif ($categoria != "Todos") {
                                // caso solo categoria concateno a la consulta la condicion
                                $consulta .= " WHERE categoria LIKE ?";
                            }

                            $sentencia = mysqli_prepare($conexion, $consulta);


                            if (!empty($buscar) && $categoria != "Todos") {
                                // caso con busqueda y categoria bindeo los parametros de busqueda y categoria
                                $busca = "%" . $buscar . "%";
                                $cat = "%" . $categoria . "%";
                                mysqli_stmt_bind_param($sentencia, "ss", $busca, $cat);
                            } elseif (!empty($buscar)) {
                                // caso solo busqueda bindeo el parametro de busqueda
                                $busca = "%" . $buscar . "%";
                                mysqli_stmt_bind_param($sentencia, "s", $busca);
                            } elseif ($categoria != "Todos") {
                                // caso solo categoria bindeo el parametro de categoria
                                $cat = "%" . $categoria . "%";
                                mysqli_stmt_bind_param($sentencia, "s", $cat);
                            }

                            $q = mysqli_stmt_execute($sentencia);
                            mysqli_stmt_bind_result($sentencia, $id, $nombre, $categoria, $precio, $fotoArticulo);

                            if ($q) {
                                mysqli_stmt_store_result($sentencia);
                                if (mysqli_stmt_num_rows($sentencia) > 0) {
                                    while (mysqli_stmt_fetch($sentencia)) {
                                        $fotoArticulo = $fotoArticulo ?: "sin_imagen.png";
                                        echo '<tr>';
                                        echo '<td><img src="' . $rutaFotosArticulos . $fotoArticulo . '" alt="Imagen del artículo" style="width: 100px; height: auto;"></td>';
                                        echo '<td>' . $nombre . '</td>';
                                        echo '<td>' . $categoria . '</td>';
                                        echo '<td>$ ' . number_format($precio, 0, ",", ".") . '</td>';

                                        if ($tipoUsuario == "Administrador") {
                                            echo '<td><a href="articulo_modificar.php?id=' . $id . '"><img src="../img/modificar.png" alt="Modificar"></a></td>';
                                            echo '<td><a href="articulo_eliminar.php?id=' . $id . '"><img src="../img/eliminar.png" alt="Eliminar"></a></td>';
                                        } else {
                                            echo '<td><a href="articulo_carrito.php?id=' . $id . '"><img src="../img/carrito.png" alt="Carrito"></a></td>';
                                        }
                                        echo '</tr>';
                                    }
                                } else {
                                    echo '<tr><td colspan="6">No hay artículos</td></tr>';
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

<?php require_once "pie.php"; ?>