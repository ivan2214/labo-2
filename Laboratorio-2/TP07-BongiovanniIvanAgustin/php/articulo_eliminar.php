<?php
$ruta = '../';
require("encabezado.php");
?>

<main class="d-flex justify-content-center align-items-center login">
    <section class="text-center">
        <article>
            <h1 class="mb-3 text-white">Eliminar artículo</h1>
            <p class="mb-4 text-white">¿Está seguro que quiere eliminar el artículo <strong>nombre_artículo</strong>?</p>
        </article>

        <section>
            <a class="btn btn-primary me-2">Aceptar</a>
            <a class="btn btn-secondary">Cancelar</a>
        </section>
    </section>
</main>

<?php
require("pie.php");
?>