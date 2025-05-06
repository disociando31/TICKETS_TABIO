<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
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
    <div id="para-mirar">
        <!-- Barra de Accesibilidad Gov.co -->
        {{-- <div class="content-example-barra">
            <div class="barra-accesibilidad-govco">
                <button id="botoncontraste" class="icon-contraste" onclick="cambiarContexto()">
                    <span id="titlecontraste">Contraste</span>
                </button>
                <button id="botondisminuir" class="icon-reducir" onclick="disminuirTamanio()">
                    <span id="titledisminuir">Reducir letra</span>
                </button>
                <button id="botonaumentar" class="icon-aumentar" onclick="aumentarTamanio()">
                    <span id="titleaumentar">Aumentar letra</span>
                </button>
            </div>
        </div> --}}

        <div id="app">
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <div class="container">
                    {{--<a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button> --}}

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav me-auto">

                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ms-auto">
                            <!-- Authentication Links -->
                            @guest
                                @if (Route::has('login'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                    </li>
                                @endif

                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>

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