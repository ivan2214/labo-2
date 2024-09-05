<?php require_once('php/encabezado.php'); ?>

<?php
// Generar dos números aleatorios del 1 al 12
$naipe1 = rand(1, 12);
$naipe2 = rand(1, 12);

/* $naipe1 = 9;
$naipe2 = 10; */


function determinarValorNaipe($naipe)
{
    if ($naipe == 10 || $naipe == 11 || $naipe == 12) {
        return 0.5;
    }
    return $naipe;
}

function calcularPuntaje($naipe1, $naipe2)
{
    $valorNaipe1 = determinarValorNaipe($naipe1);
    $valorNaipe2 = determinarValorNaipe($naipe2);

    $resultado = $valorNaipe1 + $valorNaipe2;
    return $resultado;
}

// para mostar een html
function obtenerNombreCarta($naipe)
{
    switch ($naipe) {
        case 10:
            return "Sota";
        case 11:
            return "Caballo";
        case 12:
            return "Rey";
        default:
            return $naipe; // Para cartas del 1 al 9
    }
}

// Calcular puntaje
$puntaje = calcularPuntaje($naipe1, $naipe2);
$carta1 = obtenerNombreCarta($naipe1);
$carta2 = obtenerNombreCarta($naipe2);

// Determinar el mensaje de resultado
$resultado = ($puntaje == 9.5)
    ? '<p class="text-success">GANADOR!</p>'
    : '<p class="text-danger">PUNTOS OBTENIDOS: <strong>' . number_format($puntaje, 1) . '</strong></p>';
?>





<main>
    <section class="container my-5">
        <article>
            <p>Naipe 1: <?= $carta1; ?></p>
            <p>Naipe 2: <?= $carta2; ?></p>
            <?= $resultado; ?>
        </article>
    </section>
</main>

<?php require_once('php/pie.php'); ?>