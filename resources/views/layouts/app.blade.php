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

    <title>One place, all travel offers you need.</title>

    <meta name="description" content="Find best travel offers, cheap flights, cheap vacation, cheap hotels in one place. Best US travel offers.">
    <meta name="keywords" content="hotels,cheap flights,flights,airline tickets,plane tickets,cheap airline tickets,cheap airfare,travelling,travel,vacations">

    

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    

    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700,800,900&amp;subset=latin-ext" rel="stylesheet">
</head>
@if(!Session::has('country'))
    <body class="disableScroll">
@else
    <body>
@endif
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
                            @if(Session::get('country') == 'PL')
                                <a class="nav-link" href="{{ url('/offers') }}">Oferty</a>
                            @else
                                <a class="nav-link" href="{{ url('/offers') }}">Offers</a>
                            @endif
                            
                        </li>
                            
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                @if(Session::get('country') == 'PL')
                                    <a class="nav-link" href="{{ route('login') }}">Logowanie</a>
                                @else
                                    <a class="nav-link" href="{{ route('login') }}">Sign In</a>
                                @endif
                               
                            </li>
                            <li class="nav-item">
                                @if(Session::get('country') == 'PL' && Route::has('register'))
                                    <a class="nav-link" href="{{ route('register') }}">Rejestracja</a>
                                @elseif(Route::has('register'))
                                    <a class="nav-link" href="{{ route('register') }}">Sign Up</a>
                                @endif
                               
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                    @if(Session::get('country') == 'PL' && Route::has('register'))
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            {{ __('Wyloguj się') }}
                                        </a>
                                    @elseif(Route::has('register'))
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                    @endif

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest

                        <li class="nav-item">
                            @if(Session::get('country') == 'USA')
                                {{ Form::open(array('action' => array('CountryController@clearCountry'))) }}
                                    <button type="submit" class="currentCountryBtn">
                                        <img src="/img/USAflag.png" class="currentCountry" />
                                    </button>   
                                {{ Form::close() }}

                            @elseif(Session::get('country') == 'UK')
                                {{ Form::open(array('action' => array('CountryController@clearCountry'))) }}
                                    <button type="submit" class="currentCountryBtn">
                                        <img src="/img/GBflag.gif" class="currentCountry" />
                                    </button>   
                                {{ Form::close() }}

                            @elseif(Session::get('country') == 'AU')
                                {{ Form::open(array('action' => array('CountryController@clearCountry'))) }}
                                    <button type="submit" class="currentCountryBtn">
                                        <img src="/img/AUflag.png" class="currentCountry" />
                                    </button>   
                                {{ Form::close() }}

                            @elseif(Session::get('country') == 'PL')
                                {{ Form::open(array('action' => array('CountryController@clearCountry'))) }}
                                    <button type="submit" class="currentCountryBtn">
                                        <img src="/img/PLflag.jpg" class="currentCountry" />
                                    </button>   
                                {{ Form::close() }}

                            @endif 
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        @if(!Session::has('country'))
            <div class="modalBg">
                <div class="modalContainer">
                    <h3>Please, select a country.<br />Prosimy wybrać kraj.</h3>
                    <div class="countryContainer">
                        <div class="countryRow">
                            <div class="countryOption">
                                {{ Form::open(array('action' => array('CountryController@setUSA'))) }}
                                    <button type="submit" title="Select USA">
                                        <img src="/img/USAflag.png" id="USAflag" />
                                    </button>   
                                {{ Form::close() }}

                            </div>

                            <div class="countryOption">
                                {{ Form::open(array('action' => array('CountryController@setUK'))) }}
                                    <button type="submit" title="Select UK">
                                        <img src="/img/GBflag.gif" id="GBflag" />
                                    </button>   
                                {{ Form::close() }}

                            </div>
                        </div>

                        <div class="countryRow">
                            {{-- <div class="countryOption">
                                {{ Form::open(array('action' => array('CountryController@setAU'))) }}
                                    <button type="submit" title="Select AU">
                                        <img src="/img/AUflag.png" id="AUflag" />
                                    </button>   
                                {{ Form::close() }}

                            </div> --}}

                            <div class="countryOption">
                                {{ Form::open(array('action' => array('CountryController@setPL'))) }}
                                    <button type="submit" title="Select PL">
                                        <img src="/img/PLflag.jpg" id="PLflag" />
                                    </button>   
                                {{ Form::close() }}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

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

                    
                    <a href="https://www.instagram.com/last_bee.com_pl/" target="_blank">
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
                @if(Session::get('country') == 'PL')
                    <p class="footerSectionHeader">Oferty</p>
                    <a href="{{ url('/offers') }}"><p>Oferty</p></a>
                @else
                    <p class="footerSectionHeader">Offers</p>
                    <a href="{{ url('/offers') }}"><p>Offers</p></a>
                @endif
                
            </div>
            <div class="col-sm-3">
                @if(Session::get('country') == 'PL')
                    <p class="footerSectionHeader">Aplikacja</p>
                    <a href="{{ url('/about') }}"><p>O nas</p></a>
                    <a href="{{ url('/privacy-policy') }}"><p>Polityka prywatności</p></a>
                @else
                    <p class="footerSectionHeader">Website</p>
                    <a href="{{ url('/about') }}"><p>About us</p></a>
                    <a href="{{ url('/privacy-policy') }}"><p>Privacy Policy</p></a>
                @endif
                
            </div>
            <div class="col-sm-3">
                @if(Session::get('country') == 'PL')
                    <p class="footerSectionHeader">Kontakt</p>
                    <a href="{{ url('/customer-support') }}"><p>Obsługa klienta</p></a>
                @else
                    <p class="footerSectionHeader">Contact</p>
                    <a href="{{ url('/customer-support') }}"><p>Customer Support</p></a>
                @endif
                
            </div>
 
        </div>

        <p class="copyright">&copy; 2019 last-bee.com. All rights reserved.</p>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <script type="text/javascript" src="{{ URL::asset('js/landingForm.js') }}"></script>
</body>
</html>
