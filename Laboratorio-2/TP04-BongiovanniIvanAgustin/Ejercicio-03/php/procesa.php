<?php

require_once("encabezado.php");

require_once("funciones.php");


$horasTrabajadas = "";
$turno = "";
$dias = [];

if (!empty($_POST["horas-trabajadas"]) && !empty($_POST["turno"]) && !empty($_POST["dias"])) {

    $horasTrabajadas = $_POST["horas-trabajadas"];
    $turno = $_POST["turno"];
    $dias = $_POST["dias"];
}
?>

<main class="flex justify-center h-full items-center">
    <section class="w-full max-w-lg p-4 space-y-6">
        <!-- Sección de Horas Trabajadas y Turno -->
        <article class="text-lg flex flex-col gap-y-2">
            <header class="font-bold text-xl text-gray-300">Horas trabajadas</header>

            <?php
            if ($horasTrabajadas > 0) {
                echo '<p aria-label="Horas trabajadas" class="text-yellow-400">' . $horasTrabajadas . ' horas</p>';
            } else {
                echo '<p aria-label="Horas trabajadas" class="text-yellow-400">Introduce las horas</p>';
            }
            ?>

            <header class="font-bold text-xl text-gray-300">Turno</header>

            <?php
            if (!empty($turno)) {
                echo '<p aria-label="Turno" class="text-yellow-400">' . $turno . '</p>';
            } else {
                echo '<p aria-label="Turno" class="text-yellow-400">Seleccione un turno</p>';
            }
            ?>

        </article>

        <!-- Tabla de Honorarios -->
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

                    if (!empty($horasTrabajadas) && !empty($turno) && !empty($dias)) {
                        foreach ($dias as $dia) {
                            $honorario = pagoDiario($horasTrabajadas, $turno, $dia);
                            $honorarioString = (string) $honorario;
                            echo '<tr>';

                            echo '<td class="border border-gray-300 px-4 py-2">' . $dia . '</td>';

                            echo '<td class="border border-gray-300 px-4 py-2">$' . number_format($honorarioString, 2, ",", ".") . '</td>';

                            echo '</tr>';
                        }
                    }

                    ?>

                </tbody>
                <tfoot class="bg-white">
                    <tr>

                        <td class="border border-gray-300 px-4 py-2">Total</td>
                        <?php

                        if (!empty($horasTrabajadas) && !empty($turno) && !empty($dias)) {

                            $total = 0;
                            foreach ($dias as $dia) {
                                $honorario = pagoDiario($horasTrabajadas, $turno, $dia);
                                $total += $honorario;
                            }


                            echo '<td class="border border-gray-300 px-4 py-2">$' . number_format($total, 2, ",", ".") . '</td>';
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


<?php require_once('pie.php'); ?>