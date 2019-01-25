<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Offer;
use Session;

class VotesController extends Controller
{
    public function store(Request $request){
        $offer_id = $request->vote_id;

        $user = Auth::user();
        
        if($user){
            $user_id = $user->id;

            $offer = Offer::find($offer_id);
    
            $check = DB::table('offer_user')->where('offer_id', $offer_id)->where('user_id', $user_id)->count();
    
            if($check == 0){
                $offer->users()->attach($user_id);
                Session::flash('message', "Thank you. You added a vote.");
            }else{
                Session::flash('message', "You added a vote in the past, but thank you for action.");
            }
        }else{
            Session::flash('message', "You need sign in to add votes.");
        }

        return redirect()->back();
    }
}
