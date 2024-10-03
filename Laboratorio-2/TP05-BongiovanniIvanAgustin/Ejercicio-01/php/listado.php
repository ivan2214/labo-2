<?php

require_once('encabezado.php');

// Verificar que se haya pasado un usuario
if (!empty($_GET['usuario'])) {
    $usuario = $_GET['usuario'];
}



$img = "";

// abro el archivo de usuarios
$archivo = fopen('../usuarios.txt', 'r');
if ($archivo) {
    while (!feof($archivo)) {
        $linea = fgets($archivo); // obtiene una linea del archivo
        if ($linea != "") { // si la linea no es vacia
            $datos = explode(';', trim($linea)); // separo la linea en un array
            if ($datos[0] == $usuario) {
                $img = $datos[2];
            }
        }
    }
    fclose($archivo);
}


// Supongamos que la foto del usuario se encuentra en una carpeta 'img'
$foto = "../img/" .  $img;
?>


<main>
    <header class="flex items-center justify-end bg-zinc-500 shadow">
        <section class="flex items-center gap-x-4 px-4 py-2">
            <h2 class="text-xl font-semibold"><?= $usuario ?></h2>
            <figure class="w-12 h-12 rounded-full border">
                <img class="w-12 h-12 rounded-full p-1" src="<?= $foto ?>" alt="Foto de perfil del usuario">
            </figure>
        </section>
    </header>
</main>


<?php require_once('pie.php'); ?>