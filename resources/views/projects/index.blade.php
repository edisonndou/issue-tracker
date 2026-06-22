@extends('layouts.app')

@section('title', 'Projects')

@section('content')
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-12 d-flex justify-content-between align-items-center">
                <h1 class="h2"><i class="bi bi-folder"></i> Projects</h1>
                <a href="{{ route('projects.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> New Project
                </a>
            </div>
        </div>

        @if($projects->isEmpty())
            <div class="card">
                <div class="card-body">
                    <div class="empty-state">
                        <div class="empty-state-icon">
                            <i class="bi bi-folder-x"></i>
                        </div>
                        <h5>No projects yet</h5>
                        <p class="mb-3">Get started by creating your first project</p>
                        <a href="{{ route('projects.create') }}" class="btn btn-primary">Create Project</a>
                    </div>
                </div>
            </div>
        @else
            <div class="row">
                @foreach($projects as $project)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card project-card h-100">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $project->name }}</h5>
                                <p class="card-text text-muted flex-grow-1">{{ Str::limit($project->description, 100) }}</p>

                                <div class="mb-3">
                                    <small class="d-block text-muted">
                                        <i class="bi bi-calendar"></i>
                                        @if($project->start_date && $project->deadline)
                                            {{ $project->start_date->format('M d') }} - {{ $project->deadline->format('M d, Y') }}
                                        @else
                                            No dates set
                                        @endif
                                    </small>
                                    <small class="d-block text-muted">
                                        <i class="bi bi-list-check"></i> {{ $project->issues->count() }} issues
                                    </small>
                                </div>

                                <div class="btn-group btn-group-sm w-100" role="group">
                                    <a href="{{ route('projects.show', $project) }}" class="btn btn-outline-primary">View</a>
                                    <a href="{{ route('projects.edit', $project) }}" class="btn btn-outline-secondary">Edit</a>
                                    <form action="{{ route('projects.destroy', $project) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this project?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
