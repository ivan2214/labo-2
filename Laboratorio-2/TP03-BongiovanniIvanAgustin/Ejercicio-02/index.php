<?php require_once('php/encabezado.php'); ?>


<?php
//longitud de la contraseña
$longitudContraseña = mt_rand(8, 16);

//  contraseña generada
$contraseñaSegura = '';

// valores de ascii no permitidos en un array a mano
$asciiNoPermitidos = [58, 59, 60, 61, 62, 63, 64, 91, 92, 93, 94, 95, 96, 123, 124, 125, 126];


for ($i = 0; $i < $longitudContraseña;) {
  $ascii = mt_rand(48, 122);

  // solo le añade el carácter si no es un valor acii no permitido oseea los simbolos
  if (!in_array($ascii, $asciiNoPermitidos)) {
    $contraseñaSegura .= chr($ascii);
    $i++; // saco los incrementos del for para incrementar solo si se añade un caracter valido y si es asi entonces avanza el for y de esta forma no pierdo valores geneerados ya que vuelve en cada iteracion a generar un nuevo valor hasta que llega a la longitud deseada de la contraseña
  }
}
?>



<main class="flex justify-center h-full items-center">
  <section class="my-5 border-2 border-gray-300 rounded-lg bg-gray-100">
    <article class="p-4 ">
      <p class="text-gray-600">Tu contraseña es: <span class="text-green-600"><?= $contraseñaSegura ?></strong></p>
    </article>

  </section>
</main>

<?php require_once('php/pie.php'); ?>