<?php
if (!empty($_POST['usuario']) && !empty($_POST['contraseña'])) {

    $usuario = trim($_POST['usuario']);
    $contraseña = trim($_POST['contraseña']);

    $validado = false;

    $archivo = fopen('../usuarios.txt', 'r');
    if ($archivo) {
        while (!feof($archivo) && !$validado) { // mientras no sea el final del archivo y no esté validado
            $linea = fgets($archivo); // obtiene una linea del archivo
            if ($linea != "") { // si la linea no es vacia
                $datos = explode(';', trim($linea)); // separo la linea en un array
                $user = $datos[0]; // obtengo el usuario
                $pass = $datos[1]; // obtengo la contraseña
                // limpiar espacios en blanco de la contraseña y el usuario
                $user = trim($user);
                $pass = trim($pass);
                if ($usuario === $user && $contraseña === $pass) {
                    $validado = true;
                } else {
                    $validado = false;
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
        echo '<h2 class="text-xl font-semibold text-center">Datos incorrectos</h2>';
        echo '</section>';
        echo '</main>';
        require_once('pie.php');
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

    require_once('pie.php');
}
