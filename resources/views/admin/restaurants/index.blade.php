@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <div class="d-flex justify-content-center align-items-center">
        <h1 class="p-2">I tuo ristoranti</h1>
        {{-- create link --}}
        <a href="{{ route('admin.restaurants.create') }}" class="btn btn-success btn-sm p-2 ms-5">Create</a>
        </div>
        
        <div class="d-flex flex-wrap justify-content-center align-items-center">
            @foreach ($restaurants as $restaurant)
            <div class="card p-3 m-2 col-md-5 ">
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
                {{-- Show link --}}
                <a href="{{ route('admin.restaurants.show', $restaurant->id)}}" class="btn btn-primary mt-2">Show Restaurant</a>
                {{-- Delete form --}}
                <form action="{{ route('admin.restaurants.destroy', $restaurant) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="circle-btn delete-btn btn btn-danger mt-1">
                        Delete
                    </button>
                </form>
                </div>
            </div>
            @endforeach
        </div>     
 </div>
@endsection