@extends('layouts.app')

@section('content')
    <div class="container bg-light rounded py-4 px-5 my-4">
        <div class="d-flex justify-content-between align-items-center my-4">
            <h2>Modifica {{ $product->name }}</h2>
            {{-- create product --}}
            <a href="{{ route('admin.products.index') }}" class="btn btn-md btn-secondary">Indietro</a>
        </div>

        <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data" class="form-input-image">
            @csrf
            @method('PUT')
            {{-- name --}}
            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $product->name) }}" required>
            </div>
            @error('name')
                <div class="alert alert-danger">{{ $message }} </div>
            @enderror
            {{-- Description --}}
            <div class="mb-3">
                <label for="description" class="form-label">Descrizione</label>
                <textarea class="form-control" id="description" name="description">{{ old('description', $product->description) }}</textarea>
            </div>
            @error('description')
                <div class="alert alert-danger">{{ $message }} </div>
            @enderror
            {{-- Ingredients --}}
            <div class="mb-3">
                <label for="ingredients" class="form-label">Ingredienti</label>
                <textarea class="form-control @error('ingredients') is-invalid @enderror" id="ingredients" name="ingredients">{{ old('ingredients', $product->ingredients) }}</textarea>
            </div>
            @error('ingredients')
                <div class="alert alert-danger">{{ $message }} </div>
            @enderror
            {{-- category select --}}
            {{-- <div class="mb-3">
                <label for="category_id" class="form-label">Seleziona categoria</label>
                <select class="form-select @error('category_id') is-invalid @enderror" name="category_id" id="category_id" required>
                    <option value="">--</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            @error('category_id')
                <div class="alert alert-danger">{{ $message }} </div>
            @enderror --}}
            {{-- price --}}
            <div class="mb-3">
                <label for="price" class="form-label">Prezzo</label>
                <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price', $product->price) }}" min="1" max="99" required>
            </div>
            @error('price')
                <div class="alert alert-danger">{{ $message }} </div>
            @enderror
            {{-- discount --}}
            <div class="mb-3">
                <label for="discount" class="form-label ">Sconto</label>
                <input type="number" step="0.01" class="form-control @error('discount') is-invalid @enderror" id="discount" name="discount" value="{{ old('discount', $product->discount) }}" min="0" max="0.99" required>
            </div>
            @error('discount')
                <div class="alert alert-danger">{{ $message }} </div>
            @enderror
            {{-- visible --}}
            <div class="mb-3 form-check form-switch">
                <label class="form-check-label" for="is_visible">Prodotto Visibile</label>
                <input type="checkbox" class="form-check-input @error('is_visible') is-invalid @enderror" id="is_visible" name="is_visible" value="{{ old('is_visible', $product->is_visible) }}" @if($product->is_visible) checked @endif>
            </div>
            @error('is_visible')
                <div class="alert alert-danger">{{ $message }} </div>
            @enderror
            {{-- Image --}}
            <div class="form-check form-switch">
                <input type="checkbox" class="form-check-input" role="switch" id="set_image" name="set_image" value="1" @if($product->image) checked @endif>
                <label for="set_image" class="form-check-label">Attiva per gestire l'immagine</label>
            </div>
            <div class="mb-3 @if(!$product->image) d-none @endif" id="image-input-container">
                <div class="image-preview">
                    <img id="file-image-preview" @if($product->image) src="{{ asset('storage/' . $product->image) }}" @endif>
                </div>

                <label for="image" class="form-label">Immagine</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>
            {{-- submit button --}}
            <button type="submit" class="btn btn-warning">Modifica</button>
        </form>
    </div>
@endsection