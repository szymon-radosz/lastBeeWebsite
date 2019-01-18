<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Offer;
use Response;
use Auth;

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
}
