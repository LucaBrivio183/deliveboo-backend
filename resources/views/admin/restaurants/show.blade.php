@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <div class="text-center">
        <h1 class="p-2">{{$restaurant->name}}</h1>
        <div class="d-flex justify-content-center align-items-center">
            <div class="card p-3 m-2 col-5">
                <img :src={{$restaurant->image}} class="card-img-top" :alt={{$restaurant->name}}>
                <div class="card-body">
                    <h5 class="card-title">{{$restaurant->name}}</h5>
                    <div>{{$restaurant->slug}}</div>
                    <div>VAT Numer: {{$restaurant->vat_number}}</div>
                    <span>Address: {{$restaurant->address}},</span>
                    <span>{{$restaurant->city}}</span>
                    <div>Postal Code: {{$restaurant->postal_code}},</div>
                    <div>Phone Number: +{{$restaurant->phone_number}}</div>
                    <div>Business Times: {{$restaurant->business_times}}</div>
                    <div>Delivery Cost: {{$restaurant->delivery_cost}}$</div>
                    <div>Min Purchase: {{$restaurant->min_purchase}}$</div>
                    {{-- AGGIUNGERE LE TIPOLOGIEE--}}
                    <span class="badge bg-secondary"></span></h6>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center align-items-center">
            {{-- Edit link --}}
            <a href="{{ route('admin.restaurants.edit', $restaurant->id) }}" class="btn btn-success btn-sm me-2 p-2">Modifica ristorante</a>
            {{-- Back link --}}
            <a href="{{ route('admin.restaurants.index') }}" class="btn btn-primary btn-sm me-2 p-2">Indietro</a>
            {{-- button trigger delete modal --}}
            <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#restaurant-{{ $restaurant->id }}">Elimina</a>
            
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

@endsection