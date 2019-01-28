<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Offer;
use Response;
use Auth;
use Input;
use Redirect;

class OffersController extends Controller
{
    public function index(){
        $offers = Offer::with('users')->where('status', 1)->orderBy('created_at', 'DESC')->paginate(5);

       return view('offers')->with('offersList', $offers);
       //return $offers;
    }

    public function updateOffer(Request $request){
        $id = $request->id;
        $title = $request->title;
        $description = $request->description;
        $page_url = $request->page_url;
        $img_url = $request->img_url;
        $brand = $request->brand;
        //$country = $request->country;
        $type = $request->type;
        $status = $request->status;
        $price = $request->price;
        $currency = $request->currency;

        $offer = Offer::find($id)
            ->update([
                'title' => $title, 
                'description' => $description, 
                'page_url' => $page_url, 
                'img_url' => $img_url, 
                'brand' => $brand, 
                //'country' => $country, 
                'type' => $type,
                'status' => (int)$status,
                'price' => (int)$price,
                'currency' => $currency
            ]);

        return Response::json($offer);
    }

    public function storeOffer(Request $request){
        $title = $request->title;
        $description = $request->description;
        $long_description = $request->long_description;
        $page_url = $request->page_url;
        $img_url = $request->img_url;
        $brand = $request->brand;
        $country = $request->country;
        $type = $request->type;
        $status = $request->status;

        $checkIfOfferExists = Offer::where('page_url', '=', $page_url)->first();

       //var_dump($checkIfOfferExists);

        if(empty($checkIfOfferExists)){
            $offer = new Offer;

            $offer->title = $title;
            $offer->description = $description;
            $offer->long_description = $long_description;
            $offer->page_url = $page_url;
            $offer->img_url = $img_url;
            $offer->brand = $brand;
            $offer->country = $country;
            $offer->type = $type;
            $offer->status = $status;
    
            $offer->save();
    
            return Response::json($offer);
        }else{
            return 1;
        }
    }

    public function findOffers(Request $request){

        //if checkbox checked then value is 1
        $FlightsCheck = $request['FlightsCheck'] ? 1 : 0;
        $VacationsCheck = $request['VacationsCheck'] ? 1 : 0;
        $HotelsCheck = $request['HotelsCheck'] ? 1 : 0;

        $location = $request['locationInput'] ? $request['locationInput'] : 0;

        if(!$location && !$FlightsCheck && !$VacationsCheck && !$HotelsCheck){
            return Redirect::to('offers');
        } else{
            return Redirect::to('offers/' . $location . '/' . $FlightsCheck . '/' . $VacationsCheck . '/' . $HotelsCheck);
        }
    }

    public function OffersWithParameters($location, $FlightsCheck, $VacationsCheck, $HotelsCheck){
       
        //if location exists
        if($location != '0' && $FlightsCheck && !$VacationsCheck && !$HotelsCheck){
            $offers = Offer::with('users')
                                ->where([['status', 1], ['title', 'like', '%' . $location . '%'], ['type', 'Flights']])
                                ->orderBy('created_at', 'DESC')
                                ->paginate(5);

        } else if($location != '0' && !$FlightsCheck && $VacationsCheck && !$HotelsCheck){
            $offers = Offer::with('users')
                                ->where([['status', 1], ['title', 'like', '%' . $location . '%'], ['type', 'Vacations']])
                                ->orderBy('created_at', 'DESC')
                                ->paginate(5);

        }else if($location != '0' && !$FlightsCheck && !$VacationsCheck && $HotelsCheck){
            $offers = Offer::with('users')
                                ->where([['status', 1], ['title', 'like', '%' . $location . '%'], ['type', 'Accomodation']])
                                ->orderBy('created_at', 'DESC')
                                ->paginate(5);

        }else if($location != '0' && $FlightsCheck && $VacationsCheck && !$HotelsCheck){
            $offers = Offer::with('users')
                                ->where([['status', 1], ['title', 'like', '%' . $location . '%'], ['type', 'Flights']])
                                ->orWhere([['status', 1], ['title', 'like', '%' . $location . '%'], ['type', 'Vacations']])
                                ->orderBy('created_at', 'DESC')
                                ->paginate(5);

        }else if($location != '0' && $FlightsCheck && !$VacationsCheck && $HotelsCheck){
            $offers = Offer::with('users')
                                ->where([['status', 1], ['title', 'like', '%' . $location . '%'], ['type', 'Flights']])
                                ->orWhere([['status', 1], ['title', 'like', '%' . $location . '%'], ['type', 'Accomodation']])
                                ->orderBy('created_at', 'DESC')
                                ->paginate(5);
        }
        else if($location != '0' && !$FlightsCheck && $VacationsCheck && $HotelsCheck){
            $offers = Offer::with('users')
                                ->where([['status', 1], ['title', 'like', '%' . $location . '%'], ['type', 'Vacations']])
                                ->orWhere([['status', 1], ['title', 'like', '%' . $location . '%'], ['type', 'Accomodation']])
                                ->orderBy('created_at', 'DESC')
                                ->paginate(5);
        }else if($location != '0' && $FlightsCheck && $VacationsCheck && $HotelsCheck){
            $offers = Offer::with('users')
                                ->where([['status', 1], ['title', 'like', '%' . $location . '%']])
                                ->orderBy('created_at', 'DESC')
                                ->paginate(5);
        }else if($location != '0' && !$FlightsCheck && !$VacationsCheck && !$HotelsCheck){
            $offers = Offer::with('users')
                                ->where([['status', 1], ['title', 'like', '%' . $location . '%']])
                                ->orderBy('created_at', 'DESC')
                                ->paginate(5);
        }
        
        //if location not exists
        else if($location == '0' && $FlightsCheck && !$VacationsCheck && !$HotelsCheck){
            $offers = Offer::with('users')
                                ->where([['status', 1],  ['type', 'Flights']])
                                ->orderBy('created_at', 'DESC')
                                ->paginate(5);

        } else if($location == '0' && !$FlightsCheck && $VacationsCheck && !$HotelsCheck){
            $offers = Offer::with('users')
                                ->where([['status', 1],  ['type', 'Vacations']])
                                ->orderBy('created_at', 'DESC')
                                ->paginate(5);

        }else if($location == '0' && !$FlightsCheck && !$VacationsCheck && $HotelsCheck){
            $offers = Offer::with('users')
                                ->where([['status', 1], ['type', 'Accomodation']])
                                ->orderBy('created_at', 'DESC')
                                ->paginate(5);

        }else if($location == '0' && $FlightsCheck && $VacationsCheck && !$HotelsCheck){
            $offers = Offer::with('users')
                                ->where([['status', 1],  ['type', 'Flights']])
                                ->orWhere([['status', 1], ['type', 'Vacations']])
                                ->orderBy('created_at', 'DESC')
                                ->paginate(5);

        }else if($location == '0' && $FlightsCheck && !$VacationsCheck && $HotelsCheck){
            $offers = Offer::with('users')
                                ->where([['status', 1],  ['type', 'Flights']])
                                ->orWhere([['status', 1],  ['type', 'Accomodation']])
                                ->orderBy('created_at', 'DESC')
                                ->paginate(5);
        }
        else if($location == '0' && !$FlightsCheck && $VacationsCheck && $HotelsCheck){
            $offers = Offer::with('users')
                                ->where([['status', 1],  ['type', 'Vacations']])
                                ->orWhere([['status', 1],  ['type', 'Accomodation']])
                                ->orderBy('created_at', 'DESC')
                                ->paginate(5);
        }else if($location == '0' && $FlightsCheck && $VacationsCheck && $HotelsCheck){
            $offers = Offer::with('users')
                                ->orderBy('created_at', 'DESC')
                                ->paginate(5);
        }else if($location == '0' && !$FlightsCheck && !$VacationsCheck && !$HotelsCheck){
            $offers = Offer::with('users')
                                ->orderBy('created_at', 'DESC')
                                ->paginate(5);
        }

       return view('offers')->with('offersList', $offers);
    }

}
