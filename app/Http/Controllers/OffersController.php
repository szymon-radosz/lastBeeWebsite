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
    public function index(Request $request){

        if($request->session()->get('country') == "PL"){
            $offers = Offer::with('users')
                ->where([['status', 1], ['country', 'PL']])
                ->orderBy('created_at', 'DESC')
                ->paginate(5);

        }else if($request->session()->get('country') == "UK"){
            $offers = Offer::with('users')
                ->where([['status', 1], ['country', 'UK']])
                ->orderBy('created_at', 'DESC')
                ->paginate(5);

        }else{
            $offers = Offer::with('users')
                ->where([['status', 1], ['country', 'USA']])
                ->orderBy('created_at', 'DESC')
                ->paginate(5);
        }

       return view('offers')->with('offersList', $offers);
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
        $confirmed_brand = $request->confirmed_brand;

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
                'currency' => $currency,
                'confirmed_brand' => $confirmed_brand
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
        $price = $request->price;
        $currency = $request->currency;
        $confirmed_brand = $request->confirmed_brand;

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
            $offer->price = $price;
            $offer->currency = $currency;
            $offer->confirmed_brand = $confirmed_brand;
    
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

        $lowerPrice = $request['priceRangeSendToFormLower'] ? (int)$request['priceRangeSendToFormLower'] : 0;
        $upperPrice = $request['priceRangeSendToFormUpper'] ? (int)$request['priceRangeSendToFormUpper'] : 3000;

        return Redirect::to('offers/' . $location . '/' . $FlightsCheck . '/' . $VacationsCheck . '/' . $HotelsCheck . '/' . $lowerPrice . '/' . $upperPrice);
    }

    public function paginatorPageResults(Request $request){
        $page = $request['page'];

        // if url contains ? - it means it has additional query like ?page=x
        if(strpos(app('url')->previous(), '?') !== false){
            $previousUrl = substr(app('url')->previous(), 0, strpos(app('url')->previous(), "?"));
        }else{
            $previousUrl = app('url')->previous();
        }
        
        return redirect()->to($previousUrl . '?' . http_build_query(['page'=>$page]));
    }

    public function OffersWithParameters(Request $request, $location, $FlightsCheck, $VacationsCheck, $HotelsCheck, $lowerPrice, $upperPrice){
       
        if($request->session()->get('country') == "PL"){
            $country = "PL";
        }else if($request->session()->get('country') == "UK"){
            $country = "UK";
        }else{
            $country = "USA";
        }
       
        //if location exists
        if($location != '0' && $FlightsCheck && !$VacationsCheck && !$HotelsCheck){
            $offers = Offer::with('users')
                                ->where([
                                    ['status', 1], 
                                    ['title', 'like', '%' . $location . '%'], 
                                    ['type', 'Flights'],
                                    ['country', $country],
                                    ['price', '>=', (int)$lowerPrice],
                                    ['price', '<=', (int)$upperPrice]
                                ])
                                ->orderBy('created_at', 'DESC')
                                ->paginate(5);

        } else if($location != '0' && !$FlightsCheck && $VacationsCheck && !$HotelsCheck){
            $offers = Offer::with('users')
                                ->where([
                                    ['status', 1], 
                                    ['title', 'like', '%' . $location . '%'], 
                                    ['type', 'Vacations'],
                                    ['country', $country],
                                    ['price', '>=', (int)$lowerPrice],
                                    ['price', '<=', (int)$upperPrice]
                                ])
                                ->orderBy('created_at', 'DESC')
                                ->paginate(5);

        }else if($location != '0' && !$FlightsCheck && !$VacationsCheck && $HotelsCheck){
            $offers = Offer::with('users')
                                ->where([
                                    ['status', 1], 
                                    ['title', 'like', '%' . $location . '%'], 
                                    ['type', 'Accomodation'],
                                    ['price', '>=', (int)$lowerPrice],
                                    ['price', '<=', (int)$upperPrice]
                                ])
                                ->orderBy('created_at', 'DESC')
                                ->paginate(5);

        }else if($location != '0' && $FlightsCheck && $VacationsCheck && !$HotelsCheck){
            $offers = Offer::with('users')
                                ->where([
                                    ['status', 1], 
                                    ['title', 'like', '%' . $location . '%'], 
                                    ['type', 'Flights'],
                                    ['country', $country],
                                    ['price', '>=', (int)$lowerPrice],
                                    ['price', '<=', (int)$upperPrice]
                                ])
                                ->orWhere([
                                    ['status', 1], 
                                    ['title', 'like', '%' . $location . '%'], 
                                    ['type', 'Vacations'],
                                    ['country', $country],
                                    ['price', '>=', (int)$lowerPrice],
                                    ['price', '<=', (int)$upperPrice]
                                ])
                                ->orderBy('created_at', 'DESC')
                                ->paginate(5);

        }else if($location != '0' && $FlightsCheck && !$VacationsCheck && $HotelsCheck){
            $offers = Offer::with('users')
                                ->where([
                                    ['status', 1], 
                                    ['title', 'like', '%' . $location . '%'], 
                                    ['type', 'Flights'],
                                    ['country', $country],
                                    ['price', '>=', (int)$lowerPrice],
                                    ['price', '<=', (int)$upperPrice]
                                ])
                                ->orWhere([
                                    ['status', 1], 
                                    ['title', 'like', '%' . $location . '%'], 
                                    ['type', 'Accomodation'],
                                    ['country', $country],
                                    ['price', '>=', (int)$lowerPrice],
                                    ['price', '<=', (int)$upperPrice]
                                ])
                                ->orderBy('created_at', 'DESC')
                                ->paginate(5);
        }
        else if($location != '0' && !$FlightsCheck && $VacationsCheck && $HotelsCheck){
            $offers = Offer::with('users')
                                ->where([
                                    ['status', 1], 
                                    ['title', 'like', '%' . $location . '%'], 
                                    ['type', 'Vacations'],
                                    ['country', $country],
                                    ['price', '>=', (int)$lowerPrice],
                                    ['price', '<=', (int)$upperPrice]
                                ])
                                ->orWhere([
                                    ['status', 1], 
                                    ['title', 'like', '%' . $location . '%'], 
                                    ['type', 'Accomodation'],
                                    ['price', '>=', (int)$lowerPrice],
                                    ['price', '<=', (int)$upperPrice]
                                ])
                                ->orderBy('created_at', 'DESC')
                                ->paginate(5);
        }else if($location != '0' && $FlightsCheck && $VacationsCheck && $HotelsCheck){
            $offers = Offer::with('users')
                                ->where([
                                    ['status', 1], 
                                    ['title', 'like', '%' . $location . '%'],
                                    ['country', $country],
                                    ['price', '>=', (int)$lowerPrice],
                                    ['price', '<=', (int)$upperPrice]
                                ])
                                ->orderBy('created_at', 'DESC')
                                ->paginate(5);
        }else if($location != '0' && !$FlightsCheck && !$VacationsCheck && !$HotelsCheck){
            $offers = Offer::with('users')
                                ->where([
                                    ['status', 1], 
                                    ['title', 'like', '%' . $location . '%'],
                                    ['country', $country],
                                    ['price', '>=', (int)$lowerPrice],
                                    ['price', '<=', (int)$upperPrice]
                                ])
                                ->orderBy('created_at', 'DESC')
                                ->paginate(5);
        }
        
        //if location not exists
        else if($location == '0' && $FlightsCheck && !$VacationsCheck && !$HotelsCheck){
            $offers = Offer::with('users')
                                ->where([
                                    ['status', 1],  
                                    ['type', 'Flights'],
                                    ['country', $country],
                                    ['price', '>=', (int)$lowerPrice],
                                    ['price', '<=', (int)$upperPrice]
                                ])
                                ->orderBy('created_at', 'DESC')
                                ->paginate(5);

        } else if($location == '0' && !$FlightsCheck && $VacationsCheck && !$HotelsCheck){
            $offers = Offer::with('users')
                                ->where([
                                    ['status', 1],
                                    ['type', 'Vacations'],
                                    ['country', $country],
                                    ['price', '>=', (int)$lowerPrice],
                                    ['price', '<=', (int)$upperPrice]
                                ])
                                ->orderBy('created_at', 'DESC')
                                ->paginate(5);

        }else if($location == '0' && !$FlightsCheck && !$VacationsCheck && $HotelsCheck){
            $offers = Offer::with('users')
                                ->where([
                                    ['status', 1], 
                                    ['type', 'Accomodation'],
                                    ['country', $country],
                                    ['price', '>=', (int)$lowerPrice],
                                    ['price', '<=', (int)$upperPrice]
                                ])
                                ->orderBy('created_at', 'DESC')
                                ->paginate(5);

        }else if($location == '0' && $FlightsCheck && $VacationsCheck && !$HotelsCheck){
            $offers = Offer::with('users')
                                ->where([
                                    ['status', 1],
                                    ['type', 'Flights'],
                                    ['country', $country],
                                    ['price', '>=', (int)$lowerPrice],
                                    ['price', '<=', (int)$upperPrice]
                                ])
                                ->orWhere([
                                    ['status', 1], 
                                    ['type', 'Vacations'],
                                    ['country', $country],
                                    ['price', '>=', (int)$lowerPrice],
                                    ['price', '<=', (int)$upperPrice]
                                ])
                                ->orderBy('created_at', 'DESC')
                                ->paginate(5);

        }else if($location == '0' && $FlightsCheck && !$VacationsCheck && $HotelsCheck){
            $offers = Offer::with('users')
                                ->where([
                                    ['status', 1], 
                                    ['type', 'Flights'],
                                    ['country', $country],
                                    ['price', '>=', (int)$lowerPrice],
                                    ['price', '<=', (int)$upperPrice]
                                ])
                                ->orWhere([
                                    ['status', 1], 
                                    ['type', 'Accomodation'],
                                    ['country', $country],
                                    ['price', '>=', (int)$lowerPrice],
                                    ['price', '<=', (int)$upperPrice]
                                ])
                                ->orderBy('created_at', 'DESC')
                                ->paginate(5);
        }
        else if($location == '0' && !$FlightsCheck && $VacationsCheck && $HotelsCheck){
            $offers = Offer::with('users')
                                ->where([
                                    ['status', 1], 
                                    ['type', 'Vacations'],
                                    ['country', $country],
                                    ['price', '>=', (int)$lowerPrice],
                                    ['price', '<=', (int)$upperPrice]
                                ])
                                ->orWhere([
                                    ['status', 1], 
                                    ['type', 'Accomodation'],
                                    ['country', $country],
                                    ['price', '>=', (int)$lowerPrice],
                                    ['price', '<=', (int)$upperPrice]
                                ])
                                ->orderBy('created_at', 'DESC')
                                ->paginate(5);
        }else if($location == '0' && $FlightsCheck && $VacationsCheck && $HotelsCheck){
            $offers = Offer::with('users')
                                ->where([
                                    ['status', 1], 
                                    ['country', $country],
                                    ['price', '>=', (int)$lowerPrice],
                                    ['price', '<=', (int)$upperPrice]
                                ])
                                ->orderBy('created_at', 'DESC')
                                ->paginate(5);
        }else if($location == '0' && !$FlightsCheck && !$VacationsCheck && !$HotelsCheck){
            $offers = Offer::with('users')
                                ->where([
                                    ['status', 1], 
                                    ['country', $country],
                                    ['price', '>=', (int)$lowerPrice],
                                    ['price', '<=', (int)$upperPrice]
                                ])
                                ->orderBy('created_at', 'DESC')
                                ->paginate(5);
        }

       return view('offers')->with('offersList', $offers);
    }

}
