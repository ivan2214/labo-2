<?php require_once('php/encabezado.php'); ?>

<?php require_once('php/funciones.php'); ?>



<?php

$comision1 = [2, 3, 5, 9, 4, 7, 3, 5, 10, 3, 6, 8];
$comision2 = [4, 3, 1, 10, 4, 7, 4, 5, 10, 5, 10, 1, 6, 6, 8];
$comision3 = [5, 7, 9, 3, 8, 5, 2, 7, 10, 1];

?>



<main class="flex justify-center h-full items-center">
  <section class="my-5">
    <article class="flex flex-col items-center gap-5">
      <section>
        <h2>Estadisticas Comision 1</h2>
        <?php verEstadisticas($comision1); ?>
      </section>

      <section>
        <h2>Estadisticas Comision 2</h2>
        <?php verEstadisticas($comision2); ?>
      </section>

      <section>
        <h2>Estadisticas Comision 3</h2>
        <?php verEstadisticas($comision3); ?>
      </section>
    </article>
  </section>
</main>
<?php require_once('php/pie.php'); ?>