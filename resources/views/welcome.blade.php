<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog - {{ config('app.name') }}</title>
    
    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ url('/') }}">
                <i class="bi bi-journal-richtext text-primary me-2"></i>
                {{ config('app.name') }}
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    
                </ul>
                
                <div class="d-flex">
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn btn-outline-primary me-2">
                            <i class="bi bi-speedometer2 me-1"></i>Dashboard
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-secondary">
                                <i class="bi bi-box-arrow-right me-1"></i>Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary">
                            <i class="bi bi-box-arrow-in-right me-1"></i>Login
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="bg-primary text-white py-5 mb-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h1 class="display-4 fw-bold mb-3">Welcome to Our Blog</h1>
                    <p class="lead mb-4">Discover insights, tutorials, and stories from our community of writers. Stay updated with the latest trends in technology, business, and more.</p>
                    <div class="d-flex align-items-center">
                        <i class="bi bi-journal-bookmark me-2"></i>
                        <span>{{ $posts->total() }} articles available</span>
                    </div>
                </div>
                <div class="col-lg-4 text-center">
                    <i class="bi bi-file-earmark-text" style="font-size: 8rem; opacity: 0.3;"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Blog Posts -->
    <div class="container mb-5">
        @if($posts->count() > 0)
        <div class="row">
            @foreach($posts as $post)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body d-flex flex-column">
                        <!-- Category Badge -->
                        @if($post->category)
                        <div class="mb-2">
                            <span class="badge bg-primary rounded-pill">{{ $post->category->name }}</span>
                        </div>
                        @endif
                        
                        <!-- Post Title -->
                        <h5 class="card-title">
                            <a href="{{ url('/post/' . $post->slug) }}" class="text-decoration-none text-dark">
                                {{ $post->title }}
                            </a>
                        </h5>
                        
                        <!-- Post Excerpt -->
                        <p class="card-text text-muted flex-grow-1">{{ $post->excerpt }}</p>
                        
                        <!-- Tags -->
                        @if($post->tags->count() > 0)
                        <div class="mb-3">
                            @foreach($post->tags as $tag)
                            <span class="badge bg-light text-dark me-1">#{{ $tag->name }}</span>
                            @endforeach
                        </div>
                        @endif
                        
                        <!-- Post Meta -->
                        <div class="d-flex justify-content-between align-items-center text-muted small">
                            <div>
                                <i class="bi bi-person me-1"></i>{{ $post->author->name }}
                            </div>
                            <div>
                                <i class="bi bi-calendar me-1"></i>{{ $post->published_at->format('M d, Y') }}
                            </div>
                        </div>
                        
                        <!-- Views and Read More -->
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <div class="text-muted small">
                                <i class="bi bi-eye me-1"></i>{{ number_format($post->views) }} views
                            </div>
                            <a href="{{ url('/post/' . $post->slug) }}" class="btn btn-outline-primary btn-sm">
                                Read More <i class="bi bi-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <!-- Pagination -->
        @if($posts->hasPages())
        <div class="d-flex justify-content-center">
            {{ $posts->links() }}
        </div>
        @endif
        
        @else
        <!-- No Posts -->
        <div class="text-center py-5">
            <i class="bi bi-journal-x text-muted" style="font-size: 4rem;"></i>
            <h3 class="mt-3 text-muted">No posts available</h3>
            <p class="text-muted">Check back later for new content!</p>
        </div>
        @endif
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5>{{ config('app.name') }}</h5>
                    <p class="mb-0">Sharing knowledge and insights with the world.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="mb-0">&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS Bundle CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>