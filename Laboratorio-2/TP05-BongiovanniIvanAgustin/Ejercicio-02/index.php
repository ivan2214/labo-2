<?php require_once('php/encabezado.php'); ?>



<main class="flex justify-center h-full items-center py-5">
  <section class="w-full max-w-lg">
    <header class="flex justify-start">
      <h1 class="text-left text-lg font-bold text-slate-500">Registro Enfermería</h1>
    </header>

    <hr class="my-4 border-gray-300">

    <form action="php/procesa.php" method="POST" class="space-y-4">

      <label for="horas-trabajadas" class="block text-lg font-medium text-slate-500">Horas trabajadas</label>
      <input min="0" max="999" type="number" id="horas-trabajadas" name="horas-trabajadas" placeholder="0" class="w-full px-1 py-0.5 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 placeholder:text-slate-400 text-slate-500" required>


      <label for="turno" class="block text-lg font-medium text-slate-500">Turno</label>
      <select id="turno" name="turno" class="w-full px-1 py-0.5 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        <option value="">Selecciona un turno</option>
        <option value="matutino">Matutino</option>
        <option value="nocturno">Nocturno</option>
      </select>


      <fieldset>
        <legend class="block text-lg font-medium text-slate-500">Días de la semana</legend>
        <ul class="space-y-2 text-slate-200">
          <li>
            <label class="inline-flex items-center">
              <input type="checkbox" name="dias[]" value="lunes" class="form-checkbox">
              <span class="ml-2">Lunes</span>
            </label>
          </li>
          <li>
            <label class="inline-flex items-center">
              <input type="checkbox" name="dias[]" value="martes" class="form-checkbox">
              <span class="ml-2">Martes</span>
            </label>
          </li>
          <li>
            <label class="inline-flex items-center">
              <input type="checkbox" name="dias[]" value="miércoles" class="form-checkbox">
              <span class="ml-2">Miércoles</span>
            </label>
          </li>
          <li>
            <label class="inline-flex items-center">
              <input type="checkbox" name="dias[]" value="jueves" class="form-checkbox">
              <span class="ml-2">Jueves</span>
            </label>
          </li>
          <li>
            <label class="inline-flex items-center">
              <input type="checkbox" name="dias[]" value="viernes" class="form-checkbox">
              <span class="ml-2">Viernes</span>
            </label>
          </li>
          <li>
            <label class="inline-flex items-center">
              <input type="checkbox" name="dias[]" value="sabado" class="form-checkbox">
              <span class="ml-2">Sábado</span>
            </label>
          </li>
          <li>
            <label class="inline-flex items-center">
              <input type="checkbox" name="dias[]" value="domingo" class="form-checkbox">
              <span class="ml-2">Domingo</span>
            </label>
          </li>
        </ul>
      </fieldset>


      <button type="submit" class="block mx-auto px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">Calcular</button>
    </form>
  </section>
</main>

<?php require_once('php/pie.php'); ?>