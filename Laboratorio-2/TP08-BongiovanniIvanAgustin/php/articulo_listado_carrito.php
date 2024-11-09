<main class="container">

    <?php
    require_once 'header.php';
    ?>

    <section>
        <article class="row text-center">
            <section class="d-flex justify-content-center">
                <table class="table table-bordered table-hover table-striped w-auto">
                    <caption class="caption-top text-center bg-dark text-white">Listado de carrito</caption>
                    <tr>
                        <th class="bg-secondary text-white">Foto</th>
                        <th class="bg-secondary text-white">Producto</th>
                        <th class="bg-secondary text-white">Categoría</th>
                        <th class="bg-secondary text-white">Precio</th>
                        <th class="bg-secondary text-white">Eliminar del carrito</th>
                    </tr>


                    <tbody class="bg-white">
                        <?php

                        if (count($_SESSION['carrito']) > 0 && !empty($_SESSION['carrito'])) {
                            foreach ($_SESSION['carrito'] as $articulo) {
                        ?>
                                <tr>
                                    <td>
                                        <img src="../img/articulos/<?= $articulo['foto'] ?>" alt="Imagen del articulo" style="width: 100px; height: auto;">
                                    </td>
                                    <td><?= $articulo['nombre'] ?></td>
                                    <td><?= $articulo['categoria'] ?></td>
                                    <td>$ <?= number_format($articulo['precio'], 0, ",", ".") ?></td>
                                    <td>
                                        <a href="articulo_carrito_eliminar.php?id=<?= $articulo['id'] ?>">
                                            <img src="../img/eliminar.png" alt="Imagen del carrito">
                                        </a>
                                    </td>
                                </tr>
                        <?php
                            }
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