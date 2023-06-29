@extends('layouts.app')
@section('content')
{{-- dashboard container --}}
<div class="container mb-3">
        <h2 class="fs-3 mt-4 mx-3 pb-3">
            {{ __('Dashboard utente') }}
        </h2>     
</div>
    {{-- Restaurant --}}
    <div class="">
        {{-- restaurant container --}}
        <div class="card ms-restaurant-card ">
            {{-- Card Body --}}
            <div class="card-body row">
                    {{-- Restaurant image --}}
                    <div class="col-5 dashboard-image-container">
                        <img src={{ $restaurant->image }} class="card-img-top rounded-3 h-100 w-100" alt={{$restaurant->name}}> 
                    </div>
                    {{-- Restaurant info --}}
                    <div class="col-7 text-start">
                        {{-- Name --}}
                        <h1 class="card-title fs-2 mb-2">{{$restaurant->name}}</h1>
                        {{-- Vat Number --}}
                        <div>Partita IVA: {{$restaurant->vat_number}}</div>
                        {{-- Address --}}
                        <span>Indirizzo: {{$restaurant->address}},</span>
                        {{-- Postal Code --}}
                        @if($restaurant->postal_code)
                            <span>
                                {{$restaurant->postal_code}},
                            </span>
                        @endif
                        {{-- City --}}
                        <span>{{$restaurant->city}}</span>
                        {{-- Phone Number --}}
                        <div>Numero di telefono: +{{$restaurant->phone_number}}</div>
                        {{-- Business Times --}}
                        @if($restaurant->business_times)
                            <div>
                                Orari: {{$restaurant->business_times}}
                            </div>
                        @endif
                        {{-- Delivery Cost --}}
                        @if($restaurant->delivery_cost == 0)
                            <div>
                                Consegna gratuita
                            </div>
                        @else
                            <div>
                                Costo di consegna: {{$restaurant->delivery_cost}}€
                            </div>
                        @endif
                        {{-- Minimum Purchase --}}
                        @if($restaurant->min_purchase != 0)
                            <div>
                                Minimo importo di acquisto: {{$restaurant->min_purchase}}€
                            </div>
                        @endif
                        {{-- Typologies --}}
                        <div class="mb-2">Tipologie: 
                            {{ $restaurant->typologies->implode('name', ', ') }}
                        </div>
                    </div>
                    {{-- Edit and delete buttons --}}
                    <div class="d-flex justify-content-center align-items-center my-3 pe-5">
                        {{-- Edit link --}}
                        <a href="{{ route('admin.restaurants.edit', $restaurant->id) }}" class="btn btn-warning btn-sm me-2 p-2 m-1">Modifica ristorante</a>
                        {{-- button trigger delete modal --}}
                        <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#restaurant-{{ $restaurant->id }}">Elimina</a>
                    </div>
                        {{-- delete modal --}}
                    <div class="modal fade" id="restaurant-{{ $restaurant->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">ATTENZIONE!</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Sei sicuro di voler eliminare il prodotto <strong>{{ $restaurant->name }}</strong>?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                            <form action="{{ route('admin.restaurants.destroy', $restaurant) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger my-1">Elimina</button>
                            </form>
                    </div>
                        {{-- /delete modal --}}
            </div>
        </div>
        
        {{-- /restaurant container --}}
    </div>
    {{-- / Restaurants --}}
    {{-- Product --}}
        {{-- products container --}}
            <div class="d-flex justify-content-between align-items-center my-4">
                <h2 id="products-list">Lista prodotti</h2>
                <a href="{{ route('admin.products.create') }}" class="btn btn-outline-primary fs-6">+</a>
            </div>
            {{-- message --}}
            @include('partials.message')
            {{-- row --}}  
            {{-- products table--}}
            <table class="table table-hover table-light w-100">
                <tbody>
                    <thead>
                        <tr>
                            <th scope="col" class="col-8">Prodotto</th>
                            <th scope="col" class="col">Prezzo</th>
                            <th scope="col" class="col-1">Azioni</th>
                        </tr>
                    </thead>
                    @foreach ($products as $product)
                        <tr onclick="window.location='{{route('admin.products.show', $product)}}'" style="cursor: pointer">
                            <td class="text-start">
                                <span class="me-2"><i class="fa-solid {{ ($product->is_visible) ? 'fa-eye text-success' : 'fa-eye-slash text-danger' }}"></i></span>
                                {{ $product->name }}
                            </td>
                            <td>
                                {{ $product->price }} € 
                            </td>
                            <td>
                                {{-- stopPropagation in order to disable onclick event --}}
                                <div onclick="event.stopPropagation()" class="d-flex">
                                    <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-warning btn-sm m-1"><i class="fa-solid fa-pen-to-square"></i></a>
                                        {{-- button trigger delete modal --}}
                                    <a href="#" class="btn btn-danger btn-sm m-1" data-bs-toggle="modal" data-bs-target="#product-{{ $product->id }}"> <i class="fa-solid fa-trash text-black"></i></a>                                      
                                </div>
                            </td>
                        </tr>        
                        {{-- delete modal --}}
                        <div class="modal fade" id="product-{{ $product->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">ATTENZIONE!</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Sei sicuro di voler eliminare il prodotto <strong>{{ $product->name }}</strong>?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger my-1">Elimina</button>
                            </form>
                        </div>
                        {{-- /delete modal --}}
                    @endforeach
                </tbody>
            </table>
            {{-- /products table--}}
            {{-- /row --}}
        {{-- / products container --}}
    {{-- / Products --}}  
</div>
{{-- /dashboard container --}}
@endsection
