@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="fs-4 text-secondary my-4">Create a product</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="form-input-image">
            @csrf
            {{-- name --}}
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
            </div>
            {{-- description--}}
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
            </div>
            {{-- Ingredients --}}
            <div class="mb-3">
                <label for="ingredients" class="form-label">Ingredients</label>
                <textarea class="form-control" id="ingredients" name="ingredients">{{ old('ingredients') }}</textarea>
            </div>
            {{-- category select --}}
            <div class="mb-3">
                <label for="category_id" class="form-label">Seleziona categoria</label>
                <select class="form-select" name="category_id" id="category_id" required>
                    <option value="">Categories</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            {{-- Price --}}
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ old('price') }}" min="1" max="20" required>
            </div>
            {{-- Discount --}}
            <div class="mb-3">
                <label for="discount" class="form-label">Discount</label>
                <input type="number" step="0.01" class="form-control" id="discount" name="discount" value="{{ old('discount', 0) }}" min="0" max="0.99" required>
            </div>
            {{-- Visible --}}
            <div class="mb-3 form-check form-switch">
                <label class="form-check-label" for="is_visible">Visible product</label>
                <input type="checkbox" class="form-check-input" id="is_visible" name="is_visible" value="{{ old('is_visible', 1) }}" checked>
            </div>
            <div class="mb-3">
                <div class="image-preview">
                    <img id="file-image-preview">
                </div>

                <label for="image" class="form-label">Image</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection