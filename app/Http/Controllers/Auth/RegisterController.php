<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Mail\WelcomeMail;
use App\Mail\WelcomeMailPL;
use Illuminate\Support\Facades\Mail;
use Session;


class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'provider' => 'website',
            'password' => Hash::make($data['password']),
            'country' => Session::get('country')
        ]);

        if(Session::get('country') == "PL"){
            Mail::to($data['email'])->send(new WelcomeMailPL($user));
        }else{
            Mail::to($data['email'])->send(new WelcomeMail($user));
        }

        return $user;
    }
}
