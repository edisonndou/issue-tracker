@extends('layouts.app')

@section('title', 'Edit Tag')

@section('content')
    <div class="container">
        <div class="row mb-4">
            <div class="col-12">
                <h1 class="h2"><i class="bi bi-pencil"></i> Edit Tag</h1>
            </div>
        </div>

        {{-- Update Tags --}}
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('tags.update', $tag) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="name" class="form-label">Tag Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name', $tag->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="color" class="form-label">Color</label>
                                <div class="input-group">
                                    <input type="color" name="color" id="color"
                                        class="form-control form-control-color @error('color') is-invalid @enderror"
                                        value="{{ old('color', $tag->color ?? '#0d6efd') }}" style="width: 60px;">
                                    <input type="text" class="form-control" id="colorHex" placeholder="#0d6efd"
                                        value="{{ old('color', $tag->color ?? '#0d6efd') }}" disabled>
                                </div>
                                @error('color')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-check-circle"></i> Update Tag
                                </button>
                                <a href="{{ route('tags.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body text-center">
                        <p class="text-muted mb-3">Preview</p>
                        <span class="tag-badge fs-5" id="preview"
                            style="background-color: {{ $tag->color ?? '#0d6efd' }}20; color: {{ $tag->color ?? '#0d6efd' }}">
                            {{ $tag->name }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('color').addEventListener('change', function() {
            const color = this.value;
            document.getElementById('colorHex').value = color;
            document.getElementById('preview').style.backgroundColor = color + '20';
            document.getElementById('preview').style.color = color;
        });
    </script>
@endsection
