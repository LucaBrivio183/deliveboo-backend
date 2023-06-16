@extends('layouts.app')

@section('content')
<div class="container my-3">
    <div class="d-flex justify-content-between align-items-center mx-3 my-4">
        <h2>Lista prodotti</h2>
        {{-- create product --}}
        <a href="{{ route('admin.products.create') }}" class="btn btn-md btn-info">Crea nuovo prodotto</a>
    </div>

    {{-- message --}}
    @include('partials.message')

    <div class="container d-flex gap-3">
    {{-- element to repeat --}}
    @foreach ($products as $product)
    {{-- card --}}
    <div class="card" style="width: 18rem;">
        {{-- image --}}
        <img src="{{ $product->image }}" class="card-img-top" alt="{{ $product->name }}">
        <div class="card-body">
            {{-- name --}}
            <h5 class="card-title">{{ $product->name }}</h5>
            {{-- description --}}
            <p class="card-text">{{ $product->description }}</p>
            {{-- price --}}
            <h6 class="card-title">€ {{ $product->price }}</h6>
            {{-- actions --}}
            <ul class="list-unstyled d-flex">
                {{-- show --}}
                <li>
                    <a href="{{ route('admin.products.show', $product) }}" class="btn btn-sm btn-primary mt-3 mx-1">Dettagli</a>
                </li>
                {{-- edit --}}
                <li>
                    <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-warning mt-3 mx-1">Modifica</a>
                </li>
                {{-- delete --}}
                <li>
                    {{-- button trigger delete modal --}}
                    <a href="#" class="btn btn-sm btn-danger mt-3 mx-1" data-bs-toggle="modal" data-bs-target="#product-{{ $product->id }}">Elimina</a>
                </li>
            </ul>
            {{-- /actions --}}
        </div>

        {{-- delete modal --}}
        <div class="modal fade" id="product-{{ $product->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Warning</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  Vuoi davvero cancellare il prodotto <strong>{{ $product->name }}</strong>?
                </div>
                <div class="modal-footer">
                  <form action="{{ route('admin.products.destroy', $product) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                    <button class="btn btn-danger my-1">Elimina</button>
                  </form>
                </div>
              </div>
            </div>
        </div>
        {{-- /delete modal --}}
    </div>
    @endforeach
    {{-- element to repeat --}}
    </div>
</div>
@endsection