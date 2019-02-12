@extends('layouts.app')

@section('content')
<div class="container pageContainer">
    <div class="row justify-content-center marginTop">
        <div class="col-md-8">
            <div class="card">
                
                @if(Session::get('country') == 'PL')
                    <div class="card-header">{{ __('Resetuj Hasło') }}</div>
                @else
                    <div class="card-header">{{ __('Reset Password') }}</div>
                @endif 

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group row">

                            @if(Session::get('country') == 'PL')
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                            @else
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                            @endif 

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" required autofocus>

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
                            <div class="col-md-6 offset-md-4 authButtonPanel">
                                

                                @if(Session::get('country') == 'PL')
                                    <button type="submit" class="btn btn-primary defaultBtn">
                                        {{ __('Resetuj hasło') }}
                                    </button>
                                @else
                                    <button type="submit" class="btn btn-primary defaultBtn">
                                        {{ __('Reset Password') }}
                                    </button>
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
