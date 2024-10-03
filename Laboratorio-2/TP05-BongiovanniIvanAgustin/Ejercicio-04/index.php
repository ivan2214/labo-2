<?php require_once('php/encabezado.php'); ?>


<?php

?>



<main class="flex justify-center h-full items-center">
  <section class="bg-white p-6 rounded shadow-md w-full max-w-sm">
    <form action="php/consulta.php" method="POST">
      <header class="mb-4">
        <h2 class="text-xl font-semibold text-center">Consultar sueldos</h1>
      </header>
      <section class="mb-4 flex justify-center items-center gap-4">
        <label for="legajo" class="block text-sm font-medium text-gray-700">Legajo</label>
        <input placeholder="Legajo" type="text" id="legajo" name="legajo" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
      </section>

      <footer>
        <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Consultar</button>
      </footer>
    </form>
  </section>
</main>

<?php require_once('php/pie.php'); ?>