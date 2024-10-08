<?php require_once('php/encabezado.php'); ?>

<?php

$miCarton = [3, 5, 7, 10, 12, 14, 15, 18, 20, 22];

// numeros posibles del sorteo sin repetir
$numerosSorteados = [];

// generar 10 numeros aleatorios del 1 al 22 sin repetir
$numerosGenerados = 0; 

while ($numerosGenerados < 10) {
  $numeroAleatorio = mt_rand(1, 22);
  if (!in_array($numeroAleatorio, $numerosSorteados)) {
    $numerosSorteados[] = $numeroAleatorio;
    $numerosGenerados++; // incrementar la cuenta de numeros generados si es que no se repite
  }
}



// esto es para ver cuantos aciertos hay, osea un contador 
$aciertos = 0;

foreach ($numerosSorteados as $numero) {
  if (in_array($numero, $miCarton)) {
    $aciertos++;
  }
}

?>

<main class="flex justify-between items-center h-full p-10">
  
  <section class="w-full max-w-md grid place-items-center p-4 bg-orange-500 rounded-lg shadow-md">
    <h2 class="text-xl font-bold text-center mb-4">Mi Carton</h2>
    <ul class="grid grid-cols-2 border-2 border-gray-400 rounded-lg overflow-hidden">
      <?php
      
      for ($i = 0; $i < 10; $i++) {
        echo '<li class="flex justify-center items-center bg-gray-200 border-2 border-gray-400  h-16 w-16">';
        echo "<span class='font-semibold text-black text-lg'>{$miCarton[$i]}</span>"; 
        echo '</li>';
      }
      ?>
    </ul>
  </section>


  
  <section class="w-full max-w-md grid place-items-center p-4 bg-orange-500 rounded-lg shadow-md">
    <h2 class="text-xl font-bold text-center mb-4">Sorteo</h2>

    <ul class="grid grid-cols-5 grid-rows-2 border-2 border-gray-400 rounded-lg overflow-hidden">
      <?php
      
      sort($numerosSorteados);
      foreach ($numerosSorteados as $numero) {
        echo "<li class='flex justify-center items-center bg-green-500 border-2 border-gray-400  h-16 w-16'>";
        echo "<span class='font-semibold text-black'>$numero</span>";
        echo '</li>';
      }
      ?>
    </ul>
    <p class="text-center text-gray-800 text-lg mt-4">Cantidad de Aciertos: <span class="font-bold text-lg text-green-600"><?php echo $aciertos; ?></span></p>

    <?php
    if ($aciertos === 10) {
      echo '<p class="mt-4 text-center text-xl font-bold bg-green-400 p-2 rounded text-gray-600">¡Ganaste el pozo de $35.000.000!</p>';
    } else {
      echo '<p class="mt-4 text-center text-xl font-bold bg-red-400 p-2 rounded text-gray-600">Seguí participando</p>';
    }
    ?>
  </section>
</main>

<?php require_once('php/pie.php'); ?>