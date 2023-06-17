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

    <div class="row">
      {{-- accordion --}}
      <div class="accordion accordion-flush" id="accordionExample">
        @foreach ($categories as $category)
          {{-- accordion item for each category --}}
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $category->id }}" aria-controls="collapse{{ $category->id }}">
                {{ $category->name }}
              </button>
            </h2>
            <div id="collapse{{ $category->id }}" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
              {{-- accordion  body--}}
              <div class="accordion-body">
                {{-- products table--}}
                <table class="table table-hover align-middle">
                  <tbody>
                      @foreach ($category->products as $product)
                          <tr onclick="window.location='{{route('admin.products.show', $product)}}'" style="cursor: pointer">
                              <td>{{ $product->name }}</td>
                              <td>{{ $product->description }}</td>
                              <td>{{ $product->price }} €</td>
                              <td>
                                  <div class="d-flex gap-2">
                                      <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-info btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                                      {{-- button trigger delete modal --}}
                                      <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#product-{{ $product->id }}"> <i class="fa-solid fa-trash"></i></a>                                      
                                  </div>
                              </td>
                          </tr>
                          
                          {{-- delete modal --}}
                          <div class="modal fade" id="product-{{ $product->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Warning</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                            <div class="modal-body">
                            Vuoi cancellare il prodotto <strong>{{ $product->name }}</strong>?
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
              {{-- /accordion  body--}}
            </div>

          </div>
          {{-- /accordion item for each category --}}
        @endforeach
      
      </div>
      {{-- /accordion --}}

    </div>
</div>
@endsection