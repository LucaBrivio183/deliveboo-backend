@extends('layouts.app')
@section('content')

<div id="welcome-container">
    <div class="jumbotron p-5 my-2 rounded-3">
        <div class="container py-5 d-flex justify-content-center" id="welcome-content">
            <div id="content" class="rounded p-5">
                @guest
                <h1 class="text-center text-light p-3 mt-3">Collabora con noi</h1>
                <div class="d-flex justify-content-center align-items-center p-5">
                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg me-3" type="button">{{ __('Login') }}</a>
                    @if (Route::has('register'))
                        <a  href="{{ route('register') }}" class="btn btn-primary btn-lg" type="button">{{ __('Register') }}</a>    
                    @endif
                    @else
                    <div class="text-center text-light">
                        <h1 class="p-5">È un piacere averti qui, <br> {{ Auth::user()->name }}!</h1>

                        @if (auth()->user()->restaurant)
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-primary btn-lg text-center" type="button">{{ __('Dashboard') }}</a>

                        @else
                        <a href="{{ route('admin.restaurants.create') }}" class="btn btn-primary btn-lg text-center" type="button">{{ __('Registra il tuo ristorante') }}</a>
                        @endif
                    </div>
                </div>
                @endguest
            </div>
        </div>
    </div>
    <div id="description">
        <div class="container">
            <p> FlaminGoo è una società Italiana di consegna a domicilio di cibo, fondata online nel 2023 da Vittorio Corradi, Luca Brivio, Eugenia Rossi, Giorgia Galbulli Cavazzini e Vittoria Romano. Opera nella città di Roma e periferia.</p>
        </div>
    </div>
</div>

@endsection