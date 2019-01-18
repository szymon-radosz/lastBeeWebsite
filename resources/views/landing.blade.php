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
                <h1>One place, all <span>travel offers</span> you need.<br /><span>Absolutely for free.</span></h1>

                <div class="landingHeaderSectionBtnSection">
                    <button class="btn loginBtn">Sign In</button>
                    <button class="btn registerBtn">Sign Up</button>
                </div>
            </div>

                <div class="imageAuthorLink">
                    Photo author: <a href="https://www.instagram.com/voros_beni/" target="_blank">Vörös Benjámin</a>
                </div>
        </div>

        <div class="row landingSearchSection">
            <div class="col-sm-12 landingSearchSectionHeaderText">
                <h2 class="">Find offers fit on you</h2>
            </div>

            <div class="row landingSearchSectionBtnOptions">
                <p class="landingSearchSectionHelper">1. Select offers type/types.</p>
                <div class="landingSearchSectionBtnOptionsContainer">
                    <div class="col-sm-4 landingSearchOptionIconContainer">
                        <div class="landingSearchOptionIconWrapper"> 
                            <img src="/img/airplane.png" />
                            <p>Flights</p>
                        </div>
                    </div>

                    <div class="col-sm-4 landingSearchOptionIconContainer">
                        <div class="landingSearchOptionIconWrapper"> 
                            <img src="/img/sunset.png"  />
                            <p>Vacations</p>
                        </div>
                    </div>

                    <div class="col-sm-4 landingSearchOptionIconContainer">
                        <div class="landingSearchOptionIconWrapper"> 
                            <img src="/img/hotel.png" />
                            <p>Hotels</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 landingSearchSectionLocationInput">
                <p class="landingSearchSectionHelper">2. Write down interesting location.</p>
                <div class="form-group">
                    <input type="text" class="form-control" id="usr" placeholder="Location">
                </div>
            </div>

            <div class="col-sm-12 landingSearchSectionSearchBtn">
                <p class="landingSearchSectionHelper">3. Search through all offers.</p>
                <button class="btn landingSearchSectionBtn">Search</button>
            </div>
        </div>

        <div class="row landingHowItWorksSection">
            <div class="col-sm-12 landingHowItWorksSectionHeaderText">
                <h2>How it works?</h2>
            </div>

            <div class="col-sm-8 offset-2 landingHowItWorksSectionDescriptionText">
                <p>Last-bee presents <span>a part of offers from other websites. </span>
                You can search through all offers in one website. 
                <span>Last-bee do not present offers details, we are not offers authors.</span>
                After find interesting offer you can <span>redirect to author website to see details.</span>
                </span>Please enjoy, it's absolutely free.</span></p>
            </div>
        </div>

        <div class="row landingBestOffersSection">
            <div class="col-sm-12 landingBestOffersSectionHeaderText">
                <h2>Today's best offers</h2>
                <p>based on our users</p>
            </div>

            <div class="col-sm-10 offset-1 landingBestOffersSectionRect">
                <div class="row">
                    <div class="col-sm-6 landingBestOffersSectionRectCol">

                        @php 
                            $firstImage = array();
                            preg_match( '/src="([^"]*)"/i', $offersList[0]->img_url, $firstImage ) ;
                        @endphp

                        <div class="fullLandingBestOffersSectionRect" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{$firstImage[1]}}'); ">
                            <h2>{{$offersList[0]->title}}</h2>
                            <p class="fullLandingBestOffersSectionRectDesc">{{$offersList[0]->description}}</p>
                            <img src="/img/heart.png" class="fullLandingBestOffersSectionVoteIcon" />
                            <p class="fullLandingBestOffersSectionVoteCount">{{$offersList[0]->users_count}}</p>
                        </div>
                    </div>

                    <div class="col-sm-6 landingBestOffersSectionRectCol">
                        <div class="row">
                            <div class="col-sm-12 landingBestOffersSectionRectCol">

                                @php 
                                    $secondImage = array();
                                    preg_match( '/src="([^"]*)"/i', $offersList[1]->img_url, $secondImage ) ;
                                @endphp

                                <div class="halfLandingBestOffersSectionRect" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{$secondImage[1]}}'); ">
                                    <h2>{{$offersList[1]->title}}</h2>
                                    <img src="/img/heart.png" class="fullLandingBestOffersSectionVoteIcon" />
                                    <p class="fullLandingBestOffersSectionVoteCount">{{$offersList[1]->users_count}}</p>
                                </div>
                            </div>

                            <div class="col-sm-6 landingBestOffersSectionRectCol">

                                @php 
                                    $thirdImage = array();
                                    preg_match( '/src="([^"]*)"/i', $offersList[2]->img_url, $thirdImage ) ;
                                @endphp

                                <div class="quaterLandingBestOffersSectionRect" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{$thirdImage[1]}}'); ">
                                    <h2>{{$offersList[2]->title}}</h2>
                                    <img src="/img/heart.png" class="fullLandingBestOffersSectionVoteIcon" />
                                    <p class="fullLandingBestOffersSectionVoteCount">{{$offersList[2]->users_count}}</p>
                                </div>
                            </div>

                            <div class="col-sm-6 landingBestOffersSectionRectCol">

                                @php 
                                    $fourthImage = array();
                                    preg_match( '/src="([^"]*)"/i', $offersList[3]->img_url, $fourthImage ) ;
                                @endphp

                                <div class="quaterLandingBestOffersSectionRect" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{$fourthImage[1]}}'); ">
                                    <h2>{{$offersList[3]->title}}</h2>
                                    <img src="/img/heart.png" class="fullLandingBestOffersSectionVoteIcon" />
                                    <p class="fullLandingBestOffersSectionVoteCount">{{$offersList[3]->users_count}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 landingBestOffersSectionSeeAllText">
                <a class="nav-link" href="{{ url('/offers') }}"><p>See all offers</p></a>
            </div>
        </div>
    </div>
</div>
@endsection
