<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class CountryController extends Controller
{
    public function setUSA(){
        session(['country' => 'USA']);
        return redirect()->back();
    }

    public function setUK(){
        session(['country' => 'UK']);
        return redirect()->back();
    }

    public function setAU(){
        session(['country' => 'AU']);
        return redirect()->back();
    }

    public function setPL(){
        session(['country' => 'PL']);
        return redirect()->back();
    }

    public function clearCountry(){
        session()->forget('country');
        return redirect()->back();
    }
}
