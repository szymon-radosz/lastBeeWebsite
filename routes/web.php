<?php

/*Route::get('/', function () {
    return view('home');
});*/

Route::get('home', 'HomeController@index');
Route::get('terms', 'TermsController@index');
Route::get('/', 'HomeController@homePage');

Auth::routes();



