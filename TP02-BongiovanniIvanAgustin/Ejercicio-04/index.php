<?php require_once('php/encabezado.php'); ?>


<?php
// Cotización de USDT
const COTIZACION_USDT = 1322.74;
$dineroDisponible = rand(200000, 400000);

// Calcular la comisión y el dinero restante
if ($dineroDisponible < 300000) {
    $comision = $dineroDisponible * 0.01; // 1% de comisión
    $porcentajeComision = "1%";
} else {
    $comision = $dineroDisponible * 0.005; // 0.5% de comisión
    $porcentajeComision = "0.5%";
}

$dineroRestante = $dineroDisponible - $comision;

// Cantidad de USDT comprados
$usdtComprados = $dineroRestante / COTIZACION_USDT;
?>

<main>
    <section class="container my-5">
        <article>
            <p>Dinero Disponible: <strong>$ <?php echo number_format($dineroDisponible, 2, ',', '.'); ?></strong></p>
            <p>Comisión: <strong><?php echo $porcentajeComision; ?></strong></p>
            <p>Dinero restante: <strong>$ <?php echo number_format($dineroRestante, 2, ',', '.'); ?></strong></p>
            <p>Cotización de USDT: <strong>$ <?php echo number_format(COTIZACION_USDT, 2, ',', '.'); ?></strong></p>
            <p class="text-danger">USDT adquiridos: <strong><?php echo number_format($usdtComprados, 4, ',', '.'); ?></strong></p>
        </article>
    </section>
</main>

<?php require_once('php/pie.php'); ?>