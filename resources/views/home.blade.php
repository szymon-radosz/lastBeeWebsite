@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>

                @if($offersList)
                    @foreach ($offersList as $offer)
                        <div class="card homePageOfferItem">
                            <div class="row homePageOfferItemRow">
                                <div class="col-sm-5 homePageOfferItemImage">
                                    <img src={{$offer->img_url}} />
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
                                                        <div class="btn btn-primary">Register for free to get access to offers</div>
                                                    </a>
                                                @endif
                                            </a>
                                        </div>
                                        @if($offer->brand == "fly4freeUS")
                                            <img src="/img/fly4free.png" class="homePageOfferItemBrandLogo" />
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    {{ $offersList->links() }}
                @endif
            </div>
    </div>
</div>
@endsection
