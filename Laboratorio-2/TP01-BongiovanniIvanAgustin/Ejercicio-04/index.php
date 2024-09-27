<?php
// Importo el encabezado 
require_once 'php/encabezado.php';


// constante para calcular el 13% de aportes jubilatorios
const APORTE_JUBILATORIO = 13;
// constante para la obra social
const OBRA_SOCIAL = 3.5;

// nombre del empleado
$nombre = "Juan Pablo Pepe";

// sueldo basico random entre 600 mil y 790 mil
$sueldoBasico = rand(600000, 790000);

// calculo de aporte jubilatorio y obra social ambosporcentajes que se calculan sobre el sueldo basico

$aporteJubilatorio = ($sueldoBasico * APORTE_JUBILATORIO) / 100;
$aporteObraSocial = ($sueldoBasico * OBRA_SOCIAL) / 100;

// Sueldo neto 
$sueldoNeto = $sueldoBasico - ($aporteJubilatorio + $aporteObraSocial);

?>


<main>
  <article>
    <table>
      <caption><?= $nombre; ?></caption>
      <thead>
        <tr>
          <th>Concepto</th>
          <th>Remuneración</th>
          <th>Descuento</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Sueldo básico</td>
          <td>$<?= number_format($sueldoBasico, 2, ",", "."); ?></td>
        </tr>
        <tr>
          <td>Aporte jubilatorio</td>
          <td></td>
          <td>$<?= number_format($aporteJubilatorio, 2, ",", "."); ?></td>
        </tr>
        <tr>
          <td>Aporte obra social</td>
          <td></td>
          <td>$<?= number_format($aporteObraSocial, 2, ",", "."); ?></td>
        </tr>
        <tr>
          <th>Sueldo neto</th>
          <td>$<?= number_format($sueldoNeto, 2, ",", "."); ?></td>
        </tr>
      </tbody>
    </table>
  </article>
</main>


<?php
require "php/pie.php";
?>