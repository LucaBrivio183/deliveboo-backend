@extends('layouts.app')

@section('content')
<div class="container my-5">
    <a href="{{ route('admin.categories.index') }}" class="btn btn-primary mb-3">Categorie</a>
    <h1 class="mb-3">Aggiungi una categoria per i tuoi prodotti</h1>
    <form action="{{route('admin.categories.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
        {{-- name --}}
        <div class="mb-3">
            <label for="name" class="form-label">Nome categoria</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
            @error('name')
                    <div class="alert alert-danger">{{ $message }} </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Aggiungi</button>
    </form>
</div> 
@endsection