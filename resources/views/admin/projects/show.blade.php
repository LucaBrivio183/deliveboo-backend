@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <div class="d-flex justify-content-between">
            <a href="{{ route('admin.projects.index') }}" class="btn btn-primary mb-3">My Projects</a>
    
            <div class="d-flex gap-2 align-items-center">
                <a href="{{ route('admin.projects.edit', $project->id) }}" class="btn btn-info">Edit Project</i></a>
                <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        Delete Project
                    </button>
                </form>
            </div>
        </div>
        <div class="d-flex align-items-center">
            <h1 class="me-3">{{ $project->name }} </h1> 
            <small class="text-body-secondary">Version: {{ $project->major_version }}.{{ $project->minor_version }}.{{ $project->patch_version }}</small>
        </div> 
        <div class="h-50">
            <img src="{{asset('storage/'. $project->image)}}" alt="{{ $project->name }}">
        </div>
        <h3>{{ $project->description }}</h3>
    </div>  
@endsection
