<?php require_once('php/encabezado.php'); ?>


<?php
// Generar un número aleatorio entre 8 y 16 para la longitud de la contraseña
$longitudContraseña = mt_rand(8, 16);

// Variable para almacenar la contraseña generada
$contraseñaSegura = '';

// ASCII no permitidos
$asciiNoPermitidos = [58, 59, 60, 61, 62, 63, 64, 91, 92, 93, 94, 95, 96, 123, 124, 125, 126];

// Bucle para generar cada carácter
for ($i = 0; $i < $longitudContraseña;) {
  $ascii = mt_rand(48, 122);

  // Solo le añade el carácter si no es un valor ASCII no permitido (simbolos)
  if (!in_array($ascii, $asciiNoPermitidos)) {
    $contraseñaSegura .= chr($ascii);
    $i++; // Incrementar solo si se añade un carácter válido
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