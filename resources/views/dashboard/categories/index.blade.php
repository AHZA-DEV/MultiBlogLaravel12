@extends('layouts.app')

@section('title', 'Categories Management')

@section('content')
<div class="rpw mb-6">
    <h1 class="text-2xl font-bold text-gray-900">Categories Management</h1>
    <p class="text-gray-600 mt-1">Organize your content with categories</p>
</div>

<div class="card rounded-lg shadow">
    <div class="card-title">
        <h2 class="text-lg font-medium text-gray-900">Categories</h2>
    </div>
    
    <div class="p-6">
        <div class="text-center py-12">
            <h3 class="mt-2 text-sm font-medium text-gray-900">No categories yet</h3>
            <p class="mt-1 text-sm text-gray-500">Get started by creating your first category.</p>
        </div>
    </div>
</div>
@endsection