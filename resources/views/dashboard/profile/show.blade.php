
@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
    <div class="row mb-6">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">My Profile</h1>
                <p class="text-gray-600 mt-1">Manage your personal information</p>
            </div>
            <a href="{{ route('dashboard.profile.edit') }}" class="btn btn-primary">
                <i class="bi bi-pencil me-2"></i>Edit Profile
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <!-- Profile Picture -->
                        <div class="col-md-4 text-center">
                            <div class="profile-picture mb-4">
                                @if($user->avatar)
                                    <img src="{{ asset('storage/' . $user->avatar) }}" 
                                         alt="{{ $user->name }}" 
                                         class="rounded-circle img-thumbnail"
                                         style="width: 150px; height: 150px; object-fit: cover;">
                                @else
                                    <div class="card-title rounded-circle bg-primary d-flex align-items-center justify-content-center mx-auto"
                                         style="width: 150px; height: 150px;">
                                        <span class=fw-bold" style="font-size: 3rem;">{{ substr($user->name, 0, 1) }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Profile Information -->
                        <div class="col-md-8">
                            <div class="card-header ">
                                <h3 class="mb-3">{{ $user->name }}</h3>
                                
                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <strong>Email:</strong>
                                    </div>
                                    <div class="col-sm-8">
                                        {{ $user->email }}
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <strong>Role:</strong>
                                    </div>
                                    <div class="col-sm-8">
                                        <span class="badge bg-{{ $user->role === 'admin' ? 'danger' : 'primary' }}">
                                            {{ ucfirst($user->role) }}
                                        </span>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <strong>Status:</strong>
                                    </div>
                                    <div class="col-sm-8">
                                        <span class="badge bg-{{ $user->status === 'active' ? 'success' : 'danger' }}">
                                            {{ ucfirst($user->status) }}
                                        </span>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <strong>Member Since:</strong>
                                    </div>
                                    <div class="col-sm-8">
                                        {{ $user->created_at->format('F d, Y') }}
                                    </div>
                                </div>

                                @if($user->bio)
                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <strong>Bio:</strong>
                                    </div>
                                    <div class="col-sm-8">
                                        {{ $user->bio }}
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Statistics</h5>
                </div>
                <div class="card-body">
                    <div class="card-title d-flex justify-content-between align-items-center mb-3">
                        <span>Total Posts:</span>
                        <strong>{{ $user->posts()->count() }}</strong>
                    </div>
                    <div class="card-title d-flex justify-content-between align-items-center mb-3">
                        <span>Published Posts:</span>
                        <strong>{{ $user->posts()->where('status', 'published')->count() }}</strong>
                    </div>
                    <div class="card-title d-flex justify-content-between align-items-center mb-3">
                        <span>Draft Posts:</span>
                        <strong>{{ $user->posts()->where('status', 'draft')->count() }}</strong>
                    </div>
                    <div class="card-title d-flex justify-content-between align-items-center">
                        <span>Total Views:</span>
                        <strong>{{ number_format($user->posts()->sum('views')) }}</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
