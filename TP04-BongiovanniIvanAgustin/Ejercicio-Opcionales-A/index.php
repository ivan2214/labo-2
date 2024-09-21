<?php require_once('php/encabezado.php'); ?>


<main class="flex justify-center h-full items-center">
  <section class="bg-white p-6 rounded shadow-md w-full max-w-sm">
    <form action="php/procesar.php" method="POST">
      <section class="flex justify-center items-center gap-4">
        <label for="numero" class="block text-sm font-medium text-gray-700">Ingrese un numero</label>
        <input type="text" id="numero" name="numero" required class="block px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
      </section>


      <fieldset class="mt-4">
        <legend class="sr-only">Opciones</legend>

        <ul class="flex flex-col gap-2 items-start">
          <li>
            <label class="block">
              <input type="radio" name="operacion" value="invertir" class="mr-2" required>
              Invertir el número
            </label>
          </li>


          <li>
            <label class="block">
              <input type="radio" name="operacion" value="contar-impares" class="mr-2" required>
              Contar los impares
            </label>
          </li>

          <li>
            <label class="block">
              <input type="radio" name="operacion" value="contar-primos" class="mr-2" required>
              Contar los primos
            </label>
          </li>
        </ul>

      </fieldset>

      <button type="submit" class="mt-6 px-4 py-2 bg-blue-500 text-white font-semibold rounded-md hover:bg-blue-600">Procesar</button>
    </form>
  </section>
</main>


<?php require_once('php/pie.php'); ?>