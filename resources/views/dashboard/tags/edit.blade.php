
@extends('layouts.app')

@section('title', 'Edit Tag')

@section('content')
<div class="row mb-6">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Edit Tag</h1>
            <p class="text-gray-600 mt-1">Update tag information</p>
        </div>
        <a href="{{ route('dashboard.tags') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left me-2"></i>Back to Tags
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('dashboard.tags.update', $tag) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ old('name', $tag->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" name="description" rows="3">{{ old('description', $tag->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Update Tag</button>
                        <a href="{{ route('dashboard.tags') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
