<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('offers','DashboardOffersController@index');

Route::get('/getDailyAddedOffers', 'DashboardController@getDailyAddedOffers');

Route::post('updateOffer','OffersController@updateOffer');

Route::post('/storeOffer', 'OffersController@storeOffer');

Route::post('/storeVote/:vote_id', 'VotesController@store');