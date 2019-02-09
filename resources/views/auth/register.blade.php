@extends('layouts.app')

@section('content')
<div class="container pageContainer" >
    <div class="row justify-content-center marginTop">
        <div class="col-md-8">
            <div class="card registerCard">

                @if(Session::get('country') == 'PL')
                    <div class="card-header">{{ __('Rejestracja') }}</div>
                @else
                    <div class="card-header">{{ __('Register') }}</div>
                @endif 

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                        
                            @if(Session::get('country') == 'PL')
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nazwa użytkownika') }}</label>
                            @else
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                            @endif

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            
                            @if(Session::get('country') == 'PL')
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Adres e-mail') }}</label>
                            @else
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                            @endif

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

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
                            
                            @if(Session::get('country') == 'PL')
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Potwierdź hasło') }}</label>
                            @else
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                            @endif

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            
                            @if(Session::get('country') == 'PL')
                                <div class="col-md-8 offset-md-4 authButtonPanel">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Załóż konto') }}
                                    </button>

                                    <p class="formOr">lub zarejestruj się używając:</p>

                                    <a href="{{ url('api/auth/facebook') }}" class="btn facebookBtn">Facebook</a>
                                    <a href="{{ url('api/auth/google') }}" class="btn googleBtn">Google</a>
                                </div>
                            @else
                                <div class="col-md-8 offset-md-4 authButtonPanel">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>

                                    <p class="formOr">or use</p>

                                    <a href="{{ url('api/auth/facebook') }}" class="btn facebookBtn">Facebook</a>
                                    <a href="{{ url('api/auth/google') }}" class="btn googleBtn">Google</a>
                                </div>
                            @endif

                        </div>

                        <div class="form-group row mb-0">
                            
                            @if(Session::get('country') == 'PL')
                                <div class="col-md-6 offset-md-4">
                                    <p>Masz juź konto? <a href="{{ url('login') }}">Zaloguj się</a>
                                    <p>Rejestrując się akceptujesz naszą <a href="{{ url('privacy-policy') }}">politykę prywatności</a>
                                </div>
                            @else
                                <div class="col-md-6 offset-md-4">
                                    <p>Already have an account? <a href="{{ url('login') }}">Sign In</a>
                                    <p>By signing up you accept our <a href="{{ url('privacy-policy') }}">Privacy Policy</a>
                                </div>
                            @endif
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
