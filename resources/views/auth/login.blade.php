@extends('layouts.app')

@section('content')
<div class="container pageContainer">
    <div class="row justify-content-center marginTop">
        <div class="col-md-8">
            <div class="card registerCard">
                
                @if(Session::get('country') == 'PL')
                    <div class="card-header">{{ __('Logowanie') }}</div>
                @else
                    <div class="card-header">{{ __('Login') }}</div>
                @endif 

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                           
                            @if(Session::get('country') == 'PL')
                                <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('Adres e-mail') }}</label>
                            @else
                                <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                            @endif

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            
                            @if(Session::get('country') == 'PL')
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Hasło') }}</label>
                            @else
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                            @endif

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    @if(Session::get('country') == 'PL')
                                        <label class="form-check-label" for="remember">
                                            {{ __('Zapamiętaj mnie') }}
                                        </label>
                                    @else
                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    @endif

                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4 authButtonPanel">
                                

                                @if(Session::get('country') == 'PL' && Route::has('password.request'))
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Zaloguj') }}
                                    </button>

                                    <p class="formOr">lub zaloguj się używając:</p>
                                @else
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>

                                    <p class="formOr">or use</p>
                                @endif

                                <a href="{{ url('api/auth/facebook') }}" class="btn facebookBtn">Facebook</a>
                                <a href="{{ url('api/auth/google') }}" class="btn googleBtn">Google</a>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4 authButtonPanel">
                                
                                @if(Session::get('country') == 'PL' && Route::has('password.request'))
                                    <p>Załóż bezpłatnie konto. <a href="{{ url('register') }}">Rejestracja</a>
                                    <p>Przypomnienie hasła. <a href="{{ route('password.request') }}">Przypomnij</a>
                                @else
                                    <p>Create new account for free <a href="{{ url('register') }}">Sign Up</a>
                                    <p><a href="{{ route('password.request') }}">Forgot your password?</a>
                                @endif

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
