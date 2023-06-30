@extends('layouts.app')

@section('content')
<div class="container pb-5">
  @if($orders->isNotEmpty())
    <div class="row">
        <div class="col">
            <h1 class="text-center">Ordini</h1>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-md btn-secondary m-4">Indietro</a>
        </div>
          <div class="row">
              {{-- orders --}}
              <div class="accordion" id="accordionOrder">
                  {{-- for each order --}}
                  @foreach ($orders as $order)
                    <div class="accordion-item">
                      <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$order->id}}" aria-expanded="false" aria-controls="collapse{{$order->id}}">
                          Ordine # {{$order->id}} 
                          <strong class="ms-3 me-1">totale: </strong>
                          <span class="me-4">{{$order->total_price}}€ |</span>  
                          <span class="text-secondary me-4">{{$order->created_at->format(config('app.date_format'))}}</span>
                          <span>{{$order->created_at->diffForHumans()}}</span>
                        </button>
                      </h2>
                      <div id="collapse{{$order->id}}" class="accordion-collapse collapse" data-bs-parent="#accordionOrder">
                        <div class="accordion-body">
                          <div class="py-2">
                            <h3 class="fs-3 mb-2">Informazioni cliente</h3>
                            <div><strong class="me-1">Nome:</strong> {{ $order->name }}</div>
                            <div><strong class="me-1">Indirizzo:</strong>  {{$order->address}}</div>
                            <div><strong class="me-1">Telefono:</strong> {{$order->phone_number}}</div>
                            <div class="mb-2"><strong class="me-1">Email:</strong> {{ $order->email }}</div>
                          </div>
                          
                          <div><strong class="me-1">Spesa totale</strong> {{$order->total_price}} €</div>
                          <hr>
                          <table class="table">
                            <thead>
                              <tr>
                                <th class="col-8">
                                  Prodotto
                                </th>
                                <th class="col">
                                  Quantità
                                </th>
                                <th class="col-1">
                                  Prezzo
                                </th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach ($order->products as $product)
                                <tr>
                              {{-- for each products --}}
                                  <td>{{$product->name}} </td>
                                  <td>{{$product->pivot->quantity}}</td>
                                  <td>{{ number_format($product->price * $product->pivot->quantity, 2) }} €</td>
                                  {{-- /for each products --}}
                                </tr>
                              @endforeach
                            </tbody>
                            </table>  
                        </div>
                      </div>
                    </div>
                  @endforeach
              </div>
              {{-- /orders--}}
          </div>
        @else
        <div class="row">
          <div class="col">
            <h1 class="text-center my-5 pt-3">Nessun ordine presente!</h1>
          </div>
        </div>
        @endif

    </div>
     
        
   
</div>
@endsection