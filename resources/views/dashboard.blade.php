@extends('layouts.app')
@section('content')
{{-- dashboard container --}}
<div id="dashboard-container">
    <h2 class="fs-3 mt-4 mx-3 pb-3">
        {{ __('Dashboard utente') }}
    </h2>
    {{-- Restaurant --}}
    <div class="row align-items-center">
        {{-- restaurant container --}}
        <div id="restaurant-show-container" class="container-fluid p-5 text-center">
            <div class="card ms-restaurant-card px-2 pt-2 d-flex flex-column align-items-center">
                {{-- Card Body --}}
                <div class="card-body">
                    {{-- Image from internet or storage --}}
                    <img src={{ Str::startsWith($restaurant->image, 'https://') ? $restaurant->image : asset('storage/' . $restaurant->image) }} class="card-img-top rounded-3" alt={{$restaurant->name}}> 
                    {{-- Name --}}
                    <h1 class="card-title fs-2">{{$restaurant->name}}</h1>
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
                    <span class="badge bg-secondary"></span></h6>
                    <div class="d-flex justify-content-center align-items-center">
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
        </div>
        {{-- /restaurant container --}}
    </div>
    {{-- / Restaurants --}}
    {{-- Product --}}
    <div class="row align-items-center vh-100">
        {{-- products container --}}
        <div id="products-show-container" class="container bg-light rounded py-4 px-5 my-4">
            <div class="d-flex justify-content-between align-items-center my-4">
                <h2>Lista prodotti</h2>
                <a href="{{ route('admin.products.create') }}" class="btn btn-outline-primary fs-6">+</a>
            </div>
            {{-- message --}}
            @include('partials.message')
            {{-- row --}}  
            {{-- products table--}}
            <table class="table table-hover align-middle justify-content-center">
                <tbody>
                    <thead>
                        <th scope="col" class="col-3">Prodotto</th>
                        <th scope="col" class="col">Prezzo</th>
                        <th scope="col" class="col-1">Azioni</th>
                    </thead>
                    @foreach ($products as $product)
                        <tr onclick="window.location='{{route('admin.products.show', $product)}}'" style="cursor: pointer" >
                            <td class="d-flex align-items-center justify-content-center">
                                <span class="me-2"><i class="fa-solid {{ ($product->is_visible) ? 'fa-eye text-success' : 'fa-eye-slash text-danger' }}"></i></span>
                                {{ $product->name }}
                            </td>
                            <td>{{ $product->price }} €
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
        </div>
        {{-- / products container --}}
    </div>
    {{-- / Products --}}       
</div>
{{-- /dashboard container --}}
@endsection
