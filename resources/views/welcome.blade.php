<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sección de Alimentos Mejorada</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
    <header class="header-alimentos">
        <h1><span class="logo-tottus">TOTTUS </span></h1>

        <div class="zona-superior-derecha">
            <div class="barra-busqueda-principal">
                <input type="text" placeholder="Buscar alimentos...">
                <button>Buscar</button>
            </div>

            <div class="contenedor-carrito">
                <a href="carrito.html" class="boton-carrito">🛒 Carrito</a>
            </div>
        </div>
    </header>

    <nav class="categorias-horizontal">
        <ul class="categorias-lista-horizontal"> <li><a href="frutas.html">Frutas</a></li>
            <li><a href="verduras.html">Verduras</a></li>
            <li><a href="abarrotes.html">Abarrotes</a></li>
            <li><a href="carnes.html">Carnes</a></li>
            <li><a href="lacteos.html">Lácteos</a></li>
            <li><a href="panaderia.html">Panadería</a></li>
            <li><a href="pasteleria.html">Pastelería</a></li>
            <li><a href="bebidas.html">Bebidas</a></li>
        </ul>
    </nav>
    <main class="main-content">
        <div class="contenedor-navegacion">
            <section class="banner-slider">
                <div class="slide active">
                    <img src="{{ asset('images/banners/banner1.jpg.webp') }}" alt="Promoción 1">
                </div>
                <div class="slide">
                    <img src="{{ asset('images/banners/banner2.jpg.webp') }}" alt="Promoción 2">
                </div>
                <div class="slide">
                    <img src="{{ asset('images/banners/banner3.jpg.webp') }}" alt="Promoción 3">
                </div>
                <div class="slide">
                    <img src="{{ asset('images/banners/banner4.jpg.webp') }}" alt="Promoción 4">
                </div>
                <div class="slide">
                    <img src="{{ asset('images/banners/banner5.jpg.webp') }}" alt="Promoción 5">
                </div>
                <div class="slide">
                    <img src="{{ asset('images/banners/banner6.jpg.webp') }}" alt="Promoción 6">
                </div>
                <button class="prev">❮</button>
                <button class="next">❯</button>
            </section>
        </div>
        </main>

    <section class="productos-destacados">
      <h2>Destacados de la Semana</h2>
      <div class="lista-productos">
        <div class="producto">
          <img src="{{ asset('imagenes/pasteleria43.png') }}" alt="Turrón de Doña Pepa 500g">
          <h3>Turrón de Doña Pepa 500g</h3>
          <p class="precio">S/ 11.90 / UN</p>
          <button class="boton-comprar">Agregar al carrito</button>
        </div>
        <div class="producto">
          <img src="{{ asset('imagenes/pasteleria43.png') }}" alt="Turrón de Doña Pepa 500g">
          <h3>Turrón de Doña Pepa 500g</h3>
          <p class="precio">S/ 11.90 / UN</p>
          <button class="boton-comprar">Agregar al carrito</button>
        </div>
        <div class="producto">
          <img src="{{ asset('imagenes/panaderia35.png') }}" alt="Mini tostadas integrales x 110g">
          <h3>Mini tostadas integrales x 110g</h3>
          <p class="precio">S/ 6.90 / UN</p>
          <button class="boton-comprar">Agregar al carrito</button>
        </div>
        <div class="producto">
          <img src="{{ asset('imagenes/carne60.png') }}" alt="Chorizo parrillero 500g">
          <h3>Chorizo parrillero 500g</h3>
          <p class="precio">S/ 17.50 / UN</p>
          <button class="boton-comprar">Agregar al carrito</button>
        </div>
        <div class="producto">
          <img src="{{ asset('imagenes/bebidas53.png') }}" alt="Red Bull energizante sin azucar 250 mL">
          <h3>Red Bull sin azúcar 250 mL</h3>
          <p class="precio">S/ 7.90 / UN</p>
          <button class="boton-comprar">Agregar al carrito</button>
        </div>
        <div class="producto">
          <img src="{{ asset('imagenes/abarrote47.png') }}" alt="Sólido de Atún en Aceite 140g">
          <h3>Sólido de Atún en Aceite 140g</h3>
          <p class="precio">S/ 5.80 / UN</p>
          <button class="boton-comprar">Agregar al carrito</button>
        </div>
        <div class="producto">
          <img src="{{ asset('imagenes/abarrote38.png') }}" alt="Aceite de Soya 900 mL">
          <h3>Aceite de Soya 900 mL</h3>
          <p class="precio">S/ 6.10 / UN</p>
          <button class="boton-comprar">Agregar al carrito</button>
        </div>
        <div class="producto">
          <img src="{{ asset('imagenes/bebidas33.png') }}" alt="Agua 2.5L six pack">
          <h3>Agua 2.5L six pack</h3>
          <p class="precio">S/ 16.20 / UN</p>
          <button class="boton-comprar">Agregar al carrito</button>
        </div>
      </div>
    </section>

    <section class="zona-descuentos">
      <h2>Ofertas del Momento</h2>
      <div class="descuentos-grid">
        <div class="descuento-item">
          <img src="{{ asset('images/descuento/descuento1.jpg.webp') }}" alt="Descuento 1">
        </div>
        <div class="descuento-item">
          <img src="{{ asset('images/descuento/descuento2.jpg.webp') }}" alt="Descuento 2">
        </div>
        <div class="descuento-item">
          <img src="{{ asset('images/descuento/descuento3.jpg.webp') }}" alt="Descuento 3">
        </div>
      </div>
    </section>
  </main>

  <footer class="footer-alimentos">
    <div class="footer-social">
      <a href="https://www.facebook.com/TottusPeru" target="_blank">
        <img src="{{ asset('images/icons/facebook.png') }}" alt="Facebook">
      </a>
      <a href="https://www.instagram.com/tottusperu/" target="_blank">
        <img src="{{ asset('images/icons/instagram.png') }}" alt="Instagram">
      </a>
      <a href="https://www.youtube.com/@TottusPeru" target="_blank">
        <img src="{{ asset('images/icons/youtube.png') }}" alt="YouTube">
      </a>
    </div>
    <div class="footer-links">
      <a
        href="https://assets.contentstack.io/v3/assets/blt422ac29cebae1d64/blt3dabc5c40faa057e/67db3e1e1c722200f543b13d/TC_Web_y_App_v3_18.03.25_vf.pdf">Términos
        y condiciones</a>
      <a
        href="https://assets.contentstack.io/v3/assets/blt422ac29cebae1d64/bltb0dcce37212d19b6/680a53d983ae052f59e06575/Politica_de_Cookies_Tottus_Peru%CC%81_2025_4931-0316-7279_v.1.pdf">Política
        de cookies</a>
      <a href="https://www.tottus.com.pe/tottus-pe/content/politica-de-privacidad">Política de privacidad</a>
    </div>
    <div class="footer-separator"></div>
    <div class="footer-copyright">
      <p>© TODOS LOS DERECHOS RESERVADOS</p>
      <p>Av. Angamos Este N° 1805 Piso 10, Surquillo, Lima, Perú.</p>
    </div>
  </footer>


  <script src="script.js"></script>
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const slides = document.querySelectorAll('.slide');
      const prevBtn = document.querySelector('.prev');
      const nextBtn = document.querySelector('.next');
      let currentIndex = 0;

      function showSlide(index) {
        slides.forEach((slide, i) => {
          slide.classList.toggle('active', i === index);
        });
      }

      prevBtn.addEventListener('click', () => {
        currentIndex = (currentIndex > 0) ? currentIndex - 1 : slides.length - 1;
        showSlide(currentIndex);
      });

      nextBtn.addEventListener('click', () => {
        currentIndex = (currentIndex < slides.length - 1) ? currentIndex + 1 : 0;
        showSlide(currentIndex);
      });

      // Inicio automático del slider
      let slideInterval = setInterval(() => {
        currentIndex = (currentIndex + 1) % slides.length;
        showSlide(currentIndex);
      }, 5000); // Cambia cada 5 segundos

      // Pausar/Reanudar al pasar el mouse (opcional)
      const bannerSlider = document.querySelector('.banner-slider');
      bannerSlider.addEventListener('mouseenter', () => clearInterval(slideInterval));
      bannerSlider.addEventListener('mouseleave', () => {
        slideInterval = setInterval(() => {
          currentIndex = (currentIndex + 1) % slides.length;
          showSlide(currentIndex);
        }, 5000);
      });
    });

    // Script para mostrar la alerta del carrito (si tienes botones de "Agregar al carrito")
    document.querySelectorAll('.boton-comprar').forEach(button => {
      button.addEventListener('click', () => {
        const alerta = document.getElementById('alerta-carrito');
        alerta.style.display = 'block';
        setTimeout(() => {
          alerta.style.display = 'none';
        }, 3000); // Oculta la alerta después de 3 segundos
      });
    });
  </script>


  <div id="alerta-carrito">
    Se agregó al carrito.
  </div>

</body>

</html>