<?php

/*Route::get('/', function () {
    return view('home');
});*/

Route::get('auth/{provider}', 'Auth\AuthController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\AuthController@handleProviderCallback');

Route::get('offers', 'OffersController@index');

Route::get('terms', 'TermsController@index');

Route::get('about', 'AboutController@index');

Route::get('privacy-policy', 'PrivacyController@index');

Route::get('customer-support', 'SupportController@index');

Route::get('/', 'HomeController@landingPage');

Route::post('/offers', 'OffersController@findOffers');
Route::post('/paginatorPageResults', 'OffersController@paginatorPageResults');


//Route::get('offers/{location}', 'OffersController@OffersWithLocation');
Route::get('offers/{locationInput}/{FlightsCheck}/{VacationsCheck}/{HotelsCheck}', 'OffersController@OffersWithParameters');

Auth::routes();



