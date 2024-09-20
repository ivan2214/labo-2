<?php
function calcularIntereses($deposito, $plazo)
{
    // Intereses = depositoInicial x ((tasa/100) x cantidadDias / 365)

    $tasa = 0;

    switch ($plazo) {
        case 30:
            $tasa = 117;
            break;
        case 45:
            $tasa = 125;
            break;
        case 60:
            $tasa = 137;
            break;
        case 90:
            $tasa = 150;
            break;
        default:
            $tasa = 0;
            break;
    }

    // Calcular intereses
    $intereses = $deposito * (($tasa / 100) * $plazo / 365);

    return $intereses;
}
