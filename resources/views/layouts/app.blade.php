<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0-1/css/all.css" rel="stylesheet">

</head>
<body>
    <div class="d-flex flex-column h-screen justify-content-between">
        <header>
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <div class="container">
                <img src="/images/logo.png" width="3%" alt="image"/>

                    <a class="navbar-brand ml-3" href="{{ route('home') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">

                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            @guest
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admissions') }}">{{ __('Admissions') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item dropdown">

                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        <span data-letters="{{ Auth::user()->first_name[0] }}{{ Auth::user()->last_name[0] }}" data-toggle="tooltip" ></span>
                                        {{ Auth::user()->first_name }} {{ Auth::user()->last_name }} <span class="caret"></span>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>

                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>
        </header>


        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col">
                    <main class="pb-5">
                        @yield('content')
                    </main>            
                    </div>
                </div>
            </div>
        </main>

        <footer class="bg-white text-center text-black-50 py-2 shadow">
        <a href="{{ route('home') }}"><h4 class="text-primary navbar-brand">{{ config('app.name') }} | Copyright @ {{ date('yy') }}</h2></a>
        <div class="justify-content-between align-items-center">
            <a href="https://www.facebook.com/"><i class="social facebook fab fa-facebook fa-2x"></i></a>
            <a href="https://www.instagram.com/"><i class="social instagram fab fa-instagram fa-2x"></i></a>
            <a href="https://www.twitter.com/"><i class="social twitter fab fa-twitter fa-2x"></i></a>
        </div>
        </footer>

    </div>

</body>
</html>
