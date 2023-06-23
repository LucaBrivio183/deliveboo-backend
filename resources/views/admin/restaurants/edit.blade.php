@extends('layouts.app')

@section('content')

{{-- Edit restaurant info --}}
<div class="form-container bg-light rounded py-4 px-5 my-4">
    <div class="my-5 d-flex justify-content-between align-items-center">
        <h1 class="fs-2 pe-4">Modifica informazioni del ristorante</h1>
        {{-- Back to dashboard button --}}
        <div>
            <a href="{{ route('admin.restaurants.index') }}" class="btn btn-success d-none d-md-block">Indietro</a>
            {{-- <a href="{{ route('admin.dashboard') }}" class="btn btn-success d-block d-md-none">Dashboard</a> --}}
        </div>
    </div>
    
    {{-- Edit restaurant info form --}}
    <form action="{{ route('admin.restaurants.update', $restaurant->id) }}" method="POST"  enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            {{-- Name --}}
            <div class="mb-3 col-12 col-lg-7">
                <label for="name" class="form-label">Nome del ristorante <span class="required-input">*</span></label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $restaurant->name) }}" required />
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            {{-- Vat Number --}}
            <div class="mb-3 col-12 col-lg-5">
                <label for="vat_number" class="form-label">Partita IVA <span class="required-input">*</span></label>
                <input type="text" class="form-control @error('vat_number') is-invalid @enderror" id="vat_number" name="vat_number" value="{{ old('vat_number', $restaurant->vat_number) }}" required />
                @error('vat_number')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            {{-- Address --}}
            <div class="mb-3 col-sm-9">
                <label for="address" class="form-label">Indirizzo <span class="required-input">*</span></label>
                <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address', $restaurant->address) }}" required />
                @error('address')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            {{-- Postal Code --}}
            <div class="mb-3 col-sm-3">
                <label for="postal_code" class="form-label">Codice postale</label>
                <input type="text" class="form-control @error('postal_code') is-invalid @enderror" id="postal_code" name="postal_code" value="{{ old('postal_code', $restaurant->postal_code) }}">
                @error('postal_code')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            {{-- Business Times --}}
            <div class="mb-3">
                <label for="business_times" class="form-label">Orari</label>
                <input type="text" class="form-control @error('business_times') is-invalid @enderror" id="business_times" name="business_times" value="{{ old('business_times', $restaurant->business_times) }}">
                @error('business_times')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            {{-- Phone Number --}}
            <div class="mb-3 col-md-6">
                <label for="phone_number" class="form-label">Numero di telefono <span class="required-input">*</span></label>
                <input type="text" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number" name="phone_number" value="{{ old('phone_number', $restaurant->phone_number) }}" required>
                @error('phone_number')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            {{-- Delivery Cost --}}
            <div class="mb-3 col-6 col-md-3">
                <label for="delivery_cost" class="form-label">Costo di consegna</label>
                <input type="number" step="0.01" min="0" max="99.99" class="form-control @error('delivery_cost') is-invalid @enderror" id="delivery_cost" name="delivery_cost" value="{{ old('delivery_cost', $restaurant->delivery_cost) }}">
                @error('delivery_cost')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            {{-- Minimum Purchase --}}
            <div class="mb-3 col-6 col-md-3">
                <label for="min_purchase" class="form-label">Minimo d'ordine</label>
                <input type="number" step="0.01" min="0" max="99.99" class="form-control @error('min_purchase') is-invalid @enderror" id="min_purchase" name="min_purchase" value="{{ old('min_purchase', $restaurant->min_purchase) }}">
                @error('min_purchase')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            {{-- Typologies --}}
            @if ($errors->any())                        {{-- If there are errors in the form, show update typologies --}}
                <div class="mb-3">
                    <div class="mb-2">Tipologie <span class="required-input">*</span></div>
                    <div class="row border rounded-4 py-2 ps-3 pe-1 gx-0">
                        @foreach ($typologies as $typology)
                            <div class="col-6 col-sm-4 col-md-3">
                                <input class="form-check-input" type="checkbox" id="{{ $typology->id }}" value="{{ $typology->id }}" name="typologies[]" {{ in_array($typology->id, old('typologies', [])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="{{ $typology->id }}">{{ $typology->name }}</label>
                            </div>
                        @endforeach
                    </div>
                    @error('typologies')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
            @else                                       {{-- if there are no errors in the form, show original typologies --}}
                <div class="mb-3">
                    <div class="mb-2">Tipologie <span class="required-input">*</span></div>
                    <div class="row border rounded-4 py-2 ps-3 pe-1 gx-0">
                        @foreach ($typologies as $typology)
                            <div class="col-6 col-sm-4 col-md-3">
                                <input class="form-check-input" type="checkbox" id="{{ $typology->id }}" value="{{ $typology->id }}" name="typologies[]" {{ $restaurant->typologies->contains($typology->id) ? 'checked' : '' }}>
                                <label class="form-check-label" for="{{ $typology->id }}">{{ $typology->name }}</label>
                            </div>
                        @endforeach
                    </div>
                    @error('typologies')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
            @endif
            {{-- Image --}}
            <div class="mb-2">
                <label for="image" class="form-label">Immagine</label>
                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
                @error('image')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                {{-- Image preview --}}
                <div class="preview">
                    <img id="file-image-preview" class="img-fluid @if($restaurant->image)mt-4 mb-3 @endif" @if($restaurant->image) src="{{ asset('storage/' . $restaurant->image) }}" @endif>
                </div>
            </div>
    
        </div>
        <div class="d-flex justify-content-between align-items-center pe-4">
            {{-- Submit Button --}}
            <button type="submit" class="btn btn-primary">Salva</button>
            <small>I campi contrassegnati da <span class="required-input">*</span> sono obbligatori</small>
        </div>
    </form>
    {{-- /Edit restaurant info form --}}
</div>
{{-- /Edit restaurant info --}}

@endsection