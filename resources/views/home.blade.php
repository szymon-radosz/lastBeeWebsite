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

                @foreach ($offersList as $offer)
                    <div class="card homePageOfferItem">
                        <div class="row homePageOfferItemRow">
                            <div class="col-sm-5 homePageOfferItemImage">
                                {!! $offer->img_url !!}
                            </div>
                            <div class="col-sm-7 homePageOfferItemContent">
                                <div>
                                    <h2>{{$offer->title}}</h2>
                                    <p>{{$offer->description}}</p>
                                    <div class="homePageOfferItemBtn">
                                            @if (Auth::check())
                                                <a href={{$offer->page_url}} target="_blank">
                                                    <div class="btn btn-primary">Visit offer</div>
                                                </a>
                                            @else
                                                <a href="{{ url('register') }}">
                                                    <div class="btn btn-primary">Register for free to get access to offer</div>
                                                </a>
                                            @endif
                                        </a>
                                    </div>
                                    <p class="offertDate">Added: {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $offer->date)->format('d M, Y')}}</p>
                                    @if($offer->brand == "fly4freeUS")
                                        <img src="/img/fly4free.png" class="homePageOfferItemBrandLogo" />
                                    @elseif($offer->brand == "travelPiratesUS")
                                        <img src="/img/travelPiratesLogo.jpg" class="homePageOfferItemBrandLogo" />
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
