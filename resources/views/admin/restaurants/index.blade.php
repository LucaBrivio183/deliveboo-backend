@extends('layouts.app')
@section('content')

<div class="container d-flex justify-content-center">
    <div class="bg-light rounded py-4 px-5 my-4 d-flex flex-column align-items-center">
        <h1 class="p-2">Il tuo ristorante</h1>
        {{-- create link --}}
        <div>
            @foreach ($restaurants as $restaurant)
            <div class="card p-4">
                <img :src={{$restaurant->image}} class="card-img-top" :alt={{$restaurant->name}}>
                <div class="card-body">
                <h5 class="card-title">{{$restaurant->name}}</h5>
                <div>Partita IVA: {{$restaurant->vat_number}}</div>
                <span>Indirizzo: {{$restaurant->address}},</span>
                <span>{{$restaurant->city}}</span>
                <div>CAP: {{$restaurant->postal_code}},</div>
                <div>Numero: +{{$restaurant->phone_number}}</div>
                <div>Orari: {{$restaurant->business_times}}</div>
                <div>Costo spedizione: {{$restaurant->delivery_cost}}$</div>
                <div>Spesa minima: {{$restaurant->min_purchase}}$</div>
                {{-- AGGIUNGERE LE TIPOLOGIEE--}}
                <span class="badge bg-secondary"></span></h6>
                <div class="buttons mt-3 d-flex align-items-center gap-2">
                    {{-- Show link --}}
                    <a href="{{ route('admin.restaurants.show', $restaurant->id)}}" class="btn btn-info">Dettagli</a>
                    {{-- Delete form --}}
                    <form action="{{ route('admin.restaurants.destroy', $restaurant) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="circle-btn delete-btn btn btn-danger">
                            Elimina
                        </button>
                    </form>
                </div>
                </div>
            </div>
            @endforeach
        </div>     
    </div>
@endsection