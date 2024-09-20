<?php


function calculoPromedio($notas)
{
    $totalNotas = 0;

    foreach ($notas as $nota) {
        $totalNotas += $nota;
    }

    $cantidadNotas = count($notas);

    return $cantidadNotas > 0 ? $totalNotas / $cantidadNotas : 0;
}


function cantidadAprobados($notas)
{
    $aprobados = 0;
    foreach ($notas as $nota) {
        if ($nota >= 4) {
            $aprobados++;
        }
    }
    return $aprobados;
}


function cantidadDesaprobados($notas)
{
    $desaprobados = 0;
    foreach ($notas as $nota) {
        if ($nota < 4) {
            $desaprobados++;
        }
    }
    return $desaprobados;
}


function verEstadisticas($notas)
{
    $promedio = calculoPromedio($notas);
    $aprobados = cantidadAprobados($notas);
    $desaprobados = cantidadDesaprobados($notas);

    echo "<p>Promedio: <strong class='text-yellow-500'>" . number_format($promedio, 2) . "</strong></p>";
    echo "<p>Aprobados: <strong class='text-yellow-500'>" . $aprobados . "</strong></p>";
    echo "<p>Desaprobados: <strong class='text-yellow-500'>" . $desaprobados . "</strong></p>";
}
