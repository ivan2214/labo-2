<?php

if (!empty($_POST['username']) && !empty($_POST['password'])) {
    //hacer cuestiones
    $usernameFromForm = $_POST['username'];
    $passwordFromForm = $_POST['password'];

    if (trim($usernameFromForm) == "" || trim($passwordFromForm) == "") {
        header("refresh:2;url=../index.php");
        echo '<p>Los campos no pueden estar vacios</p>';
    }

    // quitar espacios
    $usernameFromForm = trim($usernameFromForm);
    $passwordFromForm = trim($passwordFromForm);
    $passwordFromForm = sha1($passwordFromForm);

    require_once 'conexion.php';

    $conexion = conectar();

    if (!$conexion) {
        header("refresh:1;url=../index.php");
        echo '<p>No se ha podido conectar con la base de datos</p>';
    }


    $consulta = 'SELECT usuario,pass FROM usuario WHERE usuario = ? AND pass = ?';

    $sentencia = mysqli_prepare($conexion, $consulta);

    mysqli_stmt_bind_param($sentencia, 'ss', $usernameFromForm, $passwordFromForm);


    $q = mysqli_stmt_execute($sentencia);


    mysqli_stmt_bind_result($sentencia, $usernameDB, $passwordDB);

    if ($q) {
        mysqli_stmt_fetch($sentencia);

        if (!empty($usernameDB) && !empty($passwordDB)) {

            header("refresh:0;url=articulo_listado.php?usuario=" . $usernameDB);
            echo '<p>Acceso concedido redirigiendo!</p>';
        } else {
            header("refresh:1;url=../index.php");
            echo '<p>Error usuario o contraseña incorrectos</p>';
        }
    }


    desconectar($conexion);
} else {
    header("refresh:1;url=../index.php");
    echo '<p>Los campos no pueden estar vacios</p>';
}
