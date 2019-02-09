@extends('layouts.app')

@section('content')
<div class="container homePageContainer pageContainer">
    <div class="row justify-content-center">
        @if(Session::get('country') == 'PL')
            <div class="col-sm-10 offset-1 pageHeaderTitle">
                <h1>Obsługa klienta</h1>
            </div>
            <div class="col-sm-10 offset-1">
                <p>Masz do nas pytanie? Napisz wiadomość.</p>
                <h3><a href="mailto:ask@last-bee.com?Subject=Problem" target="_top">ask@last-bee.com</a></h3>
            </div>
        @else
            <div class="col-sm-10 offset-1 pageHeaderTitle">
                <h1>Customer Support</h1>
            </div>
            <div class="col-sm-10 offset-1">
                <p>If you have any questions, please send us an email message.</p>
                <h3><a href="mailto:ask@last-bee.com?Subject=Problem" target="_top">ask@last-bee.com</a></h3>
            </div>
        @endif 
    </div>
</div>
@endsection
