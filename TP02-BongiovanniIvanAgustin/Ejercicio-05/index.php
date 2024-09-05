<?php require_once('php/encabezado.php'); ?>

<?php
// Generar dos números aleatorios del 1 al 12
$naipe1 = rand(1, 12);
$naipe2 = rand(1, 12);

/* 
naipes ganadorees pruebas sumados dan 9.5 puntos
$naipe1 = 9;
$naipe2 = 10; */


function determinarValorNaipe($naipe)
{
    // si es un naipe del 10 o 11 o 12 dan 0.5 puntos y sino el naipe tiene el mismo valor
    if ($naipe == 10 || $naipe == 11 || $naipe == 12) {
        return 0.5;
    }
    return $naipe;
}

function calcularPuntaje($naipe1, $naipe2)
{
    // calcular el valor de cada naipe y sumarlos para determinar elresultado del juego
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
// obtener nombre de las cartas para mostrarr en el hmtl
$carta1 = obtenerNombreCarta($naipe1);
$carta2 = obtenerNombreCarta($naipe2);

// mensaje de resultado
$resultado = ($puntaje == 9.5)
    ? '<p class="text-green-500">GANADOR!</p>'
    : '<p class="text-red-500">PUNTOS OBTENIDOS: <strong>' . number_format($puntaje, 1) . '</strong></p>';
?>





<main class="flex justify-center h-full items-center">
    <section class="flex flex-col gap-y-4 items-center justify-center">
        <article>
            <p>Naipe 1: <?= $carta1; ?></p>
            <p>Naipe 2: <?= $carta2; ?></p>
            <?= $resultado; ?>
        </article>
    </section>
</main>

<?php require_once('php/pie.php'); ?>