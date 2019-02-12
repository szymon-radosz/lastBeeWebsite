@extends('layouts.app')

@section('content')
<div class="container homePageContainer">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
            </div>
        </div>

        <div class="row landingHeaderSection" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('/img/lastBeeUS.jpg') no-repeat center center fixed;">
            <div class="col-sm-10 col-xs-10 offset-1">
                @if(Session::get('country') == 'PL')
                    <h1>Wszystkie <span>turystyczne oferty</span> <br />w jednym miejscu.<br /><span>Absolutnie za darmo.</span></h1>
                @else
                    <h1>One place, all <span>travel offers</span> you need.<br /><span>Absolutely for free.</span></h1>
                @endif  

                @if (!Auth::check())
                    @if(Session::get('country') == 'PL')
                        <div class="landingHeaderSectionBtnSection">
                            <a href="{{ url('/login') }}"><button class="btn loginBtn defaultBtn">Logowanie</button></a>
                            <a href="{{ url('/register') }}"><button class="btn registerBtn defaultBtn">Rejestracja</button></a>
                        </div>
                    @else
                        <div class="landingHeaderSectionBtnSection">
                            <a href="{{ url('/login') }}"><button class="btn loginBtn defaultBtn">Sign In</button></a>
                            <a href="{{ url('/register') }}"><button class="btn registerBtn defaultBtn">Sign Up</button></a>
                        </div>
                    @endif  
                @endif
            </div>

              
        </div>

        <div class="row landingSearchSection ">
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
                    <!--<input type="text" class="form-control" id="usr" placeholder="Location">-->

                    

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

        <div class="row landingHowItWorksSection">
            <div class="col-sm-12 landingHowItWorksSectionHeaderText">
                
                @if(Session::get('country') == 'PL')
                    <h2>Jak to działa?</h2>
                @else
                    <h2>How it works?</h2>
                @endif 

            </div>

            <div class="col-sm-8 offset-2 landingHowItWorksSectionDescriptionText">

                @if(Session::get('country') == 'PL')
                    <p>Last-bee prezentuje <span>cześć ofert ze stron naszych partnerów. </span>
                    Możesz przeglądać turystyczne oferty zebrane w jednym miejscu. 
                    <span>Last-bee nie pokazuje szczegółów oferty, nie jesteśmy autorami tych ofert.</span>
                    Po znalezieniu w naszym serwisie interesującej oferty możesz <span>przejść do strony autora w celu zobaczenia szczegółów.</span>
                    </span>Korzystaj z last-bee.com absolutnie za darmo.</span></p>
                @else
                    <p>Last-bee presents <span>a part of offers from other websites. </span>
                    You can search through all offers in one website. 
                    <span>Last-bee do not present offers details, we are not offers authors.</span>
                    After finding interesting offer, you can <span>redirect to author website to see details.</span>
                    </span>Please enjoy, it's absolutely free.</span></p>
                @endif 
                
            </div>
        </div>

        <div class="row landingBestOffersSection">
            <div class="col-sm-12 landingBestOffersSectionHeaderText">
                

                @if(Session::get('country') == 'PL')
                    <h2>Najlepsze oferty</h2>
                    <p>według głosów naszych użytkowników</p>
                @else
                    <h2>Best offers</h2>
                    <p>based on our users votes</p>
                @endif 
            </div>

            <div class="col-sm-10 offset-1 landingBestOffersSectionRect">
                <div class="row ">
                    <div class="col-sm-6 landingBestOffersSectionRectCol landingBestOffersSectionRectLeft">

                        @php 
                            $firstImage = array();
                            preg_match( '/src="([^"]*)"/i', $offersList[0]->img_url, $firstImage ) ;
                        @endphp

                        <div class="fullLandingBestOffersSectionRect" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{$firstImage[1]}}'); ">
                            
                            @if (Auth::check())
                                <a href="{{$offersList[0]->page_url}}" target="_blank" title="Show More Details">    
                                    <h2 onclick="location.href='{{ env('APP_ADDRESS') }}/offers/{{ substr($offersList[0]->title, 0, 20) }}/1/1/1/0/10000' ;">{{$offersList[0]->title}}</h2>
                                </a>
                            @else
                                <h2>{{$offersList[0]->title ? $offersList[0]->title : ""}}</h2>
                            @endif

                            <p class="fullLandingBestOffersSectionRectDesc">{{substr($offersList[0]->description, 0, 300)}} ...</p>
                            <a href="{{ env('APP_ADDRESS') }}/offers/{{ substr($offersList[0]->title, 0, 20) }}/1/1/1/0/10000" target="_blank" title="Vote for that offer">
                                <img src="/img/heart.png" class="fullLandingBestOffersSectionVoteIcon" />
                            </a>
                            <p class="fullLandingBestOffersSectionVoteCount">{{$offersList[0]->users_count ? $offersList[0]->users_count : 0}}</p>
                        </div>
                    </div>

                    <div class="col-sm-6 landingBestOffersSectionRectCol landingBestOffersSectionRectRight">
                       
                            <div class="col-sm-12 landingBestOffersSectionRectCol landingBestOffersSectionRectRightBigRect">

                                @php 
                                    $secondImage = array();
                                    preg_match( '/src="([^"]*)"/i', $offersList[1]->img_url, $secondImage ) ;
                                @endphp

                                <div class="halfLandingBestOffersSectionRect" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{$secondImage[1]}}'); ">
                
                                    @if (Auth::check())
                                        <a href="{{$offersList[0]->page_url}}" target="_blank" title="Show More Details">    
                                            <h2 onclick="location.href='{{ env('APP_ADDRESS') }}/offers/{{ substr($offersList[1]->title, 0, 20) }}/1/1/1/0/10000' ;">{{$offersList[1]->title}}</h2>
                                        </a>
                                    @else
                                        <h2>{{$offersList[1]->title ? $offersList[1]->title : ""}}</h2>
                                    @endif

                                    <a href="{{ env('APP_ADDRESS') }}/offers/{{ substr($offersList[1]->title, 0, 20) }}/1/1/1/0/10000" target="_blank" title="Vote for that offer">
                                        <img src="/img/heart.png" class="fullLandingBestOffersSectionVoteIcon" />
                                    </a>
                                    <p class="fullLandingBestOffersSectionVoteCount">{{$offersList[1]->users_count ? $offersList[1]->users_count : 0}}</p>
                                </div>
                            
                            <div class="row smallOffersRow">
                                <div class="col-sm-6 landingBestOffersSectionRectCol landingBestOffersSectionRectRightSmallRect quaterLandingBestOffersSectionRectLeft">

                                    @php 
                                        $thirdImage = array();
                                        preg_match( '/src="([^"]*)"/i', $offersList[2]->img_url, $thirdImage ) ;
                                    @endphp

                                    <div class="quaterLandingBestOffersSectionRect" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{$thirdImage[1]}}'); ">
                                        
                                        @if (Auth::check())
                                            <a href="{{$offersList[2]->page_url}}" target="_blank" title="Show More Details">    
                                                <h2 onclick="location.href='{{ env('APP_ADDRESS') }}/offers/{{ substr($offersList[2]->title, 0, 20) }}/1/1/1/0/10000' ;">{{$offersList[2]->title}}</h2>
                                            </a>
                                        @else
                                            <h2>{{$offersList[2]->title ? $offersList[2]->title : ""}}</h2>
                                        @endif

                                        <a href="{{ env('APP_ADDRESS') }}/offers/{{ substr($offersList[2]->title, 0, 20) }}/1/1/1/0/10000" target="_blank" title="Vote for that offer">
                                            <img src="/img/heart.png" class="fullLandingBestOffersSectionVoteIcon" />
                                        </a>
                                        <p class="fullLandingBestOffersSectionVoteCount">{{$offersList[2]->users_count ? $offersList[2]->users_count : 0}}</p>
                                    </div>
                                </div>

                                <div class="col-sm-6 landingBestOffersSectionRectCol landingBestOffersSectionRectRightSmallRect quaterLandingBestOffersSectionRectRight">

                                    @php 
                                        $fourthImage = array();
                                        preg_match( '/src="([^"]*)"/i', $offersList[3]->img_url, $fourthImage ) ;
                                    @endphp

                                    <div class="quaterLandingBestOffersSectionRect " style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{$fourthImage[1]}}'); ">
                                
                                        @if (Auth::check())
                                            <a href="{{$offersList[3]->page_url}}" target="_blank" title="Show More Details">    
                                                <h2 onclick="location.href='{{ env('APP_ADDRESS') }}/offers/{{ substr($offersList[3]->title, 0, 20) }}/1/1/1/0/10000' ;">{{$offersList[3]->title}}</h2>
                                            </a>
                                        @else
                                            <h2>{{$offersList[3]->title ? $offersList[3]->title : ""}}</h2>
                                        @endif

                                        <a href="{{ env('APP_ADDRESS') }}/offers/{{ substr($offersList[3]->title, 0, 20) }}/1/1/1/0/10000" target="_blank" title="Vote for that offer">
                                            <img src="/img/heart.png" class="fullLandingBestOffersSectionVoteIcon" />
                                        </a>
                                        <p class="fullLandingBestOffersSectionVoteCount">{{$offersList[3]->users_count ? $offersList[3]->users_count : 0}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 landingBestOffersSectionSeeAllText">
                
                @if(Session::get('country') == 'PL')
                    <a class="nav-link" href="{{ url('/offers') }}"><p>Zobacz wszystkie oferty</p></a>
                @else
                    <a class="nav-link" href="{{ url('/offers') }}"><p>See all offers</p></a>
                @endif 

            </div>
        </div>
    </div>
</div>
@endsection
