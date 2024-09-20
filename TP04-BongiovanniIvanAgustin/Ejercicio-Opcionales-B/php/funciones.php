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
