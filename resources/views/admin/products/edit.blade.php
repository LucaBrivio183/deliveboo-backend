@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="fs-4 text-secondary my-4">Edit product: {{ $product->name }}</h2>

        {{-- @include('partials.errors') --}}

        <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data" class="form-input-image">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description">{{ $product->description }}</textarea>
            </div>
            <div class="mb-3">
                <label for="ingredients" class="form-label">Ingredients</label>
                <textarea class="form-control" id="ingredients" name="ingredients">{{ $product->ingredients }}</textarea>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ old('price', $product->price) }}" min="1" max="20" required>
            </div>
            <div class="mb-3">
                <label for="discount" class="form-label">Discount</label>
                <input type="number" step="0.01" class="form-control" id="discount" name="discount" value="{{ old('discount', $product->discount) }}" max="0.99" required>
            </div>
            <div class="mb-3 form-check form-switch">
                <label class="form-check-label" for="is_visible">Visible product</label>
                <input type="checkbox" class="form-check-input" id="is_visible" name="is_visible" value="{{ old('is_visible', $product->is_visible) }}" @if($product->is_visible) checked @endif>
            </div>
            <div class="form-check form-switch">
                <input type="checkbox" class="form-check-input" role="switch" id="set_image" name="set_image" value="1" @if($product->image) checked @endif>
                <label for="set_image" class="form-check-label">Activate to manage the image</label>
            </div>
            <div class="mb-3 @if(!$product->image) d-none @endif" id="image-input-container">
                <div class="image-preview">
                    <img id="file-image-preview" @if($product->image) src="{{ asset('storage/' . $product->image) }}" @endif>
                </div>

                <label for="image" class="form-label">Image</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>
            <button type="submit" class="btn btn-primary">Edit</button>
        </form>
    </div>
@endsection