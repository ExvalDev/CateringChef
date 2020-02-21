@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Bestätigen Sie ihre Email-Adresse') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Ein neuer Bestätigungslink wurde versendet') }}
                        </div>
                    @endif

                    {{ __('Bevor Sie fortfahren:') }}<br>
                    {{ __(' Bitte überprüfen Sie ihre E-Mails auf einen Bestätigungslink.') }}
                    {{ __('Falls Sie keine E-Mail erhalten haben') }}
                    <form class="d-flex" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn mt-2 align-baseline mx-auto">{{ __('klicken Sie bitte hier') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
