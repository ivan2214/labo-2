<?php
$legajoDesdeForm = "";
$legajoEncontrado = false;
$apellido = "";
$nombre = "";
$sueldo = "";

if (!empty($_POST['legajo'])) {
    $legajoDesdeForm = $_POST['legajo'];
    // El archivo CSV tiene la forma: legajo;apellido;nombre;sueldo
    $ubicacion = "../csv/";
    $nombreArchivo = "sueldos.csv";
    $ubicacionCompleta = $ubicacion . $nombreArchivo;
    $archivo = fopen($ubicacionCompleta, 'r');
    if ($archivo != false) {
        while (!feof($archivo) && !$legajoEncontrado) {
            $linea = fgets($archivo);
            $linea = trim($linea);
            if (!empty($linea)) {
                $partes = explode(";", $linea);
                $legajoDesdeArchivo = $partes[0];

                if ($legajoDesdeForm == $legajoDesdeArchivo) {
                    $legajoEncontrado = true;
                    $apellido = $partes[1];
                    $nombre = $partes[2];
                    $sueldo = $partes[3];
                }
            }
        }
        fclose($archivo);
    }

    if (!$legajoEncontrado) {

        header('refresh:2;url=../index.php');
        echo '<main class="flex justify-center h-full items-center">';
        echo '<section class="bg-white p-6 rounded shadow-md w-full max-w-sm">';
        echo "<p>Legajo inexistente</p>";
        echo '</section>';
        echo '</main>';
    }
}
?>

<?php

require_once('encabezado.php');

?>


<main class="flex justify-center h-full items-center">
    <section class="bg-white p-6 rounded shadow-md w-full max-w-sm grid grid-rows-2">
        <section class="grid grid-cols-3">

            <section class="col-span-1 border border-blue-500 rounded p-4">
                <h2 class="text-lg font-bold">Legajo:</h2>
                <p class="text-sm"><?= $legajoDesdeForm ?></p>
            </section>
            <section class="col-span-2 border border-yellow-500 rounded p-4">
                <h2 class="text-lg font-bold">Apellido y nombre:</h2>
                <p class="text-sm"><?= $apellido . " " . $nombre ?></p>
            </section>

        </section>

        <section class="border flex justify-center flex-col items-center border-red-500 rounded p-4">
            <h2 class="text-lg font-bold">Sueldo a cobrar:</h2>
            <p class="text-sm">$<?= number_format($sueldo, 2, ',', '.') ?></p>
        </section>
    </section>
</main>


<?php
require_once('pie.php');
?>