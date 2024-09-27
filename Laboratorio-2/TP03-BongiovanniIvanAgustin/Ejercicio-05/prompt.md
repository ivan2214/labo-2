# Prompt mio :

Actua como un experto en desarrollo web, en php, css, tailwindcss y html5, sigue los estandares de w3c, quiero que seas lo mas semantico posible, utilices tailwindcss y no uses divs.

Consigna:

Crea una interfaz de usuario web que contenga un contenedor principal que ocupe toda la pantalla, con un main que tiene un seccion y adentro un article con una tabla centrada al medio de la pantalla para el juego busca minas de una matriz 10x10, abajo de la tabla una seccion con los puntos obtenidos y el lugar donde se encontro la bomba.
Sacarle el padding a los td con tailwindcss.
Solo dame la parte dentro del main.

# Respuesta de chatgpt:

Aquí tienes el código semántico solicitado utilizando HTML5 y TailwindCSS, siguiendo los estándares de W3C:

```html
<main class="h-screen flex flex-col items-center justify-center">
  <section class="flex items-center justify-center">
    <article>
      <table class="border-collapse">
        <tbody>
          <!-- Genera la matriz 10x10 para el juego busca minas -->
          <tr>
            <td class="border w-10 h-10 text-center p-0"></td>
            <td class="border w-10 h-10 text-center p-0"></td>
            <td class="border w-10 h-10 text-center p-0"></td>
            <td class="border w-10 h-10 text-center p-0"></td>
            <td class="border w-10 h-10 text-center p-0"></td>
            <td class="border w-10 h-10 text-center p-0"></td>
            <td class="border w-10 h-10 text-center p-0"></td>
            <td class="border w-10 h-10 text-center p-0"></td>
            <td class="border w-10 h-10 text-center p-0"></td>
            <td class="border w-10 h-10 text-center p-0"></td>
          </tr>
          <!-- Repite el <tr> para las demás filas de la tabla -->
        </tbody>
      </table>
    </article>
  </section>

  <section class="mt-6 text-center">
    <p class="text-lg">Puntos obtenidos: <span id="puntos">0</span></p>
    <p class="text-lg">Bomba encontrada en: <span id="bomba-encontrada">-</span></p>
  </section>
</main>
```

### Explicación:
1. **Semántica**: Utilizo `main`, `section`, y `article` de manera adecuada para respetar la semántica HTML.
2. **Tabla**: Dentro del `article`, está la tabla que representa la matriz de 10x10. He ajustado las celdas (`td`) con TailwindCSS para que no tengan padding (`p-0`).
3. **Centrado**: Tanto la tabla como la sección de puntos están centradas utilizando utilidades de TailwindCSS como `flex`, `items-center`, y `justify-center`.
4. **Puntos y Bomba**: Abajo de la tabla, hay una sección para mostrar los puntos obtenidos y la ubicación de la bomba encontrada.

Para agregar las filas restantes, puedes repetir el bloque `<tr>` para completar la matriz 10x10.