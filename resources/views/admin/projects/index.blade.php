@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <h1>My projects</h1>
        <a href="{{ route('admin.projects.create') }}" class="btn btn-primary my-3">New Project</a>
        <table class="table table-hover align-middle">
            <thead>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Version</th>
                <th scope="col">Description</th>
            </thead>
            <tbody>
                @foreach ($projects as $project)
                    <tr onclick="window.location='{{route('admin.projects.show', $project->id)}}'" style="cursor: pointer"> {{--   --}}
                        <td>{{ $project->id }}</td>
                        <td>{{ $project->name }}</td>
                        <td>{{ $project->major_version }}.{{ $project->minor_version }}.{{ $project->patch_version }}</td>
                        <td>{{ $project->description }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.projects.edit', $project->id) }}" class="btn btn-info btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                                <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    
                @endforeach
            </tbody>
        </table>
    </div>  
@endsection