<?php

function buscarPagos($nombre)
{
    $ubicacionCarpeta = "../../Ejercicio-02/txt/"; // busco el txt del punto anterior para no estar copiando y pegando la carpeta del archivo
    $nombreArchivo = "pagos.txt";
    $archivo = fopen($ubicacionCarpeta . $nombreArchivo, "r");
    $pagos = [];

    while (!feof($archivo)) {
        $linea = fgets($archivo);
        if ($linea != "") {
            $datos = explode(";", trim($linea));
            //nombre;horaTrabajada;turno;dia;honorario
            // obtengo el nombre que esta en el archivo guardado
            $nombreArchivo = $datos[0];
            // si el nombre del archivo y el el nombre que me pasan por parametro coinciden se hace el trabajo sino no
            if ($nombre == $nombreArchivo) {
                $dias = explode(",", trim($datos[3]));
                $honorarios = $datos[4];
                foreach ($dias as $dia) {
                    if (array_key_exists($dia, $pagos)) {
                        $pagos[$dia] += $honorarios;
                    } else {
                        $pagos[$dia] = $honorarios;
                    }
                }
            }
        }
    }
    fclose($archivo);

    foreach ($pagos as $clave => $valor) {
        // verifico que si no existe la clave en el arreglo pagos entonces la inicializo en cero
        if (!array_key_exists("total", $pagos)) {
            $pagos["total"] = 0;
        }
        // si clave es distinta a total entonces se suma al total ya que las demas son dias 
        if ($clave != "total") {
            $pagos["total"] += $valor;
        }
    }

    return $pagos;
}
