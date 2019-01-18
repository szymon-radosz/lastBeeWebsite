<?php

/*Route::get('/', function () {
    return view('home');
});*/

Route::get('offers', 'OffersController@index');
Route::get('terms', 'TermsController@index');
Route::get('/', 'HomeController@landingPage');

Auth::routes();



