<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->title }} - {{ config('app.name') }}</title>
    
    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        .post-content {
            line-height: 1.8;
        }
        .post-content h1, .post-content h2, .post-content h3 {
            margin-top: 2rem;
            margin-bottom: 1rem;
        }
        .post-content pre {
            background-color: #f8f9fa;
            padding: 1rem;
            border-radius: 0.5rem;
            overflow-x: auto;
        }
        .post-content code {
            background-color: #f8f9fa;
            padding: 0.2rem 0.4rem;
            border-radius: 0.25rem;
            font-size: 0.9em;
        }
        .post-content blockquote {
            border-left: 4px solid #0d6efd;
            padding-left: 1rem;
            margin: 1.5rem 0;
            font-style: italic;
        }
    </style>
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
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">
                            <i class="bi bi-arrow-left me-1"></i>Back to Blog
                        </a>
                    </li>
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

    <div class="container my-5">
        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8">
                <!-- Post Header -->
                <div class="mb-4">
                    <!-- Category -->
                    @if($post->category)
                    <div class="mb-3">
                        <span class="badge bg-primary rounded-pill">{{ $post->category->name }}</span>
                    </div>
                    @endif
                    
                    <!-- Title -->
                    <h1 class="display-5 fw-bold mb-3">{{ $post->title }}</h1>
                    
                    <!-- Meta Information -->
                    <div class="d-flex flex-wrap align-items-center text-muted mb-3">
                        <div class="me-4 mb-2">
                            <i class="bi bi-person me-1"></i>{{ $post->author->name }}
                        </div>
                        <div class="me-4 mb-2">
                            <i class="bi bi-calendar me-1"></i>{{ $post->published_at->format('F d, Y') }}
                        </div>
                        <div class="me-4 mb-2">
                            <i class="bi bi-eye me-1"></i>{{ number_format($post->views) }} views
                        </div>
                        <div class="me-4 mb-2">
                            <i class="bi bi-clock me-1"></i>{{ ceil(str_word_count(strip_tags($post->content)) / 200) }} min read
                        </div>
                    </div>
                    
                    <!-- Tags -->
                    @if($post->tags->count() > 0)
                    <div class="mb-4">
                        @foreach($post->tags as $tag)
                        <span class="badge bg-light text-dark me-2 mb-1">#{{ $tag->name }}</span>
                        @endforeach
                    </div>
                    @endif
                    
                    <!-- Excerpt -->
                    <div class="alert alert-light border-start border-primary border-4">
                        <p class="mb-0 lead">{{ $post->excerpt }}</p>
                    </div>
                </div>
                
                <!-- Post Content -->
                <div class="post-content">
                    {!! \Illuminate\Support\Str::of($post->content)->markdown() !!}
                </div>
                
                <!-- Social Sharing -->
                <div class="border-top pt-4 mt-5">
                    <h5>Share this article</h5>
                    <div class="d-flex gap-2">
                        <a href="https://twitter.com/intent/tweet?text={{ urlencode($post->title) }}&url={{ urlencode(request()->fullUrl()) }}" 
                           target="_blank" class="btn btn-outline-info">
                            <i class="bi bi-twitter me-1"></i>Twitter
                        </a>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" 
                           target="_blank" class="btn btn-outline-primary">
                            <i class="bi bi-facebook me-1"></i>Facebook
                        </a>
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->fullUrl()) }}" 
                           target="_blank" class="btn btn-outline-info">
                            <i class="bi bi-linkedin me-1"></i>LinkedIn
                        </a>
                        <button class="btn btn-outline-secondary" onclick="copyToClipboard('{{ request()->fullUrl() }}')">
                            <i class="bi bi-link-45deg me-1"></i>Copy Link
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Author Info -->
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 80px; height: 80px;">
                            <span class="text-white fw-bold fs-2">{{ substr($post->author->name, 0, 1) }}</span>
                        </div>
                        <h5 class="card-title">{{ $post->author->name }}</h5>
                        @if($post->author->bio)
                        <p class="card-text text-muted">{{ $post->author->bio }}</p>
                        @endif
                    </div>
                </div>
                
                <!-- Related Posts -->
                @if($relatedPosts->count() > 0)
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Related Articles</h5>
                    </div>
                    <div class="card-body">
                        @foreach($relatedPosts as $relatedPost)
                        <div class="mb-3 {{ !$loop->last ? 'border-bottom pb-3' : '' }}">
                            <h6>
                                <a href="{{ url('/post/' . $relatedPost->slug) }}" class="text-decoration-none">
                                    {{ $relatedPost->title }}
                                </a>
                            </h6>
                            <small class="text-muted">
                                By {{ $relatedPost->author->name }} • {{ $relatedPost->published_at->format('M d, Y') }}
                            </small>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
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
    
    <script>
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(function() {
                alert('Link copied to clipboard!');
            });
        }
    </script>
</body>
</html>