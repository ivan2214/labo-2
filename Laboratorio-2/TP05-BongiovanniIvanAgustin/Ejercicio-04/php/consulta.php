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

    require_once('pie.php');
}

?>


<main class="flex justify-center h-full items-center">
    <section class="grid grid-rows-2 gap-4 w-full max-w-screen-lg">
        <!-- Primera fila con dos columnas -->
        <section class="grid grid-cols-3 gap-4">
            <section class="col-span-1">
                <header>
                    <h2 class="text-lg font-bold">Legajo:</h2>
                </header>
                <p class="text-sm mt-2">123456</p>
            </section>
            <section class="col-span-2">
                <header>
                    <h2 class="text-lg font-bold">Apellido y nombre:</h2>
                </header>
                <p class="text-sm mt-2">Pérez, Juan</p>
            </section>
        </section>

        <!-- Segunda fila ocupando todo el ancho -->
        <section class="text-center">
            <header>
                <h2 class="text-lg font-bold">Sueldo a cobrar:</h2>
            </header>
            <p class="text-sm mt-2">100,000 ARS</p>
        </section>
    </section>
</main>