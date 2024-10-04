<?php
function obtenerPagos($nombre)
{
    $ubicacion = "../txt/";
    $archivoNombre = "pagos.txt";
    $ubicacionArchivo = $ubicacion . $archivoNombre;

    // Inicializar el arreglo asociativo
    $pagos = [];

    // Verificar si el archivo existe
    if (file_exists($ubicacionArchivo)) {
        $archivo = fopen($ubicacionArchivo, "r");

        while (!feof($archivo)) {
            $linea = fgets($archivo);
            $partes = explode(";", trim($linea)); // Trimming para eliminar espacios

            // Verificar que haya suficientes partes y si el nombre coincide
            if (count($partes) >= 5 && $partes[0] == $nombre) {
                $horas = intval($partes[1]); // Horas en la segunda posición
                $dia = $partes[3]; // Día en la cuarta posición
                $honorario = floatval($partes[4]); // Honorario en la quinta posición

                // Si el día ya existe, acumular horas y honorarios
                if (isset($pagos[$dia])) {
                    $pagos[$dia]['horas'] += $horas;
                    $pagos[$dia]['honorario'] += $honorario; // Acumular honorarios si el día ya existe
                } else {
                    // Asignar valores iniciales
                    $pagos[$dia] = [
                        'horas' => $horas,
                        'honorario' => $honorario
                    ];
                }
            }
        }

        fclose($archivo);
    } else {
        echo "El archivo no existe.";
    }

    return $pagos;
}
