<?php

function aleatorioSinRepetir($cantidad, $desde, $hasta)
{

    $numeros = [];

    while (count($numeros) < $cantidad) {
        $numero = mt_rand($desde, $hasta);
        if (!in_array($numero, $numeros)) {
            $numeros[] = $numero;
        }
    }

    sort($numeros);

    return $numeros;
}


function contadorAciertos($numerosParticipante, $numerosSorteo)
{
    $aciertos = 0;
    foreach ($numerosParticipante as $numeroParticipante) {
        if (in_array($numeroParticipante, $numerosSorteo)) {
            $aciertos++;
        }
    }
    return $aciertos;
}
