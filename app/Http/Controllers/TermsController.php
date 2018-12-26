<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class termsController extends Controller
{
    public function index()
    {
        return view('terms');
    }
}
