<?php

function conectar()
{

    $servidor = "localhost";
    $usuario = "root";
    $clave = "";
    $nombreBD = "labo2";

    set_error_handler(function () {
        throw new Exception("Error");
    });

    try { // intentarara conectar con la db
        $conexion = mysqli_connect($servidor, $usuario, $clave, $nombreBD);
    } catch (Exception $e) { // atrapamos el error
        $conexion = false;
        echo '<p>Error al conectar, llamar al admin</p>';
    }
    return $conexion;
}

function desconectar($conexion)
{
    if ($conexion) {
        mysqli_close($conexion);
    } else {
        echo '<p>No se ha podido desconectar la base de datos</p>';
    }
}
