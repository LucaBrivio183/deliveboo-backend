@extends('layouts.app')

@section('content')
<div id="products-show-container" class="d-flex justify-content-center mt-5">
    <div class="col-7 my-4 bg-light rounded py-4 px-5">
        <div class="d-flex justify-content-between align-items-center my-3">
            <h2>{{ $product->name }}</h2>
            {{-- back to dashboard --}}
            <a href="{{ route('admin.dashboard') }}#products-list" class="btn btn-md btn-secondary">Indietro</a>
        </div>
        {{-- image --}}
        @if ($product->image)
        <div class="img-product-show mb-3">
            <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-100 h-100 rounded">
        </div>
        @endif
        
        {{-- description --}}
        <p><strong>Descrizione:</strong> {{ $product->description }}</p>
    
        {{-- ingredients --}}
        <p><strong>Ingredienti:</strong> {{ $product->ingredients }}</p>
    
        {{-- categories --}}
        {{-- <p><strong>Categoria:</strong>  {{ $product->category->name }}</p> --}}
    
        {{-- price --}}
        <h6><strong>Prezzo:</strong> {{ $product->price }} €</h6>
    
        {{-- discount --}}
        @if ($product->discount != 0 )
            <h6><strong>Sconto:</strong> {{ $product->discount }} €</h6>
        @endif
        
    
        {{-- buttons --}}
        <div class="my-4 d-flex gap-2">
            <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-warning">Modifica</a>
                {{-- button trigger delete modal --}}
            <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#product-{{ $product->id }}">Elimina</a>                                      
        </div>
    
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
        </div>
    </div>
</div>
@endsection