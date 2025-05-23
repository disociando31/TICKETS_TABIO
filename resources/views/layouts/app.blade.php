<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    
    <!-- Estilos de accesibilidad Gov.co -->
    
</head>
<body>
    @include('partials.accessibility')
    @include('partials.gov')
    @include('partials.breadcrumbs')
    <div id="para-mirar">
        <div id="app">
            <main class="py-4">
                @yield('content')
            </main>

            <!-- Volver arriba -->
            <div class="row">
                <div class="col-md-5"></div>
                <div class="col-md-2 mt-5">
                    <!-- Volver arriba -->
                    <button class="volver-arriba-govco" aria-describedby="descripcionId" aria-label="Volver arriba">
                        <img src="{{ asset('images/accessibility/iconoArriba.svg') }}" alt="Flecha arriba" class="arrow-icon">
                    </button>
                    <span class="d-none" id="descripcionId">
                        Seleccione esta opción como atajo para volver al inicio de esta página.
                    </span>
                </div>
                <div class="col-md-5"></div>
            </div>
        </div>
    </div>

    <!-- Scripts de accesibilidad -->
    <script>
        window.addEventListener("load", function() {
            initTopBar();
            
            // Volver arriba
            var backGoToUpElement = document.querySelector(".volver-arriba-govco");
            backGoToUpElement.addEventListener("click", backGoToUp, false);
            
            // Mostrar/ocultar botón según el scroll
            window.addEventListener("scroll", function() {
                if (window.scrollY > 300) {
                    backGoToUpElement.style.display = "block";
                } else {
                    backGoToUpElement.style.display = "none";
                }
            });
        });
    
        function initTopBar() {
            const translateElement = document.querySelector(".idioma-icon-barra-superior-govco");
            translateElement.addEventListener("click", translate, false);
    
            function translate() {
                console.log("Traducción pendiente de implementar");
            }
        }
    
        function backGoToUp() {
            // Animación suave al volver arriba
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }
    </script>
</body>
</html>