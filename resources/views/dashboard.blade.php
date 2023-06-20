@extends('layouts.app')
@section('content')

{{-- dashboard container --}}
<div id="dashboard-container">
    <div class="container">
        <h2 class="fs-4 mt-4 mb-2 mx-3">
            {{ __('Dashboard utente') }}
        </h2>
        {{-- Show columns if user has a restaurant --}}
        @if($restaurant)
        <div class="row">
            {{-- restaurant column --}}
            <div class="col-3">
                <div class="card my-3" id="restaurant-container">
                    <h3 class="fs-4 my-4 ms-4">
                        {{ __('Il tuo ristorante') }}
                    </h3>
                    <div class="card-body d-flex flex-wrap justify-content-center align-items-center gap-3">
                        {{-- element to repeat --}}
                        {{-- @foreach ($restaurants as $restaurant) --}}
                        <a href="{{ route('admin.restaurants.show', $restaurant->id)}}">
                            {{-- card --}}
                            <div class="card">
                                {{-- image --}}
                                <img :src={{$restaurant->image}} class="card-img-top" :alt={{$restaurant->name}}>
                                {{-- restaurant card body --}}
                                <div class="card-body">
                                    <h5 class="card-title">{{$restaurant->name}}</h5>
                                    <span>Indirizzo: {{$restaurant->address}},</span>
                                    <span>{{$restaurant->city}}</span>
                                    <div>CAP: {{$restaurant->postal_code}}</div>
                                    <div>Telefono: +{{$restaurant->phone_number}}</div>
                                    <div>Orari: {{$restaurant->business_times}}</div>
                                    <span class="badge bg-secondary"></span></h6>
                                </div>
                            </div>
                            {{-- /card --}}
                        </a>
                        {{-- @endforeach --}}
                        {{-- /element to repeat --}}  
                    </div>
                </div> 
            </div>
            {{-- /restaurant column --}}
            
            {{-- products column --}}
            <div class="col-9">
                <div class="card my-3" id="products-container">
                    <h3 class="fs-4 my-4 ms-5">
                        {{ __('I tuoi prodotti') }}
                    </h3>
                    <div id="product-cards-container" class="card-body d-flex flex-wrap justify-content-center align-items-stretch gap-3">
                        {{-- element to repeat --}}
                        @foreach ($products as $product)
                        <a href="{{ route('admin.products.show', $product) }}">
                            {{-- card --}}
                            <div class="card" style="width: 18rem;">
                                {{-- image --}}
                                @if ($product->image)
                                    <img src="{{ $product->image }}" alt="{{ $product->name }}" class="my-3">
                                @endif
                                <div class="card-body">
                                    {{-- name --}}
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                </div> 
                            </div>
                            {{-- /card --}}
                        </a>
                        @endforeach
                        {{-- /element to repeat --}}
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif
                        {{-- {{ __('You are logged in!') }} --}}
                    </div>
                </div>
            </div>
            {{-- /products column --}}
        </div>
        @endif
        {{-- /Show columns if user has a restaurant --}}
    </div>
</div>
{{-- /dashboard container --}}

@endsection