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


function mostrarArticulosCookie($preferencias){
    $conexion=conectar();

    if(!empty($preferencias)){
        $prefe=explode("-",$preferencias);
		$consulta= "SELECT * FROM articulo WHERE categoria = ? ";
		$sentencia=mysqli_prepare($conexion,$consulta);
		mysqli_stmt_bind_param($sentencia,"s",$prefe[0]);
    }else{
		$consulta= "SELECT * FROM articulo";
		$sentencia=mysqli_prepare($conexion,$consulta);
	}

}


function eliminarCookie($usuario){
    unset($_COOKIE[$usuario]);
    setcookie($usuario,"",time()-3600,"/");
    header("refresh:0;url=listado.php");
}

