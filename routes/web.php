<?php

/*Route::get('/', function () {
    return view('home');
});*/

Route::get('offers', 'OffersController@index');

Route::get('terms', 'TermsController@index');

Route::get('about', 'AboutController@index');

Route::get('privacy-policy', 'PrivacyController@index');

Route::get('customer-support', 'SupportController@index');

Route::get('/', 'HomeController@landingPage');

Route::post('/offers', 'OffersController@findOffers');

Auth::routes();



