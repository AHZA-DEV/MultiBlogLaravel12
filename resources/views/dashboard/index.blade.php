@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-900">Dashboard</h1>
    <p class="text-gray-600 mt-1">Welcome back, {{ $user->name }}!</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
    @if($user->role === 'admin')
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-2 bg-blue-100 rounded-lg">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-.5a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Total Users</p>
                <p class="text-2xl font-bold text-gray-900">{{ App\Models\User::count() }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-2 bg-green-100 rounded-lg">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14-7H3a2 2 0 00-2 2v14a2 2 0 002 2h16a2 2 0 002-2V6a2 2 0 00-2-2z"></path>
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Categories</p>
                <p class="text-2xl font-bold text-gray-900">{{ App\Models\Category::count() }}</p>
            </div>
        </div>
    </div>
    @endif

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-2 bg-purple-100 rounded-lg">
                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">
                    @if($user->role === 'admin') All Posts @else My Posts @endif
                </p>
                <p class="text-2xl font-bold text-gray-900">
                    @if($user->role === 'admin')
                        {{ App\Models\Post::count() }}
                    @else
                        {{ App\Models\Post::where('author_id', $user->id)->count() }}
                    @endif
                </p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-2 bg-yellow-100 rounded-lg">
                <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">
                    @if($user->role === 'admin') All Tags @else My Tags @endif
                </p>
                <p class="text-2xl font-bold text-gray-900">
                    @if($user->role === 'admin')
                        {{ App\Models\Tag::count() }}
                    @else
                        {{ App\Models\Tag::where('created_by', $user->id)->count() }}
                    @endif
                </p>
            </div>
        </div>
    </div>
</div>

<div class="bg-white rounded-lg shadow">
    <div class="p-6">
        <h2 class="text-lg font-medium text-gray-900 mb-4">Quick Actions</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <a href="{{ route('dashboard.posts') }}" class="block p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition duration-200">
                <h3 class="font-medium text-gray-900">Manage Posts</h3>
                <p class="text-sm text-gray-600 mt-1">Create, edit, and manage your blog posts</p>
            </a>
            
            <a href="{{ route('dashboard.tags') }}" class="block p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition duration-200">
                <h3 class="font-medium text-gray-900">Manage Tags</h3>
                <p class="text-sm text-gray-600 mt-1">Organize your content with tags</p>
            </a>

            @if($user->role === 'admin')
            <a href="{{ route('dashboard.users') }}" class="block p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition duration-200">
                <h3 class="font-medium text-gray-900">Manage Users</h3>
                <p class="text-sm text-gray-600 mt-1">View and manage user accounts</p>
            </a>
            @endif
        </div>
    </div>
</div>
@endsection