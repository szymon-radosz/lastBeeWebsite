<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Offer;
use Response;

class DashboardOffersController extends Controller
{
    public function index(){
        $offers = Offer::paginate(100);

        return $offers;
    }
}
