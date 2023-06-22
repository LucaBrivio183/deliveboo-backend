@extends('layouts.app')

@section('content')
<div class="container bg-light rounded py-4 px-5 my-4">
    <div class="d-flex justify-content-between align-items-center my-4">
        <h2>Lista prodotti</h2>
        {{-- create product --}}
        <a href="{{ route('admin.dashboard') }}" class="btn btn-md btn-secondary">Indietro</a>
    </div>

    {{-- message --}}
    @include('partials.message')

    <a href="{{ route('admin.products.create') }}" class="btn btn-outline-primary fs-6">+</a>
    <div class="row">
      {{-- products table--}}
      <table class="table table-hover align-middle">
        <tbody>
          <thead>
            <th scope="col" class="col-3">Prodotto</th>
            <th scope="col" class="">Prezzo</th>
            <th scope="col" class="col-1">Azioni</th>
          </thead>
          @foreach ($products as $product)
            <tr onclick="window.location='{{route('admin.products.show', $product)}}'" style="cursor: pointer">
              <td>
                <span class="me-2"><i class="fa-solid {{ ($product->is_visible) ? 'fa-eye text-success' : 'fa-eye-slash text-danger' }}"></i></span>
                {{ $product->name }}
              </td>
              <td>{{ $product->price }} €</td>
              <td>
                {{-- stopPropagation in order to disable onclick event --}}
                <div onclick="event.stopPropagation()">
                  <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-warning btn-sm me-1"><i class="fa-solid fa-pen-to-square"></i></a>
                    {{-- button trigger delete modal --}}
                  <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#product-{{ $product->id }}"> <i class="fa-solid fa-trash text-black"></i></a>                                      
                </div>
              </td>
            </tr>
                          
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
            {{-- /delete modal --}}
            @endforeach
        </tbody>
      </table>
      {{-- /products table--}}
    </div>
  {{-- /row --}}
</div>
{{-- /container --}}
@endsection