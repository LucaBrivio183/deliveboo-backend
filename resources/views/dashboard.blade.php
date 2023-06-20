@extends('layouts.app')
@section('content')

{{-- dashboard container --}}
<div id="dashboard-container">
    <div class="container">
        <h2 class="fs-4 mt-4 mb-2 mx-3">
            {{ __('Dashboard utente') }}
        </h2>
        <div class="row">
            {{-- restaurant column --}}
            <div class="col-3">
                <div class="card my-3" id="restaurant-container">
                    <a href="{{ route('admin.restaurants.index')}}">
                        <h3 class="fs-4 my-4 ms-4">
                        {{ __('Il tuo ristorante') }}
                        </h3>
                    </a>
                </div> 
            </div>
            {{-- /restaurant column --}}
            {{-- products column --}}
            <div class="col-9">
                <div class="card my-3" id="products-container">
                    <a href="{{ route('admin.products.index')}}">
                        <h3 class="fs-4 my-4 ms-4">
                        {{ __('I tuoi prodotti') }}
                        </h3>
                    </a>
                </div>
            </div>
            {{-- /products column --}}
        </div>
    </div>
</div>
{{-- /dashboard container --}}

@endsection
