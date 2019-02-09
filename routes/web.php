<?php
Route::get('/', 'HomeController@landingPage');

Route::get('offers', 'OffersController@index');

Route::get('terms', 'TermsController@index');

Route::get('about', 'AboutController@index');

Route::get('privacy-policy', 'PrivacyController@index');

Route::get('customer-support', 'SupportController@index');

//Route::get('/', 'HomeController@landingPage');

Route::post('/offers', 'OffersController@findOffers');

Route::post('/paginatorPageResults', 'OffersController@paginatorPageResults');

Route::get('offers/{locationInput}/{FlightsCheck}/{VacationsCheck}/{HotelsCheck}/{lowerPrice}/{upperPrice}', 'OffersController@OffersWithParameters');

Route::post('/setUSA', 'CountryController@setUSA');
Route::post('/setUK', 'CountryController@setUK');
Route::post('/setAU', 'CountryController@setAU');
Route::post('/setPL', 'CountryController@setPL');
Route::post('/clearCountry', 'CountryController@clearCountry');

Auth::routes();



