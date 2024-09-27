<?php require_once('encabezado.php'); ?>

<?php

$email = '';
$contraseña = '';

if (!empty($_POST['email']) && !empty($_POST['contraseña'])) {

    $email = $_POST['email'];
    $contraseña = $_POST['contraseña'];
} else {
    $email = 'Ingrese email';
    $contraseña = 'Ingrese contraseña';
}


?>

<main class="flex justify-center h-full items-center">
    <article class="bg-white p-6 rounded shadow-md w-full max-w-sm flex flex-col items-center gap-4">
        <header class="">
            <h1 class="text-xl font-semibold text-center">Datos Ingresados</h1>
        </header>
        <section class="w-full flex gap-4 items-center">
            <p class="block text-sm font-medium text-gray-700">Email:</p>
            <span class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"><?= $email ?></span>
        </section>

        <section class="w-full flex gap-4 items-center">
            <p class="block text-sm font-medium text-gray-700">Contraseña:</p>
            <span class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"><?= $contraseña ?></span>
        </section>

        <footer class="ml-auto">
            <a href="../index.php" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Volver</a>
        </footer>


    </article>
</main>



<?php require_once('pie.php'); ?>