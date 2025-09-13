
@extends('layouts.app')

@section('title', 'Categories Management')

@section('content')
<div class="row mb-6">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Categories Management</h1>
            <p class="text-gray-600 mt-1">Organize your content with categories</p>
        </div>
        <a href="{{ route('dashboard.categories.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-2"></i>Add Category
        </a>
    </div>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="card rounded-lg shadow">
    <div class="card-header">
        <h2 class="text-lg font-medium text-gray-900">Categories</h2>
    </div>
    
    <div class="card-body">
        @if($categories->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Parent</th>
                        <th>Status</th>
                        <th>Created By</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                    <tr>
                        <td>
                            <div class="fw-bold">{{ $category->name }}</div>
                            @if($category->description)
                            <small class="text-muted">{{ Str::limit($category->description, 50) }}</small>
                            @endif
                        </td>
                        <td>{{ $category->slug }}</td>
                        <td>{{ $category->parent->name ?? '-' }}</td>
                        <td>
                            <span class="badge {{ $category->status === 'active' ? 'bg-success' : 'bg-secondary' }}">
                                {{ ucfirst($category->status) }}
                            </span>
                        </td>
                        <td>{{ $category->creator->name ?? 'Unknown' }}</td>
                        <td>{{ $category->created_at->format('M d, Y') }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('dashboard.categories.edit', $category) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('dashboard.categories.destroy', $category) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this category?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        @if($categories->hasPages())
        <div class="mt-3">
            {{ $categories->links() }}
        </div>
        @endif
        @else
        <div class="text-center py-5">
            <h3 class="mt-2 text-sm font-medium text-gray-900">No categories yet</h3>
            <p class="mt-1 text-sm text-gray-500">Get started by creating your first category.</p>
            <div class="mt-6">
                <a href="{{ route('dashboard.categories.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-lg me-2"></i>Add Category
                </a>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
