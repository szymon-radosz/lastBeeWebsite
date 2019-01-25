@extends('layouts.app')

@section('content')
<div class="container homePageContainer pageContainer">
    <div class="row justify-content-center">
        <div class="col-sm-10 offset-1 pageHeaderTitle">
            <h1>About Us</h1>
        </div>
        <div class="col-sm-10 offset-1">
            <p>Last-bee is a service with a mission to show our users all interesting travel offers in one place. <strong>Absolutely for free.</strong></p>

            <p>We are a group of travel enthusiast which always think about saving more money on next trips. We love finding new travel deals. <strong>Do you like it?</strong></p>

            <p><a href="{{ url('/register') }}">Sign up</a> for free and use <a href="{{ url('/') }}">last-bee.com</a></p>
        </div>
    </div>
</div>
@endsection
