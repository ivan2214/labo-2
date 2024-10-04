<?php
require_once('encabezado.php');
require_once('funciones.php'); // Incluir el archivo de funciones

$nombre = "";
$pagos = []; // Inicializar el arreglo de pagos

if (!empty($_POST["nombre"])) {
    $nombre = $_POST["nombre"];
    $pagos = obtenerPagos($nombre); // Obtener los pagos de la función
}
?>

<main class="flex justify-center items-center">
    <section class="w-full max-w-lg p-4">
        <!-- Sección de nombre -->
        <article class="text-lg flex flex-wrap gap-2">
            <h2 class="font-bold text-xl text-gray-300">Nombre</h2>
            <?php
            echo '<p aria-label="nombre" class="text-yellow-400">' . ($nombre ?: "Seleccione un nombre") . '</p>';
            ?>
        </article>

        <!-- Tabla de Honorarios -->
        <section aria-labelledby="honorarios-header">
            <table class="min-w-full border-collapse border border-gray-300 text-left">
                <thead class="bg-black text-white">
                    <tr>
                        <th scope="col" class="border border-gray-300 px-4 py-2">Nombre</th>
                        <th scope="col" class="border border-gray-300 px-4 py-2">Día</th>
                        <th scope="col" class="border border-gray-300 px-4 py-2">Horas Trabajadas</th>
                        <th scope="col" class="border border-gray-300 px-4 py-2">Honorario</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    <?php
                    foreach ($pagos as $dia => $datos) {
                        echo '<tr>';
                        echo '<td class="border border-gray-300 px-4 py-2">' . $nombre . '</td>';
                        echo '<td class="border border-gray-300 px-4 py-2">' . $dia . '</td>';
                        echo '<td class="border border-gray-300 px-4 py-2">' . $datos['horas'] . '</td>';
                        echo '<td class="border border-gray-300 px-4 py-2">$' . number_format($datos['honorario'], 2, ",", ".") . '</td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
                <tfoot class="bg-white">
                    <tr>
                        <td colspan="3" class="border border-gray-300 px-4 py-2">Total</td>
                        <td class="border border-gray-300 px-4 py-2">
                            <?php
                            $totalHonorario = 0;


                            foreach ($pagos as $datos) {
                                $totalHonorario += $datos['honorario'];
                            }

                            echo '$' . number_format($totalHonorario, 2, ",", ".");
                            ?>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </section>
    </section>
</main>