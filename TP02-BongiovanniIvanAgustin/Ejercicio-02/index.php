<?php require_once('php/encabezado.php'); ?>

<?php

const INICIO_PATENTE = "AG";

// Generamos un número aleatorio entre 0 y 999
$numeroAleatorio = mt_rand(0, 999);

// formateo el numero si es meenor de 3 digitos
if ($numeroAleatorio < 10) {
  $numeroFormateado = '00' . $numeroAleatorio;
} elseif ($numeroAleatorio < 100) {
  $numeroFormateado = '0' . $numeroAleatorio;
} else {
  $numeroFormateado = $numeroAleatorio;
}

$letra1 = chr(mt_rand(65, 90)); // 65 es 'A', 90 es 'Z'
$letra2 = chr(mt_rand(65, 90));


$patente = INICIO_PATENTE . $numeroFormateado . $letra1 . $letra2;
?>

<main class="flex justify-center h-full items-center">
  <section class="my-5">
    <article>
      <p class="text-center text-2xl">

        Patente:
        <span class="font-bold"><?= $patente; ?></span>

      </p>
    </article>
  </section>
</main>

<?php require_once('php/pie.php'); ?>