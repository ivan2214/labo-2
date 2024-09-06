<?php require_once('php/encabezado.php'); ?>


<?php

const COTIZACION_USDT = 1322.74;
$dineroDisponible = rand(200000, 400000);


if ($dineroDisponible < 300000) {

    $comision = $dineroDisponible * 0.01; // 1% de comisión
    $porcentajeComision = "1%";
} else {
    $comision = $dineroDisponible * 0.005; // 0.5% de comisión
    $porcentajeComision = "0.5%";
}

$dineroRestante = $dineroDisponible - $comision;


$usdtComprados = $dineroRestante / COTIZACION_USDT;

?>

<main class="flex justify-center h-full items-center my-5">
    <section class="">
        <article class="flex flex-col items-start gap-y-4">
            <p>Dinero Disponible: <strong>$ <?php echo number_format($dineroDisponible, 2, ',', '.'); ?></strong></p>
            <p>Comisión: <strong><?php echo $porcentajeComision; ?></strong></p>
            <p>Dinero restante: <strong>$ <?php echo number_format($dineroRestante, 2, ',', '.'); ?></strong></p>
            <p>Cotización de USDT: <strong>$ <?php echo number_format(COTIZACION_USDT, 2, ',', '.'); ?></strong></p>
            <p class="text-red-500">USDT adquiridos: <strong><?php echo number_format($usdtComprados, 4, ',', '.'); ?></strong></p>
        </article>
    </section>
</main>

<?php require_once('php/pie.php'); ?>