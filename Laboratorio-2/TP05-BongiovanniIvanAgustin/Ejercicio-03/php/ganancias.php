<?php

require_once("encabezado.php");

require_once("funciones.php");


$deposito = 0;
$plazo = 0;
$intereses = 0;
$montoTotal = 0;

if (!empty($_POST['deposito'])) {
    $deposito = $_POST['deposito'];

    settype($deposito, 'integer');
}

if (!empty($_POST['plazo'])) {
    $plazo = $_POST['plazo'];
    settype($plazo, 'integer');
}

if ($plazo > 0 && $deposito > 0) {
    $intereses = calcularIntereses($deposito, $plazo);

    $montoTotal = $deposito + $intereses;
}

?>


<main class="flex justify-center h-full items-center">
    <section class="bg-gray-100 rounded-lg shadow-md p-6 w-full max-w-3xl">
        <h1 class="text-2xl font-bold text-center mb-4">Resumen Financiero</h1>
        <table class="min-w-full bg-gray-100 border border-gray-300 rounded-lg">
            <thead>
                <tr class="bg-gray-200">
                    <th class="py-2 px-4 text-left font-semibold">Depósito</th>
                    <th class="py-2 px-4 text-left font-semibold">Plazo</th>
                    <th class="py-2 px-4 text-left font-semibold">Interés Generado</th>
                    <th class="py-2 px-4 text-left font-semibold">Monto Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="py-2 px-4 border-b"><?php echo $deposito; ?></td>
                    <td class="py-2 px-4 border-b"><?php echo $plazo . " días"; ?></td>
                    <td class="py-2 px-4 border-b"><?php echo number_format($intereses, 2, ",", "."); ?></td>
                    <td class="py-2 px-4 border-b"><?php echo number_format($montoTotal, 2, ",", "."); ?></td>
                </tr>
            </tbody>
        </table>
    </section>
</main>

<?php require_once('pie.php'); ?>