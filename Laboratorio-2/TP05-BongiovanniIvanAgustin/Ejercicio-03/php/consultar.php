<?php

require_once("encabezado.php");
require_once("funciones.php");

$nombreFormulario = "";


if (!empty($_POST["nombre"])) {
    $nombreFormulario = $_POST["nombre"];
    $pagos = buscarPagos($nombreFormulario);
    // lo dejo para que el que corrija pueda ver como se retorna el arreglo asociativo con los valores por dia y el total
    var_dump($pagos);
}

?>


<main class="flex justify-center items-center">
    <section class="w-full max-w-lg p-4">

        <article class="text-lg flex flex-wrap gap-2">
            <h2 class="font-bold text-xl text-gray-300">Pagos de
                <span class="text-yellow-500 text-lg">
                    <?= $nombreFormulario ?>
                </span>
                en la enfermeria
            </h2>
        </article>

        <!-- Tabla de pagos -->
        <section aria-labelledby="honorarios-header">
            <table class="min-w-full border-collapse border border-gray-300 text-left">
                <thead class="bg-black text-white">
                    <tr>
                        <th scope="col" class="border border-gray-300 px-4 py-2">Día</th>
                        <th scope="col" class="border border-gray-300 px-4 py-2">Honorario</th>
                    </tr>
                </thead>
                <tbody class="bg-white">

                    <?php

                    if (!empty($pagos)) {
                        foreach ($pagos as $clave => $valor) {

                            if ($clave != "total") {
                                echo '<tr>';


                                echo '<td class="border border-gray-300 px-4 py-2">' . $clave . '</td>';

                                echo '<td class="border border-gray-300 px-4 py-2">$' . number_format($valor, 2, ",", ".") . '</td>';

                                echo '</tr>';
                            }
                        }
                    }

                    ?>

                </tbody>
                <tfoot class="bg-white">
                    <tr>

                        <td class="border border-gray-300 px-4 py-2">Total</td>
                        <?php

                        if (!empty($pagos)) {
                            echo '<td class="border border-gray-300 px-4 py-2">$' . number_format($pagos["total"], 2, ",", ".") . '</td>';
                        } else {
                            echo '<td class="border border-gray-300 px-4 py-2">$0</td>';
                        }
                        ?>
                    </tr>
                </tfoot>
            </table>
        </section>

    </section>
</main>

<?php
require_once("pie.php");
?>