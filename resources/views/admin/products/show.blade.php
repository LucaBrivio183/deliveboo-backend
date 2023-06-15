@extends('layouts.app')

@section('content')
<div class="container my-3">
    {{-- image --}}
    @if ($product->image)
        <img src="{{ $product->image }}" alt="{{ $product->title }}" class="my-3">
    @endif

    {{-- name --}}
    <h3 class="my-3">{{ $product->name }}</h3>
        
    {{-- description --}}
    <p>{{ $product->description }}</p>

    {{-- ingredients --}}
    <p>Ingredienti: {{ $product->ingredients }}</p>

    {{-- price --}}
    <h6>€ {{ $product->price }}</h6>

    {{-- edit button --}}
    <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-warning my-3">Modifica</a>
</div>
@endsection