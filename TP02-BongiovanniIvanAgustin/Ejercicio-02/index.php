<?php require_once('php/encabezado.php'); ?>

<?php
// Definimos las constantes para las primeras letras de la patente
const INICIO_PATENTE = "AG";

// Generamos un número aleatorio entre 0 y 999
$numeroAleatorio = rand(0, 999);

// Aseguramos que el número tenga 3 dígitos (por ejemplo, 008 en vez de 8)
if ($numeroAleatorio < 10) {
  $numeroFormateado = '00' . $numeroAleatorio;
} elseif ($numeroAleatorio < 100) {
  $numeroFormateado = '0' . $numeroAleatorio;
} else {
  $numeroFormateado = $numeroAleatorio;
}

// Generamos dos caracteres aleatorios en mayúsculas
$letra1 = chr(rand(65, 90)); // 65 es 'A', 90 es 'Z'
$letra2 = chr(rand(65, 90));

// Concatenamos para formar la patente completa
$patente = INICIO_PATENTE . $numeroFormateado . $letra1 . $letra2;
?>

<main class="flex justify-center h-full items-center">
  <section class="my-5">
    <article>
      <p class="text-center">

        Patente: <?= $patente; ?>

      </p>
    </article>
  </section>
</main>

<?php require_once('php/pie.php'); ?>