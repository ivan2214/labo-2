<?php
$legajoDesdeForm = "";
$legajoEncontrado = false;
$apellido = "";
$nombre = "";
$sueldo = 0;

if (!empty($_POST['legajo'])) {
    $legajoDesdeForm = $_POST['legajo'];

    $ubicacion = "../csv/";
    $nombreArchivo = "sueldos.csv";
    $ubicacionCompleta = $ubicacion . $nombreArchivo;
    $archivo = fopen($ubicacionCompleta, 'r');
    // leo hasta el final y mientras no haya encontrado el lagajo
    while (!feof($archivo) && !$legajoEncontrado) {
        $linea = fgets($archivo);
        $linea = trim($linea);
        // limpio la linea y compruebo que no sea vacia
        if ($linea != "") {
            $partes = explode(";", $linea); //separo la linea en array para obtener los datos necesarios
            // forma: legajo;apellido;nombre;sueldo
            $legajoDesdeArchivo = $partes[0];
            if ($legajoDesdeForm == $legajoDesdeArchivo) {
                $legajoEncontrado = true; // el legajo coincide con el del formulario entonces no seguira leyendo el archivo buscando el legajo
                $apellido = $partes[1];
                $nombre = $partes[2];
                $sueldo = (float) $partes[3];
                // guardo los datos del legajo encontrado para mostrarlos en el archivo
            }
        }
    }
    fclose($archivo);


    if (!$legajoEncontrado) {
        header('refresh:2;url=../index.php');
        require_once('encabezado.php');
        echo '<main class="flex justify-center h-full items-center">';
        echo '<section class="bg-white p-6 rounded shadow-md w-full max-w-sm">';
        echo "<p>Legajo inexistente</p>";
        echo '</section>';
        echo '</main>';
        require_once('pie.php');
    } else {
        // esto me enseño un ayudante de practica a condicionar el html
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
    }
}
?>