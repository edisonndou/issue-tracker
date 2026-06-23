@extends('layouts.app')

@section('title', 'Tags')

@section('content')

    {{-- Tags Showing --}}
    <div class="container">
        <div class="row mb-4">
            <div class="col-12 d-flex justify-content-between align-items-center">
                <h1 class="h2"><i class="bi bi-tags"></i> Tags</h1>
                <a href="{{ route('tags.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> New Tag
                </a>
            </div>
        </div>

        @if ($tags->isEmpty())
            <div class="card">
                <div class="card-body">
                    <div class="empty-state">
                        <div class="empty-state-icon">
                            <i class="bi bi-tags"></i>
                        </div>
                        <h5>No tags yet</h5>
                        <p class="mb-3">Create your first tag to organize issues</p>
                        <a href="{{ route('tags.create') }}" class="btn btn-primary">Create Tag</a>
                    </div>
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Color</th>
                                            <th class="text-end">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($tags as $tag)
                                            <tr>
                                                <td>
                                                    <span class="tag-badge"
                                                        style="background-color: {{ $tag->color }}20; color: {{ $tag->color }}">
                                                        {{ $tag->name }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <div
                                                        style="width: 30px; height: 30px; background-color: {{ $tag->color }}; border-radius: 4px; border: 1px solid #ddd;">
                                                    </div>
                                                </td>
                                                <td class="text-end">
                                                    <a href="{{ route('tags.edit', $tag) }}"
                                                        class="btn btn-sm btn-outline-primary">Edit</a>
                                                    <form action="{{ route('tags.destroy', $tag) }}" method="POST"
                                                        class="d-inline" onsubmit="return confirm('Delete this tag?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-sm btn-outline-danger">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
