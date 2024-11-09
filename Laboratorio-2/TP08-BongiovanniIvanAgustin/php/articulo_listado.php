<?php
session_start();

$ruta = '../';
require_once "encabezado.php";

$rutaFotosArticulos = "../img/articulos/";

if (empty($_SESSION["usuario"]))
    header('refresh:1;../index.php');




if (empty($_SESSION['tipoUsuario'])) {
    header('refresh:1;../index.php');
}
$tipoUsuario = $_SESSION['tipoUsuario'];

if (!empty($_POST["categoria"])) {
    $categoria = $_POST["categoria"];
} else {
    $categoria = "";
}

if (!empty($_GET["buscar"])) {
    $buscar = $_GET["buscar"];
} else {
    $buscar = "";
}



?>

<main class="container">

    <?php
    require_once 'header.php';
    ?>

    <section>
        <article class="row text-center">
            <section class="d-flex w-100 justify-content-between pt-3 pb-3">


                <form action="articulo_listado.php" method="get">
                    <!-- 
                    si buscar es vacio se muestra vacio
                    sino se muestra lo que viene por get en el input    
                 -->
                    <input value="<?= !empty($buscar) ? $buscar : "" ?>" id="buscar" name="buscar" type="search" placeholder="Buscar..." />
                    <button type="submit" class="btn btn-secondary">
                        Buscar
                    </button>
                </form>


                <section class="d-flex justify-content-center align-items-center">
                    <?php
                    if ($tipoUsuario == "Administrador") {
                        require_once 'boton_alta_articulo.php';
                    } else {
                        require_once 'boton_mi_carrito.php';
                    }
                    ?>
                </section>


                <form method="post" class="d-flex justify-content-center align-items-center">
                    <select id="categoria" name="categoria" class="form-select">
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

                    <button type="submit" class="btn btn-secondary">
                        Filtrar
                    </button>
                </form>

            </section>

            <section class="d-flex justify-content-center">
                <table class="table table-bordered table-hover table-striped w-auto">
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
                            header("refresh:0;url=../index.php");
                            echo '<p>No se ha podido conectar con la base de datos</p>';
                        } else {



                            if (!empty($_GET["buscar"])) {
                                $buscar = $_GET["buscar"];
                            }

                            if (!empty($_POST["categoria"])) {
                                $categoria = $_POST["categoria"];
                            }


                            if (empty($buscar) && (empty($categoria) || $categoria == "Todos")) {
                                $consulta = "SELECT * FROM articulo";
                            } else if (!empty($buscar) && !empty($categoria) && $categoria != "Todos") {
                                $consulta = "SELECT * FROM articulo WHERE nombre LIKE ? AND categoria LIKE ?";
                            } else if (!empty($buscar)) {
                                $consulta = "SELECT * FROM articulo WHERE nombre LIKE ?";
                            } else if (!empty($categoria) && $categoria != "Todos") {
                                $consulta = "SELECT * FROM articulo WHERE categoria LIKE ?";
                            }


                            $sentencia = mysqli_prepare($conexion, $consulta);

                            if (!empty($buscar) && !empty($categoria) && $categoria != "Todos") {
                                // caso que busca por nombre y categoria distinta de todos
                                $cate = "%" . $categoria . "%";
                                $busca = "%" . $buscar . "%";
                                mysqli_stmt_bind_param($sentencia, "ss", $busca, $cate);
                            } else if (!empty($buscar)) {
                                // caso que solo busca por nombre
                                $busca = "%" . $buscar . "%";
                                mysqli_stmt_bind_param($sentencia, "s", $busca);
                            } else if (!empty($categoria) && $categoria != "Todos") {
                                // caso que solo busca por categoria
                                $cat = "%" . $categoria . "%";
                                mysqli_stmt_bind_param($sentencia, "s", $cat);
                            }


                            $q = mysqli_stmt_execute($sentencia);

                            mysqli_stmt_bind_result($sentencia, $id, $nombre, $categoria, $precio, $fotoArticulo);

                            if ($q) {

                                mysqli_stmt_store_result($sentencia);
                                $cantFilas = mysqli_stmt_num_rows($sentencia);



                                if ($cantFilas > 0) {
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

                                        if ($tipoUsuario == "Administrador") {
                                            // solo muestra los botones de modificar y eliminar si es administrador
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
                                        } else {
                                            // solo muestra el boton de comprar si no es administrador
                                            echo '<td >
                    <a  href="articulo_carrito.php?id=' . $id . '">
                    <img src="../img/carrito.png" alt="Imagen del carrito" >
                    </a>
                    </td>';
                                        }
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