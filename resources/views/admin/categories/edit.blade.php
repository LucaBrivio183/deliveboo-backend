@extends('layouts.app')

@section('content')
<div class="container my-5">
    <a href="{{ route('admin.categories.index') }}" class="btn btn-primary mb-3">Categorie</a>
    <h1 class="mb-3">Modifica</h1>
    <form action="{{route('admin.categories.update', $category->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        {{-- name --}}
        <div class="mb-3">
            <label for="name" class="form-label">Nuovo nome</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name',$category->name) }}">
            @error('name')
                    <div class="alert alert-danger">{{ $message }} </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Modifica</button>
    </form>
</div> 
@endsection