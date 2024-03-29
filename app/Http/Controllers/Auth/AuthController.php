<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Socialite;
use App\User;
use Session;
use Redirect;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\WelcomeMail;
use App\Mail\WelcomeMailPL;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    /**
     **_ Redirect the user to the OAuth Provider.
   
     **_ @return Response**/
  
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();

    }

    //Obtain the user information from provider.  Check if the user already exists in our
    //database by looking up their provider_id in the database.
    //If the user exists, log them in. Otherwise, create a new user then log them in. After that 
    //redirect them to the authenticated users homepage.
    
    //@return Response
    
    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();
        $authUser = $this->findOrCreateUser($user, $provider);

        try{
            if($authUser != null){
                try{
                    Auth::login($authUser, true);

                    if(Session::get('country') == "PL"){
                        Session::flash('message', "Miło Cię widzieć.");
                    }else{
                        Session::flash('message', "Nice to see you.");
                    }
                    
                    return Redirect::to('offers');

                }catch(\Exception $e){
                    
                    if(Session::get('country') == "PL"){
                        Session::flash('message', "Problem z autoryzacją.");
                    }else{
                        Session::flash('message', "Problem with authorization.");
                    }

                    return Redirect::to('offers');

                }
                
            }else{
           
                if(Session::get('country') == "PL"){
                    Session::flash('message', "Problem z autoryzacją.");
                }else{
                    Session::flash('message', "Problem with authorization.");
                }

                return Redirect::to('offers');
            }
            
        }catch(\Exception $e){
            Session::flash('message', "Can't sign in a user.");
            return Redirect::to('offers');

        }
    }

    //If a user has registered before using social auth, return the user
    //else, create a new user object.
    //@param  $user Socialite user object
    //@param $provider Social auth provider
    //@return  User
     
    public function findOrCreateUser($user, $provider)
    {
        $authUser = User::where('provider_id', $user->id)->first();

        if ($authUser) {
            return $authUser;
        }

        try{
            Session::flash('message', "Thank you. You created an account. Enjoy.");

            $user = User::create([
                'name'     => $user->name,
                'email'    => $user->email,
                'provider' => $provider,
                'provider_id' => $user->id,
                'country' => Session::get('country')
            ]);

            if(Session::get('country') == "PL"){
                Mail::to($user->email)->send(new WelcomeMailPL($user));
            }else{
                Mail::to($user->email)->send(new WelcomeMail($user));
            }
            
            return $user;

        }catch(\Exception $e){
            Session::flash('message', "Can't sign up a user.");
            return;

        }
        
    }
}