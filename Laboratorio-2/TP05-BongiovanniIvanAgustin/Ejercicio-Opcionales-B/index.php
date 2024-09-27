<?php require_once('php/encabezado.php'); ?>

<?php require_once('php/funciones.php'); ?>

<?php

$numerosParticipante1 = aleatorioSinRepetir(6, 1, 45);
$numerosParticipante2 = aleatorioSinRepetir(6, 1, 45);
$numerosParticipante3 = aleatorioSinRepetir(6, 1, 45);
$numerosParticipante4 = aleatorioSinRepetir(6, 1, 45);

$numerosSorteo = aleatorioSinRepetir(6, 1, 45);

$aciertosParticipante1 = contadorAciertos($numerosParticipante1, $numerosSorteo);
$aciertosParticipante2 = contadorAciertos($numerosParticipante2, $numerosSorteo);
$aciertosParticipante3 = contadorAciertos($numerosParticipante3, $numerosSorteo);
$aciertosParticipante4 = contadorAciertos($numerosParticipante4, $numerosSorteo);



?>



<main class="flex justify-center h-full w-full items-center">
  <section class="flex flex-col gap-4 bg-white w-1/2 p-10 rounded">
    <section class="flex items-center gap-x-4 w-full justify-between">

      <article class="flex flex-col items-center gap-y-3">
        <figure class="w-full mx-auto">
          <img class="w-10 h-10 mx-auto rounded-full aspect-square object-cover" src="img/usuario.png" alt="imagen">
        </figure>
        <section class="flex items-center flex-col gap-y-2">
          <h2 class="text-sm font-medium">Participante 1</h2>
          <section class="text-blue-400 text-sm font-bold">
            <?php
            foreach ($numerosParticipante1 as $numero) {
              echo '</span>' . $numero . ' </span>';
            }
            ?>
          </section>
        </section>
      </article>
      <article class="flex flex-col items-center gap-y-3">
        <figure class="w-full mx-auto">
          <img class="w-10 h-10 mx-auto rounded-full aspect-square object-cover" src="img/usuario.png" alt="imagen">
        </figure>
        <section class="flex items-center flex-col gap-y-2">
          <h2 class="text-sm font-medium">Participante 2</h2>
          <section class="text-blue-400 text-sm font-bold">
            <?php
            foreach ($numerosParticipante2 as $numero) {
              echo '</span>' . $numero . ' </span>';
            }
            ?>
          </section>
        </section>
      </article>
      <article class="flex flex-col items-center gap-y-3">
        <figure class="w-full mx-auto">
          <img class="w-10 h-10 mx-auto rounded-full aspect-square object-cover" src="img/usuario.png" alt="imagen">
        </figure>
        <section class="flex items-center flex-col gap-y-2">
          <h2 class="text-sm font-medium">Participante 3</h2>
          <section class="text-blue-400 text-sm font-bold">
            <?php
            foreach ($numerosParticipante3 as $numero) {
              echo '</span>' . $numero . ' </span>';
            }
            ?>
          </section>
        </section>
      </article>
      <article class="flex flex-col items-center gap-y-3">
        <figure class="w-full mx-auto">
          <img class="w-10 h-10 mx-auto rounded-full aspect-square object-cover" src="img/usuario.png" alt="imagen">
        </figure>
        <section class="flex items-center flex-col gap-y-2">
          <h2 class="text-sm font-medium">Participante 4</h2>
          <section class="text-blue-400 text-sm font-bold">
            <?php
            foreach ($numerosParticipante4 as $numero) {
              echo '</span>' . $numero . ' </span>';
            }
            ?>
          </section>
        </section>
      </article>

    </section>
    <section class="flex items-center justify-center">

      <section class="text-center mx-auto text-2xl font-bold">
        <?php
        foreach ($numerosSorteo as $numero) {
          echo '</span>' . $numero . ' </span>';
        }
        ?>

      </section>

    </section>
    <section class="flex flex-col items-start gap-y-3">

      <section>
        <h3 class="text-lg font-bold">Participante 1:</h3>
        <span class="text-yellow-600"><?= $aciertosParticipante1 ?> Aciertos</span>
      </section>
      <section>
        <h3 class="text-lg font-bold">Participante 2:</h3>
        <span class="text-yellow-600"><?= $aciertosParticipante2 ?> Aciertos</span>
      </section>
      <section>
        <h3 class="text-lg font-bold">Participante 3:</h3>
        <span class="text-yellow-600"><?= $aciertosParticipante3 ?> Aciertos</span>
      </section>
      <section>
        <h3 class="text-lg font-bold">Participante 4:</h3>
        <span class="text-yellow-600"><?= $aciertosParticipante4 ?> Aciertos</span>
      </section>

    </section>
  </section>
</main>

<?php require_once('php/pie.php'); ?>