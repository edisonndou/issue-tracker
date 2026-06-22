@extends('layouts.app')

@section('title', 'Edit Issue')

@section('content')
    <div class="container">
        <div class="row mb-4">
            <div class="col-12">
                <h1 class="h2"><i class="bi bi-pencil"></i> Edit Issue</h1>
                <p class="text-muted">{{ $project->name }}</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('issues.update', $issue) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                                <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
                                       value="{{ old('title', $issue->title) }}" required>
                                @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                                          rows="4">{{ old('description', $issue->description) }}</textarea>
                                @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                    <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                                        <option value="open" {{ old('status', $issue->status) == 'open' ? 'selected' : '' }}>Open</option>
                                        <option value="in_progress" {{ old('status', $issue->status) == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                        <option value="closed" {{ old('status', $issue->status) == 'closed' ? 'selected' : '' }}>Closed</option>
                                    </select>
                                    @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="priority" class="form-label">Priority <span class="text-danger">*</span></label>
                                    <select name="priority" id="priority" class="form-select @error('priority') is-invalid @enderror" required>
                                        <option value="low" {{ old('priority', $issue->priority) == 'low' ? 'selected' : '' }}>Low</option>
                                        <option value="medium" {{ old('priority', $issue->priority) == 'medium' ? 'selected' : '' }}>Medium</option>
                                        <option value="high" {{ old('priority', $issue->priority) == 'high' ? 'selected' : '' }}>High</option>
                                    </select>
                                    @error('priority')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="due_date" class="form-label">Due Date</label>
                                <input type="date" name="due_date" id="due_date" class="form-control @error('due_date') is-invalid @enderror"
                                       value="{{ old('due_date', $issue->due_date?->format('Y-m-d')) }}">
                                @error('due_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-3">
                                <label for="tags" class="form-label">Tags</label>
                                <select name="tags[]" id="tags" class="form-select" multiple>
                                    @foreach($tags as $tag)
                                        <option value="{{ $tag->id }}" {{ $issue->tags->contains($tag->id) ? 'selected' : '' }}>
                                            {{ $tag->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="assignees" class="form-label">Assign To</label>
                                <select name="assignees[]" id="assignees" class="form-select" multiple>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ $issue->assignees->contains($user->id) ? 'selected' : '' }}>
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-check-circle"></i> Update Issue
                                </button>
                                <a href="{{ route('issues.show', $issue) }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
