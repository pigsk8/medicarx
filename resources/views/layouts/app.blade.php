<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Medicarx</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <!-- Collapsed Hamburger -->
                    @if (Auth::check())
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    @endif

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        Medicarx
                        @if (Auth::check())
                            <span>- Bienvenido <span class="text-capitalize">{{ Auth::user()->name }}</span></span>    
                        @endif
                    </a>
                </div>

                @if (Auth::check())
                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="{{ route('index') }}">Inicio</a>
                        </li>
                        <!-- Authentication Links -->
                        <li>
                            <a href="/perfil/<?=Auth::User()->id?>">Editar perfil</a>
                        </li>

                        <li>
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                Cerrar sesión
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </div>
                @endif
            </div>
        </nav>

        @yield('content')

    </div>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
