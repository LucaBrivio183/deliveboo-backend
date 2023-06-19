@extends('layouts.app')
@section('content')

<div class="container" id="dashboard-container">
    <!--<img src="{{url('/logo-green.png')}}" alt="logo" id="logo" id="background-image">-->
    <h2 class="fs-4 my-4">
        {{ __('Dashboard utente') }}
    </h2>
    <div class="row justify-content-center align-items-stretch">
        <div class="col-3">
            <div class="card my-3" id="restaurant-container">
                <!--<h3 class="fs-4 my-4">
                    {{ __('Il tuo ristorante') }}
                </h3>-->
                <div class="card-body d-flex flex-wrap justify-content-center align-items-center gap-3">
                    @foreach ($restaurants as $restaurant)
                    <a href="{{ route('admin.restaurants.show', $restaurant->id)}}">
                        <div class="card">
                            <img :src={{$restaurant->image}} class="card-img-top" :alt={{$restaurant->name}}>
                            <div class="card-body">
                                <h5 class="card-title">{{$restaurant->name}}</h5>
                                <span>Indirizzo: {{$restaurant->address}},</span>
                                <span>{{$restaurant->city}}</span>
                                <div>CAP: {{$restaurant->postal_code}},</div>
                                <div>Telefono: +{{$restaurant->phone_number}}</div>
                                <div>Orari: {{$restaurant->business_times}}</div>
                                <span class="badge bg-secondary"></span></h6>
                            </div>
                        </div>
                    </a>
                    @endforeach       
                </div>
            </div> 
        </div>
        <div class="col-9">
            <div class="card my-3" id="products-container">
                <!--<h3 class="fs-4 my-4 mx-6">
                    {{ __('I tuoi prodotti') }}
                </h3>-->
                <div class="card-body d-flex flex-wrap justify-content-center align-items-center gap-3">
                    {{-- element to repeat --}}
                    @foreach ($products as $product)
                    {{-- card --}}
                    <a href="{{ route('admin.products.show', $product) }}">
                        <div class="card" style="width: 18rem;">
                            {{-- image --}}
                            <img src="{{ $product->image }}" class="card-img-top" alt="{{ $product->name }}">
                            <div class="card-body">
                                {{-- name --}}
                                <h5 class="card-title">{{ $product->name }}</h5>
                            </div> 
                        </div>
                    </a>
                    @endforeach
                    {{-- element to repeat --}}
    
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    {{-- {{ __('You are logged in!') }} --}}
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection
