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
        $offers = DB::table('fly4free')->paginate(5);

        //var_dump($offers);

        return view('home')->with('offersList', $offers);
    }
}
