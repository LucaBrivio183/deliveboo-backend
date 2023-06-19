@extends('layouts.app')

@section('content')
<div class="container my-3">
    <div class="d-flex justify-content-between align-items-center my-4">
        <h2>{{ $product->name }}</h2>
        {{-- create product --}}
        <a href="{{ route('admin.products.index') }}" class="btn btn-md btn-secondary">Indietro</a>
    </div>
    {{-- image --}}
    @if ($product->image)
        <img src="{{ $product->image }}" alt="{{ $product->name }}" class="my-3">
    @endif
    
    {{-- description --}}
    <p>{{ $product->description }}</p>

    {{-- ingredients --}}
    <p>Ingredienti: {{ $product->ingredients }}</p>

    {{-- price --}}
    <h6>€ {{ $product->price }}</h6>

    {{-- buttons --}}
    <div class="d-flex gap-2">
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
@endsection