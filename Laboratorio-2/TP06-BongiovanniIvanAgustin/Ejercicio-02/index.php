<?php

require_once 'php/conexion.php';

$conexion = conectar();

if ($conexion) {
    echo '<p>Conexion exitosa</p>';
} else {
    desconectar($conexion);
}
