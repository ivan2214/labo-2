<?php require_once('php/encabezado.php'); ?>

<?php

require_once('php/juegos.php');
// variables para el conteo de ventas, recaudacion y descuento
$ventas = [];
$totalRecaudado = 0;
$descuento = 0.0;

// simulo 1000 ventas de los 5 juegos 
for ($i = 0; $i < 1000; $i++) {
  // $i representa la cantidad de ventas 
  $juegoSeleccionado = array_rand($juegos); // seleccionar un juego al azar para la venta
  $precioOriginal = $juegos[$juegoSeleccionado]; // obtengo el precio original del juego

  // calcular el descuento basado en el numero de ventas 
  if ($i < 10) {
    $descuento = 0.80; // 80% de descuento
  } elseif ($i < 200) {
    $descuento = 0.60; // 60% de descuento
  } elseif ($i < 500) {
    $descuento = 0.40; // 40% de descuento
  } elseif ($i < 1000) {
    $descuento = 0.30; // 30% de descuento
  }

  $precioFinal = $precioOriginal * (1 - $descuento);


  //actualizar la cantidad vendida y el monto recaudado
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
          <?php
          foreach ($ventas as $juego => $info) {

            echo '<tr class="hover:bg-blue-50">';
            echo '<td class="border text-black border-gray-300 p-2">' . $juego . '</td>';
            echo '<td class="border text-black border-gray-300 p-2">' . $info['cantidad'] . '</td>';
            echo '<td class="border text-black border-gray-300 p-2">$' .  number_format($info['recaudado'], 2) . '</td>';
            echo '</tr>';
          }

          ?>
        </tbody>
      </table>
    </article>


    <section class="mt-4 p-4 bg-yellow-400 rounded shadow-md text-black text-center">
      <p class="mb-2">Monto total recaudado: $<span class="font-bold"><?php echo number_format($totalRecaudado, 2); ?></span></p>
    </section>
  </section>
</main>

<?php require_once('php/pie.php'); ?>