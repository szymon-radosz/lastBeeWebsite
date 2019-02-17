@extends('layouts.app')

@section('content')
<div class="container homePageContainer pageContainer">
    <div class="row justify-content-center">
        
        @if(Session::get('country') == 'PL')
            <div class="col-sm-10 offset-1 pageHeaderTitle">
                <h1>O nas</h1>
            </div>
            <div class="col-sm-10 offset-1">
                
                <p>Last-bee jest serwisem stworzonym, aby pomóc innym osobom w wygodny sposób szukać interesujących turystycznych okazji w jednym miejscu. <strong>Absolutnie za darmo.</strong></p>

                <p>Jesteśmy grupą osób, którzy zawsze lubią dostawać najlepsze oferty na kolejne podróże. 
                Pośród przeszukiwania wielu stron i ofert chcemy podzielić się z tobą najlepszymi ofertami budując serwis, z którego także Ty możesz skorzystać podczas szukania biletów lotniczych na kolejną podróż lub wakacji dla siebie i swoich najbliższych. <strong>Podoba Ci się ten pomysł?</strong></p>

                <p><a href="{{ url('/register') }}">Załóż konto</a> za darmo i zacznij korzystać z <a href="{{ url('/') }}">last-bee.com</a></p>
            </div>
        @else
            <div class="col-sm-10 offset-1 pageHeaderTitle">
                <h1>About Us</h1>
            </div>
            <div class="col-sm-10 offset-1">
                <p>Last-bee is a service with a mission to show our users all interesting travel offers in one place. <strong>Absolutely for free.</strong></p>

                <p>We are a group of travel enthusiast which always think about saving more money on next trips. We love finding new travel deals. <strong>Do you like it?</strong></p>

                <p><a href="{{ url('/register') }}">Sign up</a> for free and use <a href="{{ url('/') }}">last-bee.com</a></p>
            </div>
        @endif 
    </div>
</div>
@endsection
