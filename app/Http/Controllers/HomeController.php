<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function index()
    {
        return view('home');
    }

    public function homePage(){
        $fly4freeUS = DB::table('fly4freeUS');
        $travelpiratesus = DB::table('travelpiratesus')->union($fly4freeUS)->orderBy('date', 'DESC')->paginate(5);

        return view('home')->with('offersList', $travelpiratesus);
    }
}
