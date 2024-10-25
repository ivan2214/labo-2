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
        echo '<p>No se ha podido conectar con la base de datos</p>';
        header("refresh:0;url=../index.php");
    }


    $consulta = 'SELECT usuario,pass FROM usuario WHERE usuario = ? AND pass = ?';

    $sentencia = mysqli_prepare($conexion, $consulta);

    mysqli_stmt_bind_param($sentencia, 'ss', $usernameFromForm, $passwordFromForm);


    mysqli_stmt_execute($sentencia);


    mysqli_stmt_bind_result($sentencia, $username, $password);

    while (mysqli_stmt_fetch($sentencia)) {
        if ($username == $usernameFromForm && $password == $passwordFromForm) {
            // pasar usuario por url a articulo_listado.php
            header("refresh:1;url=articulo_listado.php?usuario=" . $username);
        } else {
            header("refresh:0;url=../index.php");
            echo '<p>Error usuario o contraseña incorrectos</p>';
        }
    }
    desconectar($conexion);
} else {
    header("refresh:0;url=../index.php");
}
