@extends('layouts.app')

@section('title', 'Create Project')

@section('content')
    <div class="container">
        <div class="row mb-4">
            <div class="col-12">
                <h1 class="h2"><i class="bi bi-plus-circle"></i> New Project</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('projects.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">Project Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                                       value="{{ old('name') }}" required>
                                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                                          rows="4">{{ old('description') }}</textarea>
                                @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="start_date" class="form-label">Start Date</label>
                                    <input type="date" name="start_date" id="start_date" class="form-control @error('start_date') is-invalid @enderror"
                                           value="{{ old('start_date') }}">
                                    @error('start_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="deadline" class="form-label">Deadline</label>
                                    <input type="date" name="deadline" id="deadline" class="form-control @error('deadline') is-invalid @enderror"
                                           value="{{ old('deadline') }}">
                                    @error('deadline')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-check-circle"></i> Create Project
                                </button>
                                <a href="{{ route('projects.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
