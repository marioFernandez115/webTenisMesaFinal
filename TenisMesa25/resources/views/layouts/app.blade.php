<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>{{ config('app.name', 'Tenis de mesa Rivas Vaciamadrid') }}</title>

    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Meta SEO -->
    <meta name="description" content="Descubre toda la información sobre el tenis de mesa en Rivas Vaciamadrid: noticias, resultados, clasificaciones y mucho más.">
    <meta name="keywords" content="tenis de mesa, Rivas Vaciamadrid, ping pong, club deportivo, resultados tenis de mesa, Madrid, competiciones">
    <meta name="author" content="Club Deportivo Tenis de Mesa Rivas - Mario Fernandez Rodriguez">
    <meta name="robots" content="index, follow">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="TENIS DE MESA RIVAS VACIAMADRID">
    <meta property="og:description" content="Sigue todas las novedades del tenis de mesa en Rivas Vaciamadrid: torneos, noticias, resultados y más. ¡Únete!">
    <meta property="og:image" content="{{ asset('img/logoTenisDeMesa.jpg') }}">
    <meta property="og:site_name" content="Tenis de Mesa Rivas Vaciamadrid">
    <meta property="og:locale" content="es_ES">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@cdtmrivas">
    <meta name="twitter:title" content="TENIS DE MESA RIVAS VACIAMADRID">
    <meta name="twitter:description" content="Toda la información sobre tenis de mesa en Rivas Vaciamadrid: noticias, torneos y clasificaciones.">
    <meta name="twitter:image" content="{{ asset('img/logoTenisDeMesa.jpg') }}">

    <!-- Extras -->
    <meta name="theme-color" content="#ff6600">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-title" content="Tenis de Mesa Rivas">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
</head>

<body>
    <div id="app">
        <!-- Barra de navegación -->
        <nav class="navbar navbar-expand-lg custom-navbar">
            <div class="container">
                <a class="navbar-brand text-white" href="{{ url('/') }}">
                    {{ config('app.name', 'Tenis de mesa Rivas Vaciamadrid') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav">
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('login') }}">{{ __('Iniciar Sesion') }}</a>
                        </li>
                        @endif

                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('register') }}">{{ __('Registro') }}</a>
                        </li>
                        @endif
                        @if (Route::has('nosotros'))
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('nosotros') }}">Nosotros</a>
                        </li>
                        @endif
                        @if (Route::has('contacto'))
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('contacto') }}">Contacto</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ url('/') }}">Inicio</a>
                        </li>

                        @if (Route::has('contacto'))
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('contacto') }}">Contacto</a>
                        </li>
                        @endif

                        @if (Route::has('partidos.index'))
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('partidos.index') }}">Jornadas y Partidos</a>
                        </li>
                        @endif

                        @if (Auth::user() && Auth::user()->rol === 'mantenimiento')
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('usuarios.index') }}">Gestionar Usuarios</a>
                        </li>
                        @endif

                        @if (Auth::user() && Auth::user()->rol === 'mantenimiento')
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('partidos.index') }}">Gestionar Partidos</a>
                        </li>
                        @endif
                        @if (Route::has('nosotros'))
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('nosotros') }}">Nosotros</a>
                        </li>
                        @endif

                        <li class="nav-item">
                            <span class="nav-link text-white">{{ Auth::user()->name }}</span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Contenido principal -->
        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <footer class="bg-dark text-white pt-4 pb-3">
        <div class="container">
            <div class="row">
                <!-- Contacto -->
                <div class="col-md-4 mb-3">
                    <h5 class="text-uppercase">Contacto</h5>
                    <ul class="list-unstyled">
                        <li><strong>Teléfono:</strong> <a href="tel:+34654152194" class="text-white text-decoration-none">+34 654 15 21 94</a></li>
                        <li><strong>Correo:</strong> <a href="mailto:admon@rivastenisdemesa.com" class="text-white text-decoration-none">admon@rivastenisdemesa.com</a></li>
                        <li><strong>Dirección:</strong> Polideportivo Parque del Sureste, Rivas-Vaciamadrid, 28522, Madrid</li>
                    </ul>
                </div>

                <!-- Redes sociales -->
                <div class="col-md-4 mb-3">
                    <h5 class="text-uppercase">Síguenos</h5>
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <a href="https://www.youtube.com/channel/UC6-9EHYOnDjwHfPzl-HhDUA?app=desktop" target="_blank" class="text-white">
                                <i class="fab fa-youtube fa-2x"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="https://www.instagram.com/rivastenisdemesa" target="_blank" class="text-white">
                                <i class="fab fa-instagram fa-2x"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="https://www.facebook.com/rivastenisdemesa/?_rdr" target="_blank" class="text-white">
                                <i class="fab fa-facebook fa-2x"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="https://x.com/cdtmrivas?lang=es" target="_blank" class="text-white">
                                <i class="fab fa-twitter fa-2x"></i>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Derechos -->
                <div class="col-md-4 mb-3">
                    <h5 class="text-uppercase">Información</h5>
                    <p>&copy; 2025 Tenis de Mesa. Todos los derechos reservados.</p>
                    <p><small>Desarrollado por <a href="https://www.tusitio.com" class="text-white text-decoration-none">Mario Fernandez Rodriguez</a></small></p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>

</html>