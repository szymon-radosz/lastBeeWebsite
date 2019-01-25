<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Offer;
use Response;
use Auth;
use Input;

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

        $offer = Offer::find($id)
            ->update([
                'title' => $title, 
                'description' => $description, 
                'page_url' => $page_url, 
                'img_url' => $img_url, 
                'brand' => $brand, 
                //'country' => $country, 
                'type' => $type,
                'status' => (int)$status
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

        $location = $request['locationInput'];
        

        //return array($FlightsCheck, $VacationsCheck, $HotelsCheck, $location);

        if($FlightsCheck && $VacationsCheck && $HotelsCheck){
            $offers = Offer::with('users')
            ->where('status', 1)
            ->where('title', 'like', '%' . $location . '%')
            ->orderBy('created_at', 'DESC')
            ->paginate(5);
        }else{
            $offers = Offer::with('users')
            ->where('status', 1)
            ->where('title', 'like', '%' . $location . '%')
            ->when($FlightsCheck, function ($q) {
                $q->where('type', '=', 'Flights');
            })
            ->when($VacationsCheck, function ($q) {
                $q->where('type', '=', 'Vacations');
            })
            ->when($HotelsCheck, function ($q) {
                $q->where('type', '=', 'Accomodation');
            })
            ->when($FlightsCheck && $VacationsCheck, function ($q) {
                $q->where('type', '=', 'Flights')->orWhere('type', '=', 'Vacations');
            })
            ->when($VacationsCheck && $HotelsCheck, function ($q) {
                $q->where('type', '=', 'Vacations')->orWhere('type', '=', 'Accomodation');
            })
            ->when($FlightsCheck && $HotelsCheck, function ($q) {
                $q->where('type', '=', 'Flights')->orWhere('type', '=', 'Accomodation');
            })
            ->orderBy('created_at', 'DESC')
            ->paginate(5);
        }
        

       return view('offers')->with('offersList', $offers);
    }
}
