@extends('layouts.auth')

@push('styles')
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="mx-auto p-3 login-box">
    <div class="row justify-content-center">
            <img src="../img/logo.png" height="218" width="200" alt="Rasende Rüben" hspace="50" vspace="50">
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <div class="col">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="E-Mail" required autocomplete="email" autofocus>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror 
                </div>  
            </div>

            <div class="form-group">
                <div class="col">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Passwort" required autocomplete="current-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row justify-content-center">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                    <label class="form-check-label" for="remember">
                        {{ __('Angemeldet bleiben') }}
                    </label>
                </div>
            </div>

            <div class="form-group row justify-content-center">
                <button type="submit" class="btn m-1">
                    {{ __('Anmelden') }}
                </button>
                <button type="submit" class="btn m-1">
                    <a href="{{ route('register') }}">
                        {{ __('Registrieren') }}
                    </a>
                </button>
            </div>

            <div class="form-group row justify-content-center">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">
                        {{ __('Passwort vergessen?') }}
                    </a>
                @endif
            </div>
        </form>
    </div>
</div>
@endsection
