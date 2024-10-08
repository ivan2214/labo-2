<?php require_once('php/encabezado.php'); ?>

<?php



$matriz = [];  // matriz vacia
$bombas = 0;   // contador de bombas

// inicializar la matriz 10x10 con '-'
for ($i = 0; $i < 10; $i++) {
  $matriz[$i] = [];
  for ($j = 0; $j < 10; $j++) {
    $matriz[$i][$j] = "-";  // cada posicion vacia es '-'
  }
}


while ($bombas < 10) {
  $fila = rand(0, 9);    // genera un numero aleatorio para la fila (indice)
  $columna = rand(0, 9); // genera un numero aleatorio para la columna (indice)

  if ($matriz[$fila][$columna] === '-') {
    $matriz[$fila][$columna] = 'B';  // pongo la bomba en la posicionn de la matriz si esta vacia
    $bombas++;  // actualizoc las bombas
  }
}

// variables para el juego
$puntos = 0;
$encontrada = false;
$fila_bomba = 0;
$columna_bomba = 0;

// simular el juego hasta que se encuentre una bomba
do {
  $fila = rand(0, 9); // genera un numero aleatorio para la fila (indice)
  $columna = rand(0, 9); // genera un numero aleatorio para la columna (indice)

  if ($matriz[$fila][$columna] === '-') {
    $puntos++;  // sumo puntos por cada vez que no se encuentre una bomba
  } else {
    $encontrada = true;  // aqui se encuentra una bomba entonces pierdo y guardo el lugar donde se eencontro 
    $fila_bomba = $fila;
    $columna_bomba = $columna;
  }
} while (!$encontrada);

?>

<main class="flex justify-center h-full items-center">
  <section class="my-5">
    <article class="flex items-start justify-center gap-x-2">

      <section class="flex mt-14 flex-col gap-y-4">
        <?php
        for ($i = 0; $i < 10; $i++) {

          echo '<span class="p-0 m-0 border border-slate-700">Fila ' . ($i + 1) . '</span>';
        }
        ?>
      </section>

      <table class="table border-separate hober:border-collapse border-spacing-2 transition-all duration-500  border border-slate-500 text-center">
        <caption class="caption-top">Busca Minas</caption>
        <thead>
          <tr>
            <?php for ($header = 0; $header < 10; $header++): ?>
              <th class="p-0 m-0 text-xs">Col <?php echo $header + 1; ?></th>
            <?php endfor; ?>
          </tr>
        </thead>
        <tbody>

          <?php
          for ($i = 0; $i < 10; $i++) {
            echo '<tr>';

            for ($j = 0; $j < 10; $j++) {
              if ($matriz[$i][$j] === '-') {
                echo '<td class="p-0 m-0 border border-slate-700"><img src="img/vacio.jpg" alt="Espacio vacío" class="w-8 h-8"></td>';
              } else {
                // Condicional para mostrar con rojo la coordenada de la bomba encontrada
                if ($i === $fila_bomba && $j === $columna_bomba) {
                  echo '<td class="p-0 m-0 border border-slate-700"><img src="img/mina.jpg" alt="Bomba encontrada" class="w-8 h-8 bg-red-500 rounded p-0.5"></td>';
                } else {
                  echo '<td class="p-0 m-0 border border-slate-700"><img src="img/mina.jpg" alt="Bomba" class="w-8 h-8"></td>';
                }
              }
            }
            echo '</tr>';
          }
          ?>
        </tbody>
        <tfoot>
          <tr>
            <th colspan="10" class="text-center p-3 bg-zinc-600 rounded shadow text-gray-300">
              <h2 class="font-bold">Puntos: <?php echo $puntos; ?></h2>
              <p>¡Perdiste! Bomba encontrada en la fila <?php echo $fila_bomba + 1; ?> y col <?php echo $columna_bomba + 1; ?></p>
            </th>
          </tr>
        </tfoot>
      </table>

    </article>

  </section>
</main>

<?php require_once('php/pie.php'); ?>