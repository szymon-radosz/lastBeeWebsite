@extends('layouts.app')

@section('content')

@if (Session::has('message'))
    <div class="alert alert-info alert-dismissible alertInfo" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        {{ Session::get('message') }}
    </div>
@endif


<div class="homePageContainer">
    <div class="row justify-content-center">
        <div class="col-sm-10">

                @foreach ($offersList as $offer)
                    <div class="card homePageOfferItem">
                        @if($offer->type == "Flights")
                            <div class="OfferType OfferTypeFlights">
                                <div class="imageContainer">
                                    <img src="/img/airplane-white.png" />
                                </div>
                                <p>Flights</p>
                            </div>
                        @elseif($offer->type == "Vacations")
                            <div class="OfferType OfferTypeVacations">
                                <div class="imageContainer">
                                    <img src="/img/sunset.png" />
                                </div>
                                <p>Vacations</p>
                            </div>
                        @elseif($offer->type == "Accomodation")
                            <div class="OfferType OfferTypeAccomodation">
                                <div class="imageContainer">
                                    <img src="/img/hotel-white.png" />
                                </div>
                                <p>Hotels</p>
                            </div>
                        @endif

                        <div class="OfferVoteContainer">

                            {{ Form::open(array('action' => array('VotesController@store', 'vote_id' => $offer->id))) }}
                                <div class="imgContainer">
                                    <button type="submit"><img src="/img/heart.png" /></button>
                                </div>
                            {{ Form::close() }}

                            <p>{{count($offer->users)}} votes / id {{$offer->id}}</p>
                        </div>

                        <div class="row homePageOfferItemRow">
                            <div class="col-sm-5 homePageOfferItemImage">
                                {!! $offer->img_url !!}
                            </div>
                            <div class="col-sm-7 homePageOfferItemContent">
                                <div>
                                    <h2 class="offerTitle">{{$offer->title}}</h2>
                                    <p class="offerDescription">{{$offer->description}}</p>
                                    <div class="homePageOfferItemBtn">
                                            @if (Auth::check())
                                                <a href={{$offer->page_url}} target="_blank">
                                                    <div class="btn btn-primary">Visit offer</div>
                                                </a>
                                            @else
                                                <a href="{{ url('register') }}">
                                                    <div class="btn btn-primary offerListBtn">Register for free to get access to offer</div>
                                                </a>
                                            @endif
                                        </a>
                                    </div>
                                    <p class="offertDate">Added: {{-- date('Y-m-d H:i:s', strtotime($offer->created_at)) --}} {{ date('d M, Y', strtotime($offer->created_at)) }} </p>
                                    @if($offer->brand == "fly4freeUS")
                                        <a href="https://www.fly4free.com/flight-deals" target="_blank"><img src="/img/fly4free.png" class="homePageOfferItemBrandLogo" /></a>
                                    @elseif($offer->brand == "travelPiratesUS")
                                        <a href="https://www.travelpirates.com/flights" target="_blank"><img src="/img/travelPiratesLogo.jpg" class="homePageOfferItemBrandLogo" /></a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                {{ $offersList->links('vendor.pagination.default') }}
         
            </div>
    </div>
</div>
@endsection
