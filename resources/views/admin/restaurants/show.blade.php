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
            <a href="{{ route('admin.restaurants.edit', $restaurant->id) }}" class="btn btn-success btn-sm me-2 p-2">Edit Restaurant</a>
            {{-- Back link --}}
            <a href="{{ route('admin.restaurants.index') }}" class="btn btn-primary btn-sm me-2 p-2">Go Back</a>
            {{-- Delete form --}}
            <form action="{{ route('admin.restaurants.destroy', $restaurant) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="delete-btn btn btn-sm btn-danger p-2">
                    Delete
                </button>
            </form>
        </div>
        
    </div>
</div>

@endsection