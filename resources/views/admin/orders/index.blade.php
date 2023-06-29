@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <h1 class="text-center">Ordini</h1>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-md btn-secondary m-4">Indietro</a>
        </div>
        <div class="row">
            {{-- orders --}}
            <div class="accordion" id="accordionExample">
                {{-- for each order --}}
                @foreach ($orders as $order )
                  <div class="accordion-item">
                    <h2 class="accordion-header">
                      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$order->id}}" aria-expanded="true" aria-controls="collapse{{$order->id}}">
                         Order # {{$order->id}} - {{$order->name}} 
                      </button>
                    </h2>
                    <div id="collapse{{$order->id}}" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                      <div class="accordion-body">
                        {{-- for each products --}}
                        @foreach ($order->products as $product)
                          <div>
                            <span>{{$product->name}} </span>
                            <div>Quantity : {{$product->pivot->quantity}}</div>
                            <span>{{$product->price}} €</span>
                          </div>
                        @endforeach
                        {{-- /for each products --}}
                        <hr>
                        <div>Address:  {{$order->address}}</div>
                        <div>Telefono: {{$order->phone_number}}</div>
                        
                        <div>Totale: {{$order->total_price}} €</div>
                      </div>
                    </div>
                  </div>
                @endforeach
              </div>
            {{-- /orders--}}
          </div>

    </div>
     
        
   
</div>
@endsection