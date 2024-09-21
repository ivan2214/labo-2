<?php
function invertirNumero($numero)
{
    $numeroInvertido = 0;

    while ($numero > 0) {

        // puso 123
        $ultimoDigito = $numero % 10; // ultimo digito queda 3, 2


        $numeroInvertido = $numeroInvertido * 10 + $ultimoDigito; // 0=0*10+3 =3, 3=3*10+2=32

        $numero = (int)($numero / 10); // elimina el ultimo digito el numero original quedaria como 12 y vuelve 
    }
    return $numeroInvertido;
}

function contarImpares($numero)
{
    $cantImpares = 0;

    while ($numero > 0) {

        // puso 123
        $ultimoDigito = $numero % 10; // ultimo digito queda 3, 2


        if ($ultimoDigito % 2 != 0) {
            $cantImpares++;
        }

        $numero = (int)($numero / 10);
    }
    return $cantImpares;
}

function contarPrimos($numero)
{
    $cantPrimos = 0;

    while ($numero > 0) {

        // puso 123
        $ultimoDigito = $numero % 10; // ultimo digito queda 3, 2


        if (esPrimo($ultimoDigito)) {
            $cantPrimos++;
        }

        $numero = (int)($numero / 10);
    }
    return $cantPrimos;
}

function esPrimo($numero)
{
    $contadores = 0;
    for ($i = 1; $i <= $numero; $i++) {
        if ($numero % $i == 0) {
            $contadores++;
        }
    }
    return $contadores == 2 ? true : false; 
}
