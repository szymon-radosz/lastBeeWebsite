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

    public function landingPage(Request $request){
        if($request->session()->get('country') == "PL"){
            $offers = Offer::withCount('users')
                ->where([['status', 1], ['country', 'PL']])
                ->orderBy('users_count', 'desc')
                ->take(4)
                ->get();
        }else if($request->session()->get('country') == "UK"){
            $offers = Offer::withCount('users')
                ->where([['status', 1], ['country', 'UK']])
                ->orderBy('users_count', 'desc')
                ->take(4)
                ->get();
        }else{
            $offers = Offer::withCount('users')
                ->where([['status', 1], ['country', 'USA']])
                ->orderBy('users_count', 'desc')
                ->take(4)
                ->get();
        }

        return view('landing')->with('offersList', $offers);
    }
}
