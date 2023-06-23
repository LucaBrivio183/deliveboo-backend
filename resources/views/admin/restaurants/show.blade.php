@extends('layouts.app')

@section('content')
<div class="container-fluid p-5 text-center position-relative">
    <div class="card ms-restaurant-card px-2 pt-2 d-flex flex-column align-items-center">
        {{-- Image from internet or storage --}}
        <img src={{ Str::startsWith($restaurant->image, 'https://') ? $restaurant->image : asset('storage/' . $restaurant->image) }} class="card-img-top rounded-3" alt={{$restaurant->name}}>
        {{-- Card Body --}}
        <div class="card-body">
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
                <a href="{{ route('admin.restaurants.edit', $restaurant->id) }}" class="btn btn-warning btn-sm me-2 p-2">Modifica ristorante</a>
                {{-- button trigger delete modal --}}
                <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#restaurant-{{ $restaurant->id }}">Elimina</a>
            </div>
        </div>
    </div>
    {{-- Dashboard button --}}
    <div class="position-absolute top-0 end-0 p-5">
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Torna alla Dashboard</a>
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

@endsection