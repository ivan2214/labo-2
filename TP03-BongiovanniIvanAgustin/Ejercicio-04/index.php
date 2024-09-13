<?php require_once('php/encabezado.php'); ?>

<?php

$juegos = [
  'Age Of Mythology Retold' => 22.99,
  'NBA 2K25' => 69.99,
  'Baldurs Gate III' => 27.99,
  'Fallout 76' => 23.99,
  'CoD Black Ops 6' => 69.99
];

// variables para el conteo de ventas, recaudación y descuento
$ventas = [];
$totalRecaudado = 0;
$descuento = 0.0;

// simulo 1000 ventas de los 5 juegos 
for ($i = 0; $i < 1000; $i++) {
  // $i representa la cantidad de ventas 
  $juegoSeleccionado = array_rand($juegos); // Seleccionar un juego al azar para la venta
  $precioOriginal = $juegos[$juegoSeleccionado]; // Obtener el precio original del juego

  // calcular el descuento basado en el número de ventas 
  if ($i < 10) {
    $descuento = 0.80; // 80% de descuento
  } elseif ($i < 200) {
    $descuento = 0.60; // 60% de descuento
  } elseif ($i < 500) {
    $descuento = 0.40; // 40% de descuento
  } elseif ($i < 1000) {
    $descuento = 0.30; // 30% de descuento
  }

  // Calcular el precio final después de aplicar el descuento
  // Paso 1: El valor de $descuento representa el porcentaje de descuento (ejemplo: 0.80 para un 80% de descuento)
  // Paso 2: Al restar $descuento de 1 (1 - $descuento), obtenemos el porcentaje que el cliente pagará del precio original.
  //         Por ejemplo, si $descuento es 0.80, entonces 1 - 0.80 = 0.20, es decir, el cliente pagará el 20% del precio original.
  // Paso 3: Multiplicamos el precio original del juego ($precioOriginal) por este valor (1 - $descuento).
  //         Esto da como resultado el precio final que el cliente pagará después de aplicar el descuento.
  $precioFinal = $precioOriginal * (1 - $descuento);


  // Actualizar la cantidad vendida y el monto recaudado
  if (!isset($ventas[$juegoSeleccionado])) {
    $ventas[$juegoSeleccionado] = ['cantidad' => 0, 'recaudado' => 0];
  }
  $ventas[$juegoSeleccionado]['cantidad']++;
  // esto es el contador del monto recaudado
  $ventas[$juegoSeleccionado]['recaudado'] += $precioFinal;
  $totalRecaudado += $precioFinal;
}
?>

<main class="flex w-full h-full bg-gray-50">
  <!-- Aside con juegos disponibles -->
  <aside class="w-1/4 h-full overflow-y-auto bg-blue-800 p-4">
    <h2 class="text-2xl font-bold text-white mb-4 text-center">Juegos Disponibles</h2>
    <ul class="flex flex-col gap-y-4">
      <?php
      foreach ($juegos as $juego => $precio) {
        $imagen = $juego . ".jpg";
        echo '<li class="flex flex-col items-center">';

        echo '<img class="w-24 h-24 object-cover rounded mb-2 border-2 border-blue-300" src="img/' . $imagen . '" alt="' . $juego . '">';
        echo '<h3 class="text-sm font-semibold text-white">' . $juego . '</h3>';
        echo '<p class="text-xs font-bold text-gray-200">$' . number_format($precio, 2) . '</p>';

        echo '</li>';
      }
      ?>
    </ul>
  </aside>

  <!-- Sección central con resultados del Hot Sale -->
  <section class="flex-1 flex flex-col items-center justify-center p-4">
    <h2 class="text-2xl font-bold mb-4 text-gray-800">Resultados del Hot Sale</h2>
    <article class="w-full max-w-4xl">
      <table class="min-w-full table-fixed border border-gray-300 bg-white shadow-md rounded">
        <thead class="bg-blue-100">
          <tr>
            <th class="border border-gray-300 p-2 text-left text-blue-800">Juego</th>
            <th class="border border-gray-300 p-2 text-left text-blue-800">Cantidad Vendida</th>
            <th class="border border-gray-300 p-2 text-left text-blue-800">Monto Recaudado</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($ventas as $juego => $info): ?>
            <tr class="hover:bg-blue-50">
              <td class="border text-black border-gray-300 p-2"><?php echo $juego; ?></td>
              <td class="border text-black border-gray-300 p-2"><?php echo $info['cantidad']; ?></td>
              <td class="border text-black border-gray-300 p-2">$<?php echo number_format($info['recaudado'], 2); ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </article>

    <!-- Monto total recaudado -->
    <section class="mt-4 p-4 bg-yellow-400 rounded shadow-md text-black text-center">
      <p class="mb-2">Monto total recaudado: $<span class="font-bold"><?php echo number_format($totalRecaudado, 2); ?></span></p>
    </section>
  </section>
</main>

<?php require_once('php/pie.php'); ?>