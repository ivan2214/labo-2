<?php
// Importo el encabezado 
require_once 'php/encabezado.php';

// Declaro el factor de conversión de GB a MB
const FACTOR = 1000;

// Declaro la capacidad del pendrive y muestro su valor
$penDrive = 16;

echo "<h1>Pen Drive de $penDrive GB</h1>";

// Generacion de 3 archivos aleatorios de 2500MB a 4000MB y muestro los valores en MB
$file1InMB = mt_rand(2500, 4000);
$file2InMB = mt_rand(2500, 4000);
$file3InMB = mt_rand(2500, 4000);

echo "<p>Archivo 1 (MB): $file1InMB</p>\n";
echo "<p>Archivo 2 (MB): $file2InMB</p>\n";
echo "<p>Archivo 3 (MB): $file3InMB</p>\n";

// agrego un separador

echo "<hr>\n";

// Muestro los archivos en GB
$file1InGb = number_format($file1InMB / FACTOR, 2, ",", ".");
$file2InGb = number_format($file2InMB / FACTOR, 2, ",", ".");
$file3InGb = number_format($file3InMB / FACTOR, 2, ",", ".");

echo "<p>Archivo 1 (GB): $file1InGb</p>\n";
echo "<p>Archivo 2 (GB): $file2InGb</p>\n";
echo "<p>Archivo 3 (GB): $file3InGb</p>\n";

// agrego un separador

echo "<hr>\n";

// Calculo de la capacidad del pendrive y la muestro en GB
$penDrive -= ($file1InMB + $file2InMB + $file3InMB) / FACTOR;

echo "Espacio libre: $penDrive GB";


// Importo el pie
require_once 'php/pie.php';
