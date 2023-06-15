@extends('layouts.app')

@section('content')
<div class="container my-3">

    <div class="d-flex justify-content-between align-items-center my-4">
        <h2>Products list</h2>
        {{-- create product --}}
        <a href="{{ route('admin.products.create') }}" class="btn btn-md btn-info">Create new Product</a>
    </div>

    {{-- message - product created --}}
    {{--@include('partials.message')--}}
    {{-- /message - product created --}}

    <div class="container d-flex">
    {{-- element to repeat --}}
    @foreach ($products as $product)
    {{-- card --}}
    <div class="card m-3" style="width: 18rem;">
        <img src="{{ $product->image }}" class="card-img-top" alt="{{ $product->name }}">
        <div class="card-body">
            <h5 class="card-title">{{ $product->name }}</h5>
            <p class="card-text">{{ $product->description }}</p>
            <h6 class="card-title">€ {{ $product->price }}</h6>
            <ul class="list-unstyled d-flex my-3">
                {{-- show --}}
                <li>
                    <a href="{{ route('admin.products.show', $product) }}" class="btn btn-sm btn-primary mx-1">Show</a>
                </li>
                {{-- edit --}}
                <li>
                    <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-warning mx-1">Edit</a>
                </li>
                {{-- delete --}}
                <li>
                    {{-- button trigger delete modal --}}
                    <a href="#" class="btn btn-sm btn-danger mx-1" data-bs-toggle="modal" data-bs-target="#product-{{ $product->id }}">Delete</a>
                </li>
            </ul>
        </div>

        {{-- modal --}}
        <div class="modal fade" id="product-{{ $product->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Warning</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  Are you sure you want to delete product <strong>{{ $product->title }}</strong>?
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <form action="{{ route('admin.products.destroy', $product) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger my-1">Delete</button>
                  </form>
                </div>
              </div>
            </div>
        </div>
        {{-- /modal --}}
    </div>
    @endforeach
    {{-- element to repeat --}}
    </div>

</div>
@endsection