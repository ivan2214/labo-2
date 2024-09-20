<?php

const PRECIO_HORA = 4000;

function pagoDiario($horas,  $turno, $dia)
{

    $pago = PRECIO_HORA * $horas;


    if ($turno == "nocturno") {
        $pago *= 1.28; // aumento del 28%
    }

    if ($dia == "sabado") {
        $pago *= 1.12; // aumento del 12%
    } elseif ($dia == "domingo") {
        $pago *= 1.26; // aumento del 26%
    }

    return $pago;
}
