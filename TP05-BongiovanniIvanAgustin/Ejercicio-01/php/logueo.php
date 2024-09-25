<?php

if (!empty($_POST['usuario']) && !empty($_POST['contraseña'])) {

    $usuario = trim($_POST['usuario']);
    $contraseña = trim($_POST['contraseña']);

    $validado = false;

    $archivo = fopen('../usuarios.txt', 'r');
    if ($archivo) {
        while (!feof($archivo)) {
            $linea = fgets($archivo); // Leer la línea del archivo
            if ($linea !== false) { // Asegurarse de que la línea no sea falsa
                $datos = explode(';', trim($linea)); // Separar el usuario y la contraseña
                $user = $datos[0]; // Primer elemento
                $pass = $datos[1]; // Segundo elemento

                if ($usuario === $user && $contraseña === $pass) {
                    $validado = true;
                    break;
                }
            }
        }
        fclose($archivo);
    }

    if ($validado) {

        header('refresh:1;url=listado.php?usuario=' . $usuario);
    } else {
        header('refresh:3;url=../index.php');
        require_once('encabezado.php');
        // Mostrar mensaje de datos incorrectos:
        echo '<main class="flex justify-center h-full items-center">';
        echo '<section class="bg-white p-6 rounded-md shadow-md w-full max-w-sm">';
        echo '<h2 class="text-xl font-semibold text-center">Usuario o contraseña incorrectos</h2>';
        echo '</section>';
        echo '</main>';
    }
} else {
    // Redirigir si se accede directamente al archivo
    header('refresh:2;url=../index.php');
    require_once('encabezado.php');
    // mostrar acceso invalido
    echo '<main class="flex justify-center h-full items-center">';
    echo '<section class="bg-white p-6 rounded shadow-md w-full max-w-sm">';
    echo '<h2 class="text-xl font-semibold text-center">Acceso invalido</h2>';
    echo '</section>';
    echo '</main>';

}
