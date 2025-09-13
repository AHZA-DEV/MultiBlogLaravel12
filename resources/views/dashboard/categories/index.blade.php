@extends('layouts.app')

@section('title', 'Categories Management')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-900">Categories Management</h1>
    <p class="text-gray-600 mt-1">Organize your content with categories</p>
</div>

<div class="bg-white rounded-lg shadow">
    <div class="px-6 py-4 border-b border-gray-200">
        <h2 class="text-lg font-medium text-gray-900">Categories</h2>
    </div>
    
    <div class="p-6">
        <div class="text-center py-12">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14-7H3a2 2 0 00-2 2v14a2 2 0 002 2h16a2 2 0 002-2V6a2 2 0 00-2-2z"></path>
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">No categories yet</h3>
            <p class="mt-1 text-sm text-gray-500">Get started by creating your first category.</p>
        </div>
    </div>
</div>
@endsection