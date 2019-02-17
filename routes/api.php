<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('auth/{provider}', 'Auth\AuthController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\AuthController@handleProviderCallback');

Route::get('offers','DashboardOffersController@index');

Route::get('/getDailyAddedOffersUSA', 'DashboardController@getDailyAddedOffersUSA');
Route::get('/getDailyAddedOffersUK', 'DashboardController@getDailyAddedOffersUK');
Route::get('/getDailyAddedOffersPL', 'DashboardController@getDailyAddedOffersPL');

Route::post('updateOffer','OffersController@updateOffer');

Route::post('/storeOffer', 'OffersController@storeOffer');

Route::post('/storeVote/:vote_id', 'VotesController@store');