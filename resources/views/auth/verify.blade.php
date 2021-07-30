@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verifica il tuo indirizo mail') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Un nuovo link è stato inviato sul tuo indirizzo mail') }}
                        </div>
                    @endif

                    {{ __('Prima di procedere, inserisci la tua e-mail per il link di verifica.') }}
                    {{ __('Se non hai ricevuto la mail') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('clicca qui per una nuova richiesta') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
