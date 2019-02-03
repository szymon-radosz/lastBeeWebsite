<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-66630077-2"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-66630077-2');
    </script>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>One place, all travel offers you need. Cheap flights, cheap vacations, cheap hotels. Absolutely for free.</title>

    <meta name="description" content="Find best travel offers, cheap flights, cheap vacation, cheap hotels in one place. Best US travel offers.">
    <meta name="keywords" content="hotels,cheap flights,flights,airline tickets,plane tickets,cheap airline tickets,cheap airfare,travelling,travel,vacations">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <script type="text/javascript" src="{{ URL::asset('js/landingForm.js') }}"></script>

    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700,800,900&amp;subset=latin-ext" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <p>last-<span>bee</span>.com</p>
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

                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/offers') }}">Offers</a>
                        </li>
                            
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Sign In</a>
                            </li>
                            <li class="nav-item">
                                @if (Route::has('register'))
                                    <a class="nav-link" href="{{ route('register') }}">Sign Up</a>
                                @endif
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
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

        <main class="py-4">
            @yield('content')
        </main>

        <div class="row footer">
            <div class="col-sm-3 footerCopyright">
                <p>last-bee.com</p>
                <div class="footerSocial">
                    <a href="https://www.facebook.com/lastbeecom" target="_blank">
                        <div class="footerSocialOption facebook">
                            <img src="/img/facebook.png" />
                        </div>
                    </a>

                    
                    <a href="https://www.instagram.com/lastbeecom" target="_blank">
                        <div class="footerSocialOption instagram">
                            <img src="/img/instagram.png" />
                        </div>
                    </a>

                   <!--<div class="footerSocialOption twitter">
                        <img src="/img/twitter.png" />
                    </div>-->
                </div>
            </div>
            <div class="col-sm-3">
                <p class="footerSectionHeader">Offers</p>
                <a href="{{ url('/offers') }}"><p>Offers</p></a>
            </div>
            <div class="col-sm-3">
                <p class="footerSectionHeader">Website</p>
                <a href="{{ url('/about') }}"><p>About us</p></a>
                <a href="{{ url('/privacy-policy') }}"><p>Privacy Policy</p></a>
            </div>
            <div class="col-sm-3">
                <p class="footerSectionHeader">Contact</p>
                <a href="{{ url('/customer-support') }}"><p>Customer Support</p></a>
            </div>
        </div>
    </div>
</body>
</html>
