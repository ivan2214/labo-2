
<?php

session_start();

if (!empty($_GET['id'])) {
    $id = $_GET['id'];

    if (!empty($_SESSION['carrito'][$id])) {
        if ($_SESSION['carrito'][$id] > 1) {

            $_SESSION['carrito'][$id]--;
        } else {
            unset($_SESSION['carrito'][$id]);
        }
    }



    header("refresh:0;url=articulo_carrito.php");
} else {
    header("refresh:0;url=articulo_carrito.php");
}
