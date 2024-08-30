<?php
// Importo el encabezado 
require_once 'php/encabezado.php';

// constante ALICUOTA con el valor 2.5 (que servirá para calcular el
// 2.5% de retención, alícuota del rubro informático).
const ALICUOTA = 2.5;

// Transferencias entrantes aleatorias
$incoming1 = mt_rand(220000, 350000);
$incoming2 = mt_rand(220000, 350000);

// calculo de retencion de ingresos brutos aplicado en las 2 transferencias
$bruto1 = $incoming1 * ALICUOTA / 100;
$bruto2 = $incoming2 * ALICUOTA / 100;

// variables salientes con valores aleatorios entre 80.000 y 130.000
$sale1 = mt_rand(80000, 130000);
$sale2 = mt_rand(80000, 130000);

/* Realice los cálculos necesarios (sumas y restas) para obtener el saldo final de la
cuenta */

$saldo = $sale1 - $bruto1 + $sale2 - $bruto2;


?>


<main>
  <article>
    <table>
      <caption>Estado de cuenta</caption>
      <thead>
        <tr>
          <th>Concepto</th>
          <th>Monto</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Transferencia entrante</td>
          <td><?php

              if ($incoming1 > 0) {
                echo "+";
              } else {
                echo "-";
              }
              echo " $" . number_format($incoming1, 2, ",", ".");
              ?>
          </td>
        </tr>
        <tr>
          <td>Retención IIBB</td>
          <td>- $<?php
                  echo number_format($bruto1, 2, ",", ".");
                  ?></td>
        </tr>
        <tr>
          <td>Transferencia entrante</td>
          <td><?php

              if ($incoming2 > 0) {
                echo "+";
              } else {
                echo "-";
              }
              echo " $" . number_format($incoming2, 2, ",", ".");
              ?>
          </td>
        </tr>
        <tr>
          <td>Retención IIBB</td>
          <td>- $<?php
                  echo number_format($bruto2, 2, ",", ".");
                  ?></td>
        </tr>
        <tr>
          <td>Transferencia saliente</td>
          <td>- $<?php
                  $sale1 = mt_rand(80000, 130000);
                  echo number_format($sale1, 2, ",", ".");
                  ?></td>
        </tr>
        <tr>
          <td>Transferencia saliente</td>
          <td>- $<?php

                  echo number_format($sale2, 2, ",", ".");
                  ?></td>
        </tr>
        <tr>
          <td>Saldo</td>
          <td><?php

              if ($saldo > 0) {
                echo "+";
              } else {
                echo "-";
              }
              echo " $" . number_format($saldo, 2, ",", ".");
              ?>
          </td>
        </tr>
      </tbody>
    </table>
  </article>
</main>


<?php
require "php/pie.php";
?>