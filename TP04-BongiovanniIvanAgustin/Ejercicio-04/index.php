<?php require_once('php/encabezado.php'); ?>


<?php

?>



<main class="flex justify-center h-full items-center">
  <article class="bg-white rounded-lg shadow-md p-6 w-full max-w-md">
    <h1 class="text-2xl font-bold text-center mb-4">Financiera</h1>
    <form action="php/ganancias.php" method="post">
      <label for="deposito" class="block mb-2 font-medium">Depósito Inicial:</label>
      <input 
        type="number" 
        id="deposito" 
        name="deposito" 
        class="w-full p-2 border border-gray-300 rounded mb-4" 
        placeholder="Ingrese su depósito inicial" 
        required 
      />

      <fieldset class="mb-4">
        <legend class="font-medium">Plazo:</legend>
        <label class="block">
          <input type="radio" name="plazo" value="30" class="mr-2" />
          30 días
        </label>
        <label class="block">
          <input type="radio" name="plazo" value="45" class="mr-2" />
          45 días
        </label>
        <label class="block">
          <input type="radio" name="plazo" value="60" class="mr-2" />
          60 días
        </label>
        <label class="block">
          <input type="radio" name="plazo" value="90" class="mr-2" />
          90 días
        </label>
      </fieldset>

      <button type="submit" class="w-full bg-blue-500 text-white font-semibold py-2 rounded hover:bg-blue-600">
        Simular
      </button>
    </form>
  </article>
</main>


<?php require_once('php/pie.php'); ?>