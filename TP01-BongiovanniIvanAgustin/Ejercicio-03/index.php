<?php
// Importo el encabezado 
require_once 'php/encabezado.php';

// constante ALICUOTA con el valor 2.5 (que servirá para calcular el
// 2.5% de retención, alícuota del rubro informático).
const ALICUOTA = 2.5;

// Transferencias entrantes aleatorias
$trans1 = mt_rand(220000, 350000);
$trans2 = mt_rand(220000, 350000);

// calculo de retencion de ingresos brutos aplicado en las 2 transferencias
$bruto1 = $trans1 * ALICUOTA / 100;
$bruto2 = $trans2 * ALICUOTA / 100;

// variables salientes con valores aleatorios entre 80.000 y 130.000
$salida1 = mt_rand(80000, 130000);
$salida2 = mt_rand(80000, 130000);

$saldo = ($trans1 + $trans2) - ($bruto1 + $bruto2) - ($salida1 + $salida2);


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
          <td>+
            <?php echo " $" . number_format($trans1, 2, ",", ".");
            ?>
          </td>
        </tr>
        <tr>
          <td>Retención IIBB</td>
          <td>-
            <?php
            echo " $" . number_format($bruto1, 2, ",", ".");
            ?></td>
        </tr>
        <tr>
          <td>Transferencia entrante</td>
          <td>+
            <?php
            echo " $" . number_format($trans2, 2, ",", ".");
            ?>
          </td>
        </tr>
        <tr>
          <td>Retención IIBB</td>
          <td>-
            <?php
            echo " $" . number_format($bruto2, 2, ",", ".");
            ?></td>
        </tr>
        <tr>
          <td>Transferencia saliente</td>
          <td>-
            <?php
            echo " $" . number_format($salida1, 2, ",", ".");
            ?></td>
        </tr>
        <tr>
          <td>Transferencia saliente</td>
          <td>-
            <?php
            echo " $" . number_format($salida2, 2, ",", ".");
            ?></td>
        </tr>
        <tr>
          <td>Saldo</td>
          <td>+
            <?php
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