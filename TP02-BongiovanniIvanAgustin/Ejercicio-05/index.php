<?php require_once('php/encabezado.php'); ?>

<?php

$naipe1 = rand(1, 12);
$naipe2 = rand(1, 12);

/* 
naipes ganadorees pruebas sumados dan 9.5
$naipe1 = 9;
$naipe2 = 10; 
*/

// Determinar el valor de cada naipe
if ($naipe1 == 10 || $naipe1 == 11 || $naipe1 == 12) {
    $valorNaipe1 = 0.5;
} else {
    $valorNaipe1 = $naipe1;
}

if ($naipe2 == 10 || $naipe2 == 11 || $naipe2 == 12) {
    $valorNaipe2 = 0.5;
} else {
    $valorNaipe2 = $naipe2;
}

$puntaje = $valorNaipe1 + $valorNaipe2;

// Obtener el nombre de cada carta
if ($naipe1 == 10) {
    $carta1 = "Sota";
} elseif ($naipe1 == 11) {
    $carta1 = "Caballo";
} elseif ($naipe1 == 12) {
    $carta1 = "Rey";
} else {
    $carta1 = $naipe1;
}

if ($naipe2 == 10) {
    $carta2 = "Sota";
} elseif ($naipe2 == 11) {
    $carta2 = "Caballo";
} elseif ($naipe2 == 12) {
    $carta2 = "Rey";
} else {
    $carta2 = $naipe2;
}


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