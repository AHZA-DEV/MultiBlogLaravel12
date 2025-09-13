@extends('layouts.dashboard')

@section('title', 'Tags Management')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-900">Tags Management</h1>
    <p class="text-gray-600 mt-1">
        @if(Auth::user()->role === 'admin')
            Manage all content tags
        @else
            Manage your content tags
        @endif
    </p>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200">
        <h2 class="text-lg font-medium text-gray-900">
            @if(Auth::user()->role === 'admin') All Tags @else My Tags @endif
        </h2>
    </div>
    
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Slug</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created By</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Posts Count</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($tags as $tag)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{ $tag->name }}</div>
                        @if($tag->description)
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
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">No tags found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($tags->hasPages())
    <div class="px-6 py-4 border-t border-gray-200">
        {{ $tags->links() }}
    </div>
    @endif
</div>
@endsection