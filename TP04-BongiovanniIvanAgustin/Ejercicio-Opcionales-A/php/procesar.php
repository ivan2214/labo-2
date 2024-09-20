<?php require_once('encabezado.php'); ?>

<?php require_once('funciones.php'); ?>

<?php

$numero = 0;
$operacion = "";
$resultadoOperacion = 0;
if (!empty($_POST['numero'])) {
    $numero = $_POST['numero'];
}

if (!empty($_POST['operacion'])) {
    $operacion = $_POST['operacion'];
}


if ($operacion == "invertir") {
    $resultadoOperacion = invertirNumero($numero);
} else if ($operacion == "contar-impares") {
    $resultadoOperacion = contarImpares($numero);
} else if ($operacion == "contar-primos") {
    $resultadoOperacion = contarPrimos($numero);
}

?>


<main class="flex justify-center h-full items-center">
    <section class="bg-white p-6 rounded shadow-md w-full max-w-sm flex flex-col items-center gap-4">

        <header>
            <h1 class="text-xl font-semibold text-center"><?= $operacion ?></h1>
        </header>
        <section class="w-full flex flex-col gap-4 items-center">
            <p class="block font-medium text-gray-700">El resultado es:</p>
            <span class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"><?= $resultadoOperacion ?></span>
        </section>

    </section>

</main>


<?php require_once('pie.php'); ?>