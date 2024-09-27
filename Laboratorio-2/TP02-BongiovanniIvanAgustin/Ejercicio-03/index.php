<?php require_once('php/encabezado.php'); ?>

<?php

$categoria = chr(mt_rand(65, 71)); // 65 es 'A', 71 es 'G'

switch ($categoria) {
    case 'A':
        $descripcion = "Ciclomotores, motocicletas y triciclo motorizados.";
        break;
    case 'B':
        $descripcion = "Automóviles y camionetas con acoplado de hasta 720kg de peso o casa rodante, y las comprendidas en la clase A.";
        break;
    case 'C':
        $descripcion = "Camiones sin acoplados y los comprendidos en la clase B.";
        break;
    case 'D':
        $descripcion = "Los destinados al servicio de transporte de pasajeros, emergencias o seguridad y los comprendidos en las clases B o C, según el caso.";
        break;
    case 'E':
        $descripcion = "Camiones articulados o con acoplado, maquinaria especial no agrícola y los comprendidos en las clases B o C.";
        break;
    case 'F':
        $descripcion = "Automotores especialmente adaptados para discapacitados, Comprende los automotores incluidos en las clases B y profesionales, según el caso, con la descripción de la adaptación que corresponda a la discapacidad de su titular.";
        break;
    case 'G':
        $descripcion = "Tractores y maquinarias agrícolas.";
        break;
    default:
        $descripcion = "Categoría no válida.";
        break;
}
?>

<main class="flex justify-center h-full items-center">
    <section class="flex flex-col gap-y-4 items-center justify-center max-w-2xl">
        <article class="flex flex-col items-start">
            <h2 class="text-2xl font-bold">Categoria <?= $categoria; ?></h2>
            <p class="text-base font-extralight"><?= $descripcion; ?></p>
        </article>
    </section>
</main>

<?php require_once('php/pie.php'); ?>