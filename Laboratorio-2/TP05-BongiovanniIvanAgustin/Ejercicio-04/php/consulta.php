<?php

require_once('encabezado.php');

?>

<?php

$legajo = "";

if (!empty($_POST['legajo'])) {
    $legajo = $_POST['legajo'];
} else {
    header('refresh:2;url=../index.php');
    require_once('encabezado.php');
    echo '<main class="flex justify-center h-full items-center">';
    echo '<section class="bg-white p-6 rounded shadow-md w-full max-w-sm">';
    echo "<p>Legajo inexistente</p>";
    echo '</section>';
    echo '</main>';
}

?>


<main class="flex justify-center h-full items-center">
    <section class="bg-white p-6 rounded shadow-md w-full max-w-sm grid grid-rows-2">
        <section class="grid grid-cols-3">

            <section class="col-span-1 border border-blue-500 rounded p-4">
                <h2 class="text-lg font-bold">Legajo:</h2>
                <p class="text-sm">12345</p>
            </section>
            <section class="col-span-2 border border-yellow-500 rounded p-4">
                <h2 class="text-lg font-bold">Apellido y nombre:</h2>
                <p class="text-sm">Pérez, Juan</p>
            </section>

        </section>

        <section class="border flex justify-center flex-col items-center border-red-500 rounded p-4">
            <h2 class="text-lg font-bold">Sueldo a cobrar:</h2>
            <p class="text-sm">50,000 ARS</p>
        </section>
    </section>
</main>


<?php
require_once('pie.php');
?>