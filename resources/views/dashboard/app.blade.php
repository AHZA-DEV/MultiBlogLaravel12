@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<!-- Welcome Section -->
<div class="row mb-4">
    <div class="col-12">
        <div class="welcome-section">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h2 class="mb-2">Welcome {{ Auth::user()->name }}</h2>
                    <p class="text-muted mb-0">
                        @if(Auth::user()->role === 'admin')
                            Admin Dashboard - Manage your system and content
                        @else
                            User Dashboard - Manage your content and profile
                        @endif
                    </p>
                </div>
                <div class="col-md-6 text-end">
                    <div class="dropdown">
                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="bi bi-calendar3 me-2"></i>{{ now()->format('M d, Y') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Stats Cards Row -->
<div class="row mb-4">
    <!-- Main Illustration Card -->
    <div class="col-lg-5 mb-4">
        <div class="card main-card h-100">
            <div class="card-body position-relative">
                <div class="d-flex align-items-center mb-3">
                    <i class="bi bi-person-circle text-primary me-2" style="font-size: 2rem;"></i>
                    <div>
                        <div class="fw-bold">{{ Auth::user()->name }}</div>
                        <div class="text-muted small">{{ ucfirst(Auth::user()->role) }} User</div>
                    </div>
                </div>
                
                <!-- Illustration placeholder -->
                <div class="illustration-area text-center">
                    <div class="illustration-placeholder">
                        @if(Auth::user()->role === 'admin')
                            <i class="bi bi-shield-check text-danger" style="font-size: 4rem;"></i>
                            <p class="text-muted mt-2">Admin Control Panel</p>
                        @else
                            <i class="bi bi-file-earmark-text text-primary" style="font-size: 4rem;"></i>
                            <p class="text-muted mt-2">Content Management</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="col-lg-7">
        <div class="row h-100">
            @if(Auth::user()->role === 'admin')
            <div class="col-md-6 mb-4">
                <div class="card stat-card stat-card-blue h-100">
                    <div class="card-body">
                        <h6 class="card-subtitle mb-2 text-white-50">Total Users</h6>
                        <h2 class="card-title text-white mb-2">{{ $totalUsers ?? 0 }}</h2>
                        <small class="text-white-50">Registered users</small>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card stat-card stat-card-purple h-100">
                    <div class="card-body">
                        <h6 class="card-subtitle mb-2 text-white-50">Total Posts</h6>
                        <h2 class="card-title text-white mb-2">{{ $totalPosts ?? 0 }}</h2>
                        <small class="text-white-50">All content</small>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card stat-card stat-card-indigo h-100">
                    <div class="card-body">
                        <h6 class="card-subtitle mb-2 text-white-50">Categories</h6>
                        <h2 class="card-title text-white mb-2">{{ $totalCategories ?? 0 }}</h2>
                        <small class="text-white-50">Content categories</small>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card stat-card stat-card-orange h-100">
                    <div class="card-body">
                        <h6 class="card-subtitle mb-2 text-white-50">Total Tags</h6>
                        <h2 class="card-title text-white mb-2">{{ $totalTags ?? 0 }}</h2>
                        <small class="text-white-50">All tags</small>
                    </div>
                </div>
            </div>
            @else
            <div class="col-md-6 mb-4">
                <div class="card stat-card stat-card-blue h-100">
                    <div class="card-body">
                        <h6 class="card-subtitle mb-2 text-white-50">My Posts</h6>
                        <h2 class="card-title text-white mb-2">{{ $myPosts ?? 0 }}</h2>
                        <small class="text-white-50">Your content</small>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card stat-card stat-card-purple h-100">
                    <div class="card-body">
                        <h6 class="card-subtitle mb-2 text-white-50">My Tags</h6>
                        <h2 class="card-title text-white mb-2">{{ $myTags ?? 0 }}</h2>
                        <small class="text-white-50">Your tags</small>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card stat-card stat-card-indigo h-100">
                    <div class="card-body">
                        <h6 class="card-subtitle mb-2 text-white-50">Draft Posts</h6>
                        <h2 class="card-title text-white mb-2">{{ $draftPosts ?? 0 }}</h2>
                        <small class="text-white-50">Unpublished</small>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card stat-card stat-card-orange h-100">
                    <div class="card-body">
                        <h6 class="card-subtitle mb-2 text-white-50">Published Posts</h6>
                        <h2 class="card-title text-white mb-2">{{ $publishedPosts ?? 0 }}</h2>
                        <small class="text-white-50">Live content</small>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Bottom Section -->
<div class="row">
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title mb-0">Recent Activity</h5>
                    <i class="bi bi-activity text-primary"></i>
                </div>
                <div class="activity-list">
                    <div class="activity-item mb-3">
                        <div class="d-flex justify-content-between">
                            <span class="text-muted">Login</span>
                            <span class="fw-bold">{{ Auth::user()->updated_at->diffForHumans() }}</span>
                        </div>
                    </div>
                    <div class="activity-item mb-3">
                        <div class="d-flex justify-content-between">
                            <span class="text-muted">Account Created</span>
                            <span class="fw-bold">{{ Auth::user()->created_at->format('M d, Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title mb-0">Quick Actions</h5>
                    <i class="bi bi-lightning text-warning"></i>
                </div>
                <div class="quick-actions">
                    <div class="d-grid gap-2">
                        @if(Auth::user()->role === 'admin')
                        <a href="{{ route('dashboard.users') }}" class="btn btn-outline-primary">
                            <i class="bi bi-people me-2"></i>Manage Users
                        </a>
                        <a href="{{ route('dashboard.categories') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-folder me-2"></i>Manage Categories
                        </a>
                        @endif
                        <a href="{{ route('dashboard.posts') }}" class="btn btn-outline-info">
                            <i class="bi bi-file-earmark-text me-2"></i>Manage Posts
                        </a>
                        <a href="{{ route('dashboard.tags') }}" class="btn btn-outline-success">
                            <i class="bi bi-tags me-2"></i>Manage Tags
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection