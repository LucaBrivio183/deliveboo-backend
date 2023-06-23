@extends('layouts.app')
@section('content')
{{-- dashboard container --}}
<div id="dashboard-container">
    <div class="container p-3">
        <h2 class="fs-3 mt-4 mx-3 pb-3">
            {{ __('Dashboard utente') }}
        </h2>
        <div class="row align-items-center">
            {{-- restaurant column --}}
            <div class="col-4">
                <div class="card h-100" id="restaurant-container">
                    <a class="" href="{{ route('admin.restaurants.index')}}">
                        <div class="pt-4 px-4 pb-3">
                            <div class="card-img-top pb-2">
                                <img class="w-100 rounded" src="https://logowik.com/content/uploads/images/310_burgerking.jpg" alt="">
                            </div>
                            <h3 class="fs-3 mt-2">
                            {{ __('Il tuo ristorante') }}
                            </h3>
                        </div>
                    </a>
                </div> 
            </div>
            {{-- /restaurant column --}}
            {{-- products column --}}
            <div class="col-8">
                @if($products->isNotEmpty())
                <div class="card h-100" id="products-container">
                    <a href="{{ route('admin.products.index')}}">
                        <div class="pt-4 px-4 pb-3">
                            <div class="product-images row">
                                @foreach ($products as $product)
                                    <div class="col-4 product-image px-3">
                                        <img src="{{ $product->image }}" class="h-100 w-100 rounded mb-2" alt="{{ $product->name }}">
                                        <div class="fw-bold fst-italic dashboard-products-name">{{ $product->name }}</div>
                                    </div>
                                @endforeach
                            </div>
                            <h3 class="fs-3 mt-5 px-1 pt-3">
                            {{ __('I tuoi prodotti') }}
                            </h3>
                        </div>
                    </a>
                </div>
                @else
                <a href="{{ route('admin.products.index')}}">
                    <div class="card mt-4" id="products-container">
                        <h3 class="text-center p-4">Aggiungi dei prodotti al tuo ristorante!</h3>
                    </div>
                </a>
                @endif
            </div>
            {{-- /products column --}}
        </div>
    </div>
</div>
{{-- /dashboard container --}}

@endsection
