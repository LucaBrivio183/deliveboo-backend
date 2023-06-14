@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <a href="{{ route('admin.projects.index') }}" class="btn btn-primary mb-3">My Projects</a>
        <h1 class="mb-3">Edit {{$project->name}}</h1>
        <form action="{{route('admin.projects.update', $project->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
            <div class="form-group">
                <div class="input-group mb-3">
                    <span class="input-group-text">Project name</span>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name',$project->name) }}">
                    <span class="input-group-text">Version</span>
                    <input type="number" class="form-control @error('major_version') is-invalid @enderror" id="major_version" name="major_version" value="{{ old('major_version',$project->major_version) }}">
                    <input type="number" class="form-control @error('minor_version') is-invalid @enderror" id="minor_version" name="minor_version" value="{{ old('minor_version',$project->minor_version) }}">
                    <input type="number" class="form-control @error('patch_version') is-invalid @enderror" id="patch_version" name="patch_version" value="{{ old('patch_version',$project->patch_version) }}">
                </div>
                    @error('name')
                        <div class="alert alert-danger">{{ $message }} </div>
                    @enderror
                    @error('major_version')
                        <div class="alert alert-danger">{{ $message }} </div>
                    @enderror
                    @error('minor_version')
                        <div class="alert alert-danger">{{ $message }} </div>
                    @enderror
                    @error('patch_version')
                        <div class="alert alert-danger">{{ $message }} </div>
                    @enderror
                {{-- switch for manage project image--}}
                <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox" role="switch" id="set_image" name="set_image" value="1" @if($project->image) checked @endif>
                    <label class="form-check-label" for="set_image">Edit project image</label>
                </div>

                <div class="mb-3 @if(!$project->image) d-none @endif"  id="image-input-container">
                    {{-- preview loaded image--}}
                    <div class="preview">  {{-- @if(!$project->image) d-none @endif --}}
                        <img id="file-image-preview" @if($project->image) src="{{ asset('storage/' . $project->image) }}" @endif>
                    </div>
                    <label for="image" class="form-label">Image</label>
                    <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image">
                </div>
                @error('image')
                    <div class="alert alert-danger">{{ $message }} </div>
                @enderror

                <div class="mb-3">
                    <label for="description" class="form-label">Project description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description', $project->description) }}</textarea>
                    @error('description')
                        <div class="alert alert-danger">{{ $message }} </div>
                    @enderror
                </div>

            </div> 
            <button type="submit" class="btn btn-primary">Edit</button>
        </form>
    </div>  
@endsection