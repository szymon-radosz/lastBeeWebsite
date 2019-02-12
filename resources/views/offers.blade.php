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
                @if(Session::get('country') == 'PL')
                    <h2>Znajdź oferty dla siebie</h2>
                @else
                    <h2>Find offers fit for you</h2>
                @endif  

            </div>

            {{ Form::open(array('action' => array('OffersController@findOffers'))) }}
            <div class="row landingSearchSectionBtnOptions">
                @if(Session::get('country') == 'PL')
                    <p class="landingSearchSectionHelper">1. Wybierz kategorie</p>
                @else
                    <p class="landingSearchSectionHelper">1. Select category</p>
                @endif 

                <div class="landingSearchSectionBtnOptionsContainer">

                    <div class="landingSearchCheckboxes">
                        {{ Form::checkbox('FlightsCheck', null, null, array('id' => 'FlightsCheckId')) }} 
                        {{ Form::checkbox('VacationsCheck', null, null, array('id' => 'VacationsCheckId')) }} 
                        {{ Form::checkbox('HotelsCheck', null, null, array('id' => 'HotelsCheckId')) }} 
                    </div>

                    <div class="col-sm-4 landingSearchOptionIconContainer" id="FlightRectLanding">
                        <div class="landingSearchOptionIconWrapper"> 
                            <img src="/img/airplane.png" />
                            
                                @if(Session::get('country') == 'PL')
                                    <p>Loty</p>
                                @else
                                    <p>Flights</p>
                                @endif 
                        </div>
                    </div>

                    <div class="col-sm-4 landingSearchOptionIconContainer" id="VacationsRectLanding">
                        <div class="landingSearchOptionIconWrapper"> 
                            <img src="/img/sunset.png"/>

                                @if(Session::get('country') == 'PL')
                                    <p>Wakacje</p>
                                @else
                                    <p>Vacations</p>
                                @endif 
                        </div>
                    </div>

                    <div class="col-sm-4 landingSearchOptionIconContainer" id="HotelsRectLanding">
                        <div class="landingSearchOptionIconWrapper"> 
                            <img src="/img/hotel.png" />
                            
                                @if(Session::get('country') == 'PL')
                                    <p>Hotele</p>
                                @else
                                    <p>Hotels</p>
                                @endif 
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 landingSearchSectionLocationInput">
               
                    @if(Session::get('country') == 'PL')
                        <p class="landingSearchSectionHelper">2. Napisz interesującą Ciebie lokalizację (opcjonalnie)</p>
                    @else
                        <p class="landingSearchSectionHelper">2. Write down interesting location (optional)</p>
                    @endif 
                <div class="form-group">

                    @if(Session::get('country') == 'PL')
                        {{ Form::text('locationInput', null, array('class' => 'form-control', 'placeholder' => 'Lokalizacja')) }}
                    @else
                        {{ Form::text('locationInput', null, array('class' => 'form-control', 'placeholder' => 'Location')) }}
                    @endif 

                </div>
            </div>

            <div class="col-sm-12 landingSearchSectionLocationInput">
            

            @if(Session::get('country') == 'PL')
                <p class="landingSearchSectionHelper">3. Wybierz przedział cenowy</p>
            @else
                <p class="landingSearchSectionHelper">3. Select interesting price range</p>
            @endif 

            <div class="form-group">
                <div id="rangeSlider"></div>

                <div class="priceRange priceRangeTop">
                    @if(Session::get('country') == 'PL')
                        <p class="rangeHeader">Od: </p>
                        <div id="priceRangeSendDisplayOnViewLower"></div>
                        <p>zł</p>
                    @elseif(Session::get('country') == 'UK')
                        <p class="rangeHeader">From: </p>
                        <p>£</p>
                        <div id="priceRangeSendDisplayOnViewLower"></div>
                    @else
                        <p class="rangeHeader">From: </p>
                        <div id="priceRangeSendDisplayOnViewLower"></div>
                        <p>$</p>
                    @endif 
                    
                    {{ Form::text('priceRangeSendToFormLower', '100', array('id' => 'priceRangeSendToFormLower')) }}
                </div>
                <div class="priceRange">
                    
                    @if(Session::get('country') == 'PL')
                        <p class="rangeHeader">Do: </p>
                        <div id="priceRangeSendDisplayOnViewUpper"></div>
                        <p>zł</p>
                    @elseif(Session::get('country') == 'UK')
                        <p class="rangeHeader">To: </p>
                        <p>£</p>
                        <div id="priceRangeSendDisplayOnViewUpper"></div>
                    @else
                        <p class="rangeHeader">To: </p>
                        <div id="priceRangeSendDisplayOnViewUpper"></div>
                        <p>$</p>
                    @endif 

                    {{ Form::text('priceRangeSendToFormUpper', '3000', array('id' => 'priceRangeSendToFormUpper')) }}
                </div>

            </div>
        </div>

        <div class="col-sm-12 landingSearchSectionSearchBtn">
            <!--<p class="landingSearchSectionHelper">4. Search through all offers.</p>-->

            @if(Session::get('country') == 'PL')
                <button type="submit" class="btn landingSearchSectionBtn">Szukaj</button>
            @else
                <button type="submit" class="btn landingSearchSectionBtn">Search</button>
            @endif 

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
                                    <img src="/img/airplane-white.png" alt="Flights"/>
                                </div>
                                <a href="{{ env('APP_ADDRESS') }}/offers/0/1/0/0/0/10000" target="_blank" title="Show Flights Offers">
        
                                    @if(Session::get('country') == 'PL')
                                        <p>Loty</p>
                                    @else
                                        <p>Flights</p>
                                    @endif 

                                </a>
                            </div>
                        @elseif($offer->type == "Vacations")
                            <div class="OfferType OfferTypeVacations">
                                <div class="imageContainer">
                                    <img src="/img/sunset.png" alt="Vacations"/>
                                </div>
                                <a href="{{ env('APP_ADDRESS') }}/offers/0/0/1/0/0/10000" target="_blank" title="Show Vacations Offers">
                                    
                                    @if(Session::get('country') == 'PL')
                                        <p>Wakacje</p>
                                    @else
                                        <p>Vacations</p>
                                    @endif 

                                </a>
                            </div>
                        @elseif($offer->type == "Accomodation")
                            <div class="OfferType OfferTypeAccomodation">
                                <div class="imageContainer">
                                    <img src="/img/hotel-white.png" alt="Accomodation"/>
                                </div>
                                <a href="{{ env('APP_ADDRESS') }}/offers/0/0/0/1/0/10000" target="_blank" title="Show Hotels Offers">
                                    
                                    @if(Session::get('country') == 'PL')
                                        <p>Hotele</p>
                                    @else
                                        <p>Hotels</p>
                                    @endif 

                                </a>
                            </div>
                        @endif

                        <div class="OfferVoteContainer">

                            {{ Form::open(array('action' => array('VotesController@store', 'vote_id' => $offer->id))) }}
                                <div class="imgContainer">
                                    <button type="submit" title="Vote for that offer"><img src="/img/heart.png" alt="Add vote"/></button>
                                </div>
                            {{ Form::close() }}

                            @if(Session::get('country') == 'PL' && count($offer->users) == 0)
                                <p>{{count($offer->users)}} głosów</p>
                            @elseif(Session::get('country') == 'PL' && count($offer->users) == 1)
                                <p>{{count($offer->users)}} głos</p>
                            @elseif(Session::get('country') == 'PL')
                                <p>{{count($offer->users)}} głosy</p>
                            @else
                                <p>{{count($offer->users)}} votes</p>
                            @endif 
                        </div>

                        <div class="row homePageOfferItemRow">
                            <div class="col-sm-5 homePageOfferItemImage">
                                {!! $offer->img_url !!}
                            </div>
                            <div class="col-sm-7 homePageOfferItemContent">
                                <div>
                                    @if (Auth::check())
                                        <a href={{$offer->page_url}} target="_blank" title="Show More Details">
                                            <h2 class="offerTitle">{{$offer->title}}</h2>
                                        </a>
                                    @else 
                                        <h2 class="offerTitle">{{$offer->title}}</h2>
                                    @endif
                                    <p class="offerDescription">{{substr($offer->description, 0, 210)}} ...</p>
                                    <div class="homePageOfferItemBtn">

                                        @if(Session::get('country') == 'PL' && Auth::check())
                                            <a href={{$offer->page_url}} target="_blank" title="Pokaż szczegóły">
                                                <div class="btn btn-primary defaultBtn">Pokaż szczegóły</div>
                                            </a>
                                        @elseif (Auth::check())
                                            <a href={{$offer->page_url}} target="_blank" title="Show More Details">
                                                <div class="btn btn-primary defaultBtn">Visit offer</div>
                                            </a>
                                        @elseif (Session::get('country') == 'PL' && !Auth::check())
                                            <a href="{{ url('register') }}" title="Zarejestruj konto za darmo i zobacz ofertę">
                                                <div class="btn btn-primary offerListBtn defaultBtn">Zarejestruj się i zobacz ofertę</div>
                                            </a>
                                        @elseif (!Auth::check())
                                            <a href="{{ url('register') }}" title="Register to get access to offer">
                                                <div class="btn btn-primary offerListBtn defaultBtn">Register to get access to offer</div>
                                            </a>
                                        @endif 
               
                                    </div>

                                    @if(Session::get('country') == 'PL')
                                        <p class="offertDate">Dodano: {{ date('d.m.Y', strtotime($offer->created_at)) }} r.</p>
                                    @else
                                        <p class="offertDate">Added: {{ date('d M, Y', strtotime($offer->created_at)) }} </p>
                                    @endif 
                                    
                                    @if($offer->brand == "fly4freeUS")
                                        <a href="https://www.fly4free.com/flights/flight-deals/usa/" target="_blank" title="Visit author website"><img src="/img/fly4free.png" class="homePageOfferItemBrandLogo" /></a>
                                    @elseif($offer->brand == "fly4freeUK")
                                        <a href="https://www.fly4free.com/flight-deals/uk/" target="_blank" title="Visit author website"><img src="/img/fly4free.png" class="homePageOfferItemBrandLogo" /></a>
                                    @elseif($offer->brand == "fly4freePL")
                                        <a href="https://www.fly4free.pl/" target="_blank" title="Odwiedź stronę po więcej szczegółów"><img src="/img/fly4free.png" class="homePageOfferItemBrandLogo" /></a>
                                    @elseif($offer->brand == "travelPiratesUS")
                                        <a href="https://www.travelpirates.com/?utm_medium=internal&utm_source=travelpirates.com&utm_campaign=nondeal_header" target="_blank" title="Visit author website"><img src="/img/travelPiratesLogo.png" class="homePageOfferItemBrandLogo" /></a>
                                    @elseif($offer->brand == "travelPiratesUK")
                                        <a href="https://www.holidaypirates.com/?utm_medium=internal&utm_source=travelpirates.com&utm_campaign=nondeal_header" target="_blank" title="Visit author website"><img src="/img/travelPiratesLogo.png" class="homePageOfferItemBrandLogo" /></a>
                                    @elseif($offer->brand == "travelPiratesPL")
                                        <a href="https://www.wakacyjnipiraci.pl/?utm_medium=internal&utm_source=holidaypirates.com&utm_campaign=nondeal_header" target="_blank" title="Odwiedź stronę po więcej szczegółów"><img src="/img/wakacyjniPiraci.png" class="homePageOfferItemBrandLogo" /></a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="offerPagination">
                    {{ $offersList->links('vendor.pagination.default') }}

                    {{ Form::open(array('action' => array('OffersController@paginatorPageResults'), 'class' => 'goToPageForm')) }}
            
                        @if(Session::get('country') == 'PL')
                            <div class="form-group goToPageInput">
                                {{ Form::text('page', null, array('class' => 'form-control', 'placeholder' => 'Numer strony ...')) }}
                            </div>

                            <button type="submit" class="btn paginationSearchBtn defaultBtn">Przejdź</button>
                        @else
                            <div class="form-group goToPageInput">
                                {{ Form::text('page', null, array('class' => 'form-control', 'placeholder' => 'Page number ...')) }}
                            </div>

                            <button type="submit" class="btn paginationSearchBtn defaultBtn">Go</button>
                        @endif 

                    {{ Form::close() }}
                </div>

            </div>
    </div>
</div>
@endsection
