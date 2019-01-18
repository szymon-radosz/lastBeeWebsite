<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Offer;

class HomeController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function index()
    {
        return view('offers');
    }

    public function offerPage(){
        $fly4freeUS = DB::table('fly4freeUS');
        $travelpiratesus = DB::table('travelpiratesus')->union($fly4freeUS)->orderBy('date', 'DESC')->paginate(5);

        return view('offers')->with('offersList', $travelpiratesus);
    }

    public function landingPage(){
        $offers = Offer::withCount('users')->where('status', 1)->orderBy('users_count', 'desc')->take(4)->get();

        return view('landing')->with('offersList', $offers);
        //return $offers;
    }
}
