@extends('layouts.app')

@section('title', 'Tags Management')

@section('content')
    <div class="row mb-6">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Tags Management</h1>
                <p class="text-gray-600 mt-1">
                    @if (Auth::user()->role === 'admin')
                        Manage all content tags
                    @else
                        Manage your content tags
                    @endif
                </p>
            </div>
            <a href="{{ route('dashboard.tags.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg me-2"></i>Create Tag
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="rounded-lg shadow overflow-hidden">

        <div class="row overflow-x-auto">
            <div class="card">
                <div class="card-header ">
                    <h2 class="text-lg font-medium text-gray-900">
                        @if (Auth::user()->role === 'admin')
                            All Tags
                        @else
                            My Tags
                        @endif
                    </h2>
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Slug</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Created By</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Posts Count</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Created</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($tags as $tag)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $tag->name }}</div>
                                        @if ($tag->description)
                                            <div class="text-sm text-gray-500">{{ Str::limit($tag->description, 50) }}</div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $tag->slug }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $tag->creator->name ?? 'Unknown' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $tag->posts_count ?? 0 }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $tag->created_at->format('M d, Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('dashboard.tags.edit', $tag) }}"
                                                class="btn btn-sm btn-outline-primary">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            @if(Auth::user()->role === 'admin' || $tag->created_by === Auth::id())
                                                <form action="{{ route('dashboard.tags.destroy', $tag) }}" method="POST"
                                                    class="d-inline"
                                                    onsubmit="return confirm('Are you sure you want to delete this tag?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">No tags found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        @if ($tags->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $tags->links() }}
            </div>
        @endif
    </div>
@endsection