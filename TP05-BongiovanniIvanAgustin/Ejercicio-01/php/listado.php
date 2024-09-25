<?php

require_once('encabezado.php');

// Verificar que se haya pasado un usuario
if (!empty($_GET['usuario'])) {
    $usuario = $_GET['usuario'];
}



$img = ""; // Inicializar la variable de formato

// Abrir el archivo de usuarios
$archivo = fopen('../usuarios.txt', 'r');
if ($archivo) {
    while (($linea = fgets($archivo)) !== false) {
        $datos = explode(';', trim($linea)); // Separar los datos
        if ($datos[0] === $usuario) {

            $img = $datos[2]; // Obtener el nombre de la imagen
            break; // Salir del bucle si se encuentra el usuario
        }
    }
    fclose($archivo);
}


// Supongamos que la foto del usuario se encuentra en una carpeta 'img'
$foto = "../img/" .  $img;
?>


<main>
    <header>
        <h1>Bienvenido, <?php echo $usuario; ?></h1>
        <?php if (file_exists($foto)): ?>
            <img src="<?php echo $foto; ?>" alt="Foto de <?php echo $usuario; ?>" />
        <?php else: ?>
            <p>No se encontró la foto.</p>
        <?php endif; ?>
    </header>
</main>


<?php require_once('pie.php'); ?>