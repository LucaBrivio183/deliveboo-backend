@extends('layouts.app')

@section('content')

{{-- Create restaurant info --}}
<div class="container">
    <div class="my-4 d-flex justify-content-between align-items-center">
        <h1>Aggiungi le informazioni per il tuo ristorante!</h1>
        {{-- Back to dashboard button --}}
        <div>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-success">Torna alla dashboard</a>
        </div>
    </div>

    {{-- Create restaurant info form --}}
    <form action="{{ route('admin.restaurants.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Name --}}
        <div class="mb-3">
            <label for="name" class="form-label">Nome del ristorante</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required />
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        {{-- Vat Number --}}
        <div class="mb-3">
            <label for="vat_number" class="form-label">Partita IVA</label>
            <input type="text" class="form-control @error('vat_number') is-invalid @enderror" id="vat_number" name="vat_number" value="{{ old('vat_number') }}" required />
            @error('vat_number')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        {{-- Address --}}
        <div class="mb-3">
            <label for="address" class="form-label">Indirizzo</label>
            <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address') }}" required />
            @error('address')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        {{-- Postal Code --}}
        <div class="mb-3">
            <label for="postal_code" class="form-label">Codice postale</label>
            <input type="text" class="form-control @error('postal_code') is-invalid @enderror" id="postal_code" name="postal_code" value="{{ old('postal_code') }}">
            @error('postal_code')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        {{-- City --}}
        <div class="mb-3">
            <label for="city" class="form-label">Città</label>
            <input type="text" class="form-control @error('city') is-invalid @enderror" id="city" name="city" value="{{ old('city') }}" required>
            @error('city')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        {{-- Business Times --}}
        <div class="mb-3">
            <label for="business_times" class="form-label">Orari</label>
            <input type="text" class="form-control @error('business_times') is-invalid @enderror" id="business_times" name="business_times" value="{{ old('business_times') }}">
            @error('business_times')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        {{-- Phone Number --}}
        <div class="mb-3">
            <label for="phone_number" class="form-label">Numero di telefono</label>
            <input type="text" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number" name="phone_number" value="{{ old('phone_number') }}" required>
            @error('phone_number')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        {{-- Delivery Cost --}}
        <div class="mb-3">
            <label for="delivery_cost" class="form-label">Costo di consegna</label>
            <input type="number" step="0.01" min="0" max="99.99" class="form-control @error('delivery_cost') is-invalid @enderror" id="delivery_cost" name="delivery_cost" value="{{ old('delivery_cost') }}">
            @error('delivery_cost')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        {{-- Minimum Purchase --}}
        <div class="mb-3">
            <label for="min_purchase" class="form-label">Minimo d'ordine</label>
            <input type="number" step="0.01" min="0" max="99.99" class="form-control @error('min_purchase') is-invalid @enderror" id="min_purchase" name="min_purchase" value="{{ old('min_purchase') }}">
            @error('min_purchase')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        {{-- Image --}}
        <div class="mb-3">
            <label for="image" class="form-label">Immagine</label>
            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" value="{{ old('image') }}">
            @error('image')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- Submit Button --}}
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    {{-- /Create restaurant info form --}}
</div>
{{-- /Create restaurant info --}}

@endsection