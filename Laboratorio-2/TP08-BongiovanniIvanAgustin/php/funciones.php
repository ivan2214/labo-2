<?php

function crearFecha($fecha)
{
    $fechaSeparada = explode("-", $fecha);
    // dejo esto para debuguear
    //print_r($fechaSeparada);
    $anio = $fechaSeparada[0];
    $mes = $fechaSeparada[1];
    $dia = $fechaSeparada[2];
    $meses = [
        "01" => "Enero",
        "02" => "Febrero",
        "03" => "Marzo",
        "04" => "Abril",
        "05" => "Mayo",
        "06" => "Junio",
        "07" => "Julio",
        "08" => "Agosto",
        "09" => "Septiembre",
        "10" => "Octubre",
        "11" => "Noviembre",
        "12" => "Diciembre",
    ];

    return $dia . " de " . $meses[$mes] . " de " . $anio;
}
