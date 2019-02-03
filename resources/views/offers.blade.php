@extends('layouts.app')

@section('content')

@if (Session::has('message'))
    <div class="alert alert-info alert-dismissible alertInfo" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        {{ Session::get('message') }}
    </div>
@endif


<div class="homePageContainer">
    <div class="row landingSearchSection offersSearchSection">
        <div class="col-sm-12 landingSearchSectionHeaderText">
            <h2 class="">Find offers fit for you</h2>
        </div>

        {{ Form::open(array('action' => array('OffersController@findOffers'))) }}
        <div class="row landingSearchSectionBtnOptions">
            <p class="landingSearchSectionHelper">1. Select offers type/types.</p>
            <div class="landingSearchSectionBtnOptionsContainer">

                <div class="landingSearchCheckboxes">
                    {{ Form::checkbox('FlightsCheck', null, null, array('id' => 'FlightsCheckId')) }} 
                    {{ Form::checkbox('VacationsCheck', null, null, array('id' => 'VacationsCheckId')) }} 
                    {{ Form::checkbox('HotelsCheck', null, null, array('id' => 'HotelsCheckId')) }} 
                </div>

                <div class="col-sm-4 landingSearchOptionIconContainer" id="FlightRectLanding">
                    <div class="landingSearchOptionIconWrapper"> 
                        <img src="/img/airplane.png" />
                        <p>Flights</p>
                    </div>
                </div>

                <div class="col-sm-4 landingSearchOptionIconContainer" id="VacationsRectLanding">
                    <div class="landingSearchOptionIconWrapper"> 
                        <img src="/img/sunset.png"  />
                        <p>Vacations</p>
                    </div>
                </div>

                <div class="col-sm-4 landingSearchOptionIconContainer" id="HotelsRectLanding">
                    <div class="landingSearchOptionIconWrapper"> 
                        <img src="/img/hotel.png" />
                        <p>Hotels</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-12 landingSearchSectionLocationInput">
            <p class="landingSearchSectionHelper">2. Write down interesting location. (optional)</p>
            <div class="form-group">
                <!--<input type="text" class="form-control" id="usr" placeholder="Location">-->

                {{ Form::text('locationInput', null, array('class' => 'form-control', 'placeholder' => 'Location')) }}

            </div>
        </div>

        <div class="col-sm-12 landingSearchSectionLocationInput">
            <p class="landingSearchSectionHelper">3. Select interesting price range.</p>
            <div class="form-group">
                <div id="rangeSlider"></div>

                <div class="priceRange priceRangeTop">
                    <p class="rangeHeader">From: </p>
                    <div id="priceRangeSendDisplayOnViewLower"></div>
                    <p>$</p>

                    {{ Form::text('priceRangeSendToFormLower', '100', array('id' => 'priceRangeSendToFormLower')) }}
                </div>
                <div class="priceRange">
                    <p class="rangeHeader">To: </p>
                    <div id="priceRangeSendDisplayOnViewUpper"></div>
                    <p>$</p>

                    {{ Form::text('priceRangeSendToFormUpper', '3000', array('id' => 'priceRangeSendToFormUpper')) }}
                </div>

            </div>
        </div>

        <div class="col-sm-12 landingSearchSectionSearchBtn">
            <p class="landingSearchSectionHelper">4. Search through all offers.</p>
            <button type="submit" class="btn landingSearchSectionBtn">Search</button>
        </div>
        {{ Form::close() }}
    </div>
    
    <div class="row justify-content-center">
        <div class="col-sm-10">

                @foreach ($offersList as $offer)
                    <div class="card homePageOfferItem">
                        @if($offer->type == "Flights")
                            <div class="OfferType OfferTypeFlights">
                                <div class="imageContainer">
                                    <img src="/img/airplane-white.png" />
                                </div>
                                <a href="{{ env('APP_ADDRESS') }}/offers/0/1/0/0/0/10000" target="_blank" title="Show Flights Offers"><p>Flights</p></a>
                            </div>
                        @elseif($offer->type == "Vacations")
                            <div class="OfferType OfferTypeVacations">
                                <div class="imageContainer">
                                    <img src="/img/sunset.png" />
                                </div>
                                <a href="{{ env('APP_ADDRESS') }}/offers/0/0/1/0/0/10000" target="_blank" title="Show Vacations Offers"><p>Vacations</p></a>
                            </div>
                        @elseif($offer->type == "Accomodation")
                            <div class="OfferType OfferTypeAccomodation">
                                <div class="imageContainer">
                                    <img src="/img/hotel-white.png" />
                                </div>
                                <a href="{{ env('APP_ADDRESS') }}/offers/0/0/0/1/0/10000" target="_blank" title="Show Hotels Offers"><p>Hotels</p></a>
                            </div>
                        @endif

                        <div class="OfferVoteContainer">

                            {{ Form::open(array('action' => array('VotesController@store', 'vote_id' => $offer->id))) }}
                                <div class="imgContainer">
                                    <button type="submit" title="Vote for that offer"><img src="/img/heart.png" /></button>
                                </div>
                            {{ Form::close() }}

                            <p>{{count($offer->users)}} votes</p>
                        </div>

                        <div class="row homePageOfferItemRow">
                            <div class="col-sm-5 homePageOfferItemImage">
                                {!! $offer->img_url !!}
                            </div>
                            <div class="col-sm-7 homePageOfferItemContent">
                                <div>
                                    @if (Auth::check())
                                        <a href={{$offer->page_url}} target="_blank" title="Show More Details">
                                            <h2 class="offerTitle" onclick="location.href='{{ env('APP_ADDRESS') }}/offers/{{ substr($offer->title, 0, 20) }}/1/1/1/0/10000' ;">{{$offer->title}}</h2>
                                        </a>
                                    @else 
                                        <h2 class="offerTitle">{{$offer->title}}</h2>
                                    @endif
                                    <p class="offerDescription">{{substr($offer->description, 0, 210)}} ...</p>
                                    <div class="homePageOfferItemBtn">
                                            @if (Auth::check())
                                                <a href={{$offer->page_url}} target="_blank" title="Show More Details">
                                                    <div class="btn btn-primary" onclick="location.href='{{ env('APP_ADDRESS') }}/offers/{{ substr($offer->title, 0, 20) }}/1/1/1/0/10000' ;">Visit offer</div>
                                                </a>
                                            @else
                                                <a href="{{ url('register') }}" title="Register for free to get access to offer">
                                                    <div class="btn btn-primary offerListBtn">Register for free to get access to offer</div>
                                                </a>
                                            @endif
                                        </a>
                                    </div>
                                    <p class="offertDate">Added: {{-- date('Y-m-d H:i:s', strtotime($offer->created_at)) --}} {{ date('d M, Y', strtotime($offer->created_at)) }} </p>
                                    @if($offer->brand == "fly4freeUS")
                                        <a href="https://www.fly4free.com/flight-deals" target="_blank" title="Visit author website"><img src="/img/fly4free.png" class="homePageOfferItemBrandLogo" /></a>
                                    @elseif($offer->brand == "travelPiratesUS")
                                        <a href="https://www.travelpirates.com/flights" target="_blank" title="Visit author website"><img src="/img/travelPiratesLogo.png" class="homePageOfferItemBrandLogo" /></a>
                                    @elseif($offer->brand == "secretFlyingUS")
                                        <a href="https://www.secretflying.com" target="_blank" title="Visit author website"><img src="/img/secretFlyingUS.gif" class="homePageOfferItemBrandLogo" /></a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="offerPagination">
                    {{ $offersList->links('vendor.pagination.default') }}

                    {{ Form::open(array('action' => array('OffersController@paginatorPageResults'), 'class' => 'goToPageForm')) }}
            
                        <div class="form-group goToPageInput">
                            {{ Form::text('page', null, array('class' => 'form-control', 'placeholder' => 'Display page ...')) }}
                        </div>

                        <button type="submit" class="btn paginationSearchBtn">Go</button>

                    {{ Form::close() }}
                </div>

            </div>
    </div>
</div>
@endsection
