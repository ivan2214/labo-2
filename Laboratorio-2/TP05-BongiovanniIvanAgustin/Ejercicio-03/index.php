<?php require_once('php/encabezado.php'); ?>


<?php

?>



<main class="flex justify-center h-full items-center">
  <article class="bg-white rounded-lg shadow-md p-6 w-full max-w-md">
    <h2 class="text-2xl font-bold text-center mb-4">Consultar Ganancia</h2>
    <form action="php/consultar.php" method="post">
      <label for="nombre" class="block mb-2 font-medium">Nombre:</label>
      <input
        type="text"
        id="nombre"
        name="nombre"
        class="w-full p-2 border border-gray-300 rounded mb-4"
        placeholder="Ingrese su depósito inicial"
        required />



      <button type="submit" class="w-full bg-blue-500 text-white font-semibold py-2 rounded hover:bg-blue-600">
        Consultar
      </button>
    </form>
  </article>
</main>


<?php require_once('php/pie.php'); ?>