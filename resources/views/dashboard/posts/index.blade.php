@extends('layouts.app')

@section('title', 'Posts Management')

@section('content')
    <div class="row mb-6">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Posts Management</h1>
                <p class="text-gray-600 mt-1">
                    @if(Auth::user()->role === 'admin')
                        Manage all blog posts
                    @else
                        Manage your blog posts
                    @endif
                </p>
            </div>
            <a href="{{ route('dashboard.posts.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg me-2"></i>Create Post
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row rounded-lg shadow overflow-hidden">

        <div class="card overflow-x-auto">
                <div class="card-header border-b border-gray-200">
                    <h2 class="text-lg font-medium text-gray-900">
                        @if(Auth::user()->role === 'admin') All Posts @else My Posts @endif
                    </h2>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Title</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Author</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Category</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Views</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Date</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($posts as $post)
                                                        <tr>
                                                            <td class="px-6 py-4 whitespace-nowrap">
                                                                <div class="text-sm font-medium text-gray-900">{{ $post->title }}</div>
                                                                <div class="text-sm text-gray-500">{{ Str::limit($post->excerpt, 50) }}</div>
                                                            </td>
                                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                                {{ $post->author->name ?? 'Unknown' }}
                                                            </td>
                                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                                {{ $post->category->name ?? 'Uncategorized' }}
                                                            </td>
                                                            <td class="px-6 py-4 whitespace-nowrap">
                                                                <span
                                                                    class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                                                                                            {{ $post->status === 'published' ? 'bg-green-100 text-green-800' :
                                    ($post->status === 'draft' ? 'bg-gray-100 text-gray-800' : 'bg-yellow-100 text-yellow-800') }}">
                                                                    {{ ucfirst($post->status) }}
                                                                </span>
                                                            </td>
                                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                                {{ number_format($post->views) }}
                                                            </td>
                                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                                {{ $post->created_at->format('M d, Y') }}
                                                            </td>
                                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                                <div class="d-flex gap-2">
                                                                    <a href="{{ route('dashboard.posts.edit', $post) }}"
                                                                        class="btn btn-sm btn-outline-primary">
                                                                        <i class="bi bi-pencil"></i>
                                                                    </a>
                                                                    @if(Auth::user()->role === 'admin' || $post->author_id === Auth::id())
                                                                        <form action="{{ route('dashboard.posts.destroy', $post) }}" method="POST"
                                                                            class="d-inline"
                                                                            onsubmit="return confirm('Are you sure you want to delete this post?')">
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
                                        <td colspan="7" class="px-6 py-4 text-center text-gray-500">No posts found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
        </div>

        @if($posts->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $posts->links() }}
            </div>
        @endif
    </div>
@endsection